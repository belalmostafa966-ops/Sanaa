<?php

namespace App\Http\Controllers;

use App\Models\PortfolioItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PortfolioItemController extends Controller
{
    // الصنايعي يشوف شغله كله (البورتفوليو بتاعته)
    public function index()
    {
        $items = PortfolioItem::where('worker_id', Auth::id())
            ->latest()
            ->get();

        return view('worker.portfolio.index', compact('items'));
    }

    public function create()
    {
        return view('worker.portfolio.create');
    }

    public function store(Request $request)
    {
        $fields = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image'       => ['nullable', 'image', 'max:4096'], // 4MB
        ]);

        if ($request->hasFile('image')) {
            $fields['image_path'] = $request->file('image')->store('portfolio', 'public');
        }

        unset($fields['image']);
        $fields['worker_id'] = Auth::id();

        PortfolioItem::create($fields);

        return redirect()->route('worker.portfolio.index')
            ->with('status', 'تم إضافة الشغلانة للبورتفوليو.');
    }

    public function destroy(PortfolioItem $portfolioItem)
    {
        abort_unless($portfolioItem->worker_id === Auth::id(), 403);

        if ($portfolioItem->image_path) {
            Storage::disk('public')->delete($portfolioItem->image_path);
        }

        $portfolioItem->delete();

        return back()->with('status', 'تم حذف الشغلانة.');
    }

    // أي حد يشوف بورتفوليو صنايعي معين (صفحة عامة)
    public function showForWorker(User $worker)
    {
        abort_unless($worker->role === 'worker', 404);

        $items = PortfolioItem::where('worker_id', $worker->id)->latest()->get();

        return view('worker.portfolio.public', compact('worker', 'items'));
    }
}

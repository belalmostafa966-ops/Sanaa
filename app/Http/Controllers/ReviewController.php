<?php

namespace App\Http\Controllers;

use App\Models\JobRequest;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    // العميل يقيّم الصنايعي بعد ما الطلب يخلص
    public function store(Request $request, JobRequest $jobRequest)
    {
        abort_unless($jobRequest->client_id === Auth::id(), 403);
        abort_unless($jobRequest->status === 'completed', 400, 'لازم الطلب يخلص الأول عشان تقيّمه.');
        abort_if($jobRequest->review()->exists(), 400, 'إنت قيّمت الطلب ده قبل كده.');

        $fields = $request->validate([
            'rating'  => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['nullable', 'string'],
        ]);

        Review::create([
            'job_request_id' => $jobRequest->id,
            'client_id'      => Auth::id(),
            'worker_id'      => $jobRequest->assigned_worker_id,
            'rating'         => $fields['rating'],
            'comment'        => $fields['comment'] ?? null,
        ]);

        return back()->with('status', 'شكرًا لتقييمك!');
    }

    // كل تقييمات صنايعي معين (صفحة عامة على البروفايل بتاعه)
    public function forWorker(User $worker)
    {
        abort_unless($worker->role === 'worker', 404);

        $reviews = Review::where('worker_id', $worker->id)
            ->with('client')
            ->latest()
            ->get();

        $averageRating = round($reviews->avg('rating'), 1);

        return view('worker.reviews.index', compact('worker', 'reviews', 'averageRating'));
    }
}
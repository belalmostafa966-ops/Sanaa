<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\JobRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobRequestController extends Controller
{
    // العميل: كل طلباته هو بس
    public function myRequests()
    {
        $requests = JobRequest::where('client_id', Auth::id())
            ->with(['category', 'assignedWorker', 'offers'])
            ->latest()
            ->get();

        return view('client.job-requests.index', compact('requests'));
    }

    // الصنايعي: الطلبات المفتوحة اللي لسه محدش اتكلف بيها
    public function browse()
    {
        $requests = JobRequest::where('status', 'open')
            ->with(['category', 'client'])
            ->latest()
            ->get();

        return view('worker.job-requests.browse', compact('requests'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('client.job-requests.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $fields = $request->validate([
            'category_id' => ['nullable', 'exists:categories,id'],
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:2000'],
            'area'        => ['required', 'string', 'max:255'],
            'image'       => ['nullable', 'image', 'max:2048'], // أقصى حجم 2 ميجا
        ]);

        // لو المستخدم رفع صورة، نخزنها ونحفظ مسارها بس
        if ($request->hasFile('image')) {
            $fields['image'] = $request->file('image')->store('job-requests', 'public');
        }

        $fields['client_id'] = Auth::id();
        $fields['status'] = 'open';

        JobRequest::create($fields);

        return redirect()->route('client.job-requests.index')
            ->with('status', 'تم نشر الطلب بنجاح.');
    }

    public function show(JobRequest $jobRequest)
    {
        // العميل يشوف طلبه هو بس، أو الصنايعي المتكلف، أو أي صنايعي يشوف طلب مفتوح
        $user = Auth::user();

        abort_unless(
            $jobRequest->client_id === $user->id
                || $jobRequest->assigned_worker_id === $user->id
                || ($user->role === 'worker' && $jobRequest->status === 'open'),
            403
        );

        $jobRequest->load(['category', 'client', 'assignedWorker', 'offers.worker', 'review']);

        return view('job-requests.show', compact('jobRequest'));
    }

    // العميل يقفل الطلب بعد ما يخلص فعليًا
    public function complete(JobRequest $jobRequest)
    {
        abort_unless($jobRequest->client_id === Auth::id(), 403);
        abort_unless($jobRequest->status === 'in_progress', 400, 'الطلب ده مش شغال دلوقتي.');

        $jobRequest->update(['status' => 'completed']);

        return back()->with('status', 'تم إغلاق الطلب. تقدر دلوقتي تقيّم الصنايعي.');
    }

    // العميل يلغي طلبه لو لسه مفتوح
    public function cancel(JobRequest $jobRequest)
    {
        abort_unless($jobRequest->client_id === Auth::id(), 403);
        abort_unless($jobRequest->status === 'open', 400, 'مينفعش تلغي طلب شغال أو خلصان.');

        $jobRequest->update(['status' => 'cancelled']);

        return back()->with('status', 'تم إلغاء الطلب.');
    }
}
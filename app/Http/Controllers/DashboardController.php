<?php

namespace App\Http\Controllers;

use App\Models\JobRequest;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function client()
    {
        $clientId = Auth::id();

        $ongoingCount = JobRequest::where('client_id', $clientId)
            ->whereIn('status', ['open', 'in_progress'])
            ->count();

        $completedCount = JobRequest::where('client_id', $clientId)
            ->where('status', 'completed')
            ->count();

        // إجمالي المدفوع = مجموع أسعار العروض المقبولة على طلبات العميل ده
        $totalPaid = JobRequest::where('client_id', $clientId)
            ->whereHas('offers', fn ($q) => $q->where('status', 'accepted'))
            ->with(['offers' => fn ($q) => $q->where('status', 'accepted')])
            ->get()
            ->pluck('offers')
            ->flatten()
            ->sum('price');

        // الطلب الشغال دلوقتي (لو فيه)
        $activeJob = JobRequest::where('client_id', $clientId)
            ->where('status', 'in_progress')
            ->with('assignedWorker')
            ->latest()
            ->first();

        // آخر طلب اتقفل (لعرضه كـ "آخر إيصال")
        $lastCompletedJob = JobRequest::where('client_id', $clientId)
            ->where('status', 'completed')
            ->with(['assignedWorker', 'offers' => fn ($q) => $q->where('status', 'accepted')])
            ->latest('updated_at')
            ->first();

        return view('client.dashboard', compact(
            'ongoingCount',
            'completedCount',
            'totalPaid',
            'activeJob',
            'lastCompletedJob'
        ));
    }

    public function worker()
    {
        $workerId = Auth::id();

        $activeJobsCount = JobRequest::where('assigned_worker_id', $workerId)
            ->where('status', 'in_progress')
            ->count();

        $completedJobsCount = JobRequest::where('assigned_worker_id', $workerId)
            ->where('status', 'completed')
            ->count();

        $pendingOffersCount = Auth::user()->offers()->where('status', 'pending')->count();

        $openRequestsCount = JobRequest::where('status', 'open')->count();

        return view('worker.dashboard', compact(
            'activeJobsCount',
            'completedJobsCount',
            'pendingOffersCount',
            'openRequestsCount'
        ));
    }
}
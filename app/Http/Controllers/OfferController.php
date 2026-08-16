<?php

namespace App\Http\Controllers;

use App\Models\JobRequest;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfferController extends Controller
{
    // الصنايعي يبعت عرض سعر على طلب مفتوح
    public function store(Request $request, JobRequest $jobRequest)
    {
        abort_unless($jobRequest->status === 'open', 400, 'الطلب ده مش متاح لعروض جديدة.');

        $fields = $request->validate([
            'price'   => ['required', 'numeric', 'min:1'],
            'message' => ['nullable', 'string'],
        ]);

        $fields['job_request_id'] = $jobRequest->id;
        $fields['worker_id'] = Auth::id();

        $alreadyOffered = Offer::where('job_request_id', $jobRequest->id)
            ->where('worker_id', Auth::id())
            ->exists();

        abort_if($alreadyOffered, 400, 'إنت بعت عرض على الطلب ده قبل كده.');

        Offer::create($fields);

        return back()->with('status', 'تم إرسال عرضك بنجاح.');
    }

    // العميل يقبل عرض معين
    public function accept(Offer $offer)
    {
        $jobRequest = $offer->jobRequest;

        abort_unless($jobRequest->client_id === Auth::id(), 403);
        abort_unless($jobRequest->status === 'open', 400, 'الطلب ده اتحسم بالفعل.');

        $jobRequest->update([
            'status'             => 'in_progress',
            'assigned_worker_id' => $offer->worker_id,
        ]);

        $offer->update(['status' => 'accepted']);

        Offer::where('job_request_id', $jobRequest->id)
            ->where('id', '!=', $offer->id)
            ->update(['status' => 'rejected']);

        return back()->with('status', 'تم قبول العرض. الصنايعي هيتواصل معاك.');
    }

    // العميل يرفض عرض معين
    public function reject(Offer $offer)
    {
        abort_unless($offer->jobRequest->client_id === Auth::id(), 403);

        $offer->update(['status' => 'rejected']);

        return back()->with('status', 'تم رفض العرض.');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\JobRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    // صفحة الدفع الوهمي
    public function show(JobRequest $jobRequest)
    {
        abort_unless($jobRequest->client_id === Auth::id(), 403);
        abort_unless($jobRequest->status === 'completed', 400, 'الدفع بيبقى متاح بعد ما الشغل يخلص بس.');

        $payment = $jobRequest->payment;

        abort_unless($payment && $payment->status === 'pending', 400, 'مفيش دفع مطلوب دلوقتي.');

        return view('client.payments.pay', compact('jobRequest', 'payment'));
    }

    // تنفيذ الدفع (وهمي بالكامل - مفيش بوابة دفع حقيقية)
    public function process(Request $request, JobRequest $jobRequest)
    {
        abort_unless($jobRequest->client_id === Auth::id(), 403);
        abort_unless($jobRequest->status === 'completed', 400, 'الدفع بيبقى متاح بعد ما الشغل يخلص بس.');

        $payment = $jobRequest->payment;

        abort_unless($payment && $payment->status === 'pending', 400, 'مفيش دفع مطلوب دلوقتي.');

        $request->validate([
            'method' => ['required', 'in:wallet,card,cash'],
        ]);

        // مكان بوابة دفع حقيقية (Paymob / Fawry / Stripe) لو حبيت تربطها بعدين
        $payment->update([
            'method'          => $request->method,
            'status'          => 'paid',
            'transaction_ref' => 'FAKE-' . strtoupper(Str::random(10)),
            'paid_at'         => now(),
        ]);

        return redirect()
            ->route('job-requests.show', $jobRequest)
            ->with('status', 'تم الدفع بنجاح (عملية وهمية للتجربة). تقدر دلوقتي تقيّم الصنايعي.');
    }
}
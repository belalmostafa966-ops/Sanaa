@extends('layouts.app')

@section('title', 'الدفع | صنعة')

@section('content')
  <div class="page-head">
    <h1>إتمام الدفع</h1>
    <div class="sub">{{ $jobRequest->title }}</div>
  </div>

  <div class="card" style="max-width:480px;">
    <h3>ملخص الطلب</h3>
    <p style="font-size:.9rem; color:var(--text-soft);">
      المبلغ المطلوب: <b>{{ $payment->amount }} ج.م</b>
    </p>

    <div style="background:#fff8e1; border:1px solid #ffe08a; padding:10px; border-radius:8px; font-size:.8rem; margin-bottom:14px;">
      ⚠️ ده نظام دفع وهمي للتجربة فقط، مفيش بوابة دفع حقيقية ومفيش أي مبلغ بيتحصل فعليًا.
    </div>

    <form method="POST" action="{{ route('client.payments.process', $jobRequest) }}">
      @csrf
      <div class="form-field">
        <label>اختار طريقة الدفع</label>
        <select name="method" required>
          <option value="">اختار</option>
          <option value="wallet">محفظة إلكترونية</option>
          <option value="card">بطاقة بنكية</option>
          <option value="cash">كاش عند الاستلام</option>
        </select>
        @error('method') <div class="error">{{ $message }}</div> @enderror
      </div>

      <button type="submit" class="btn btn-primary" style="width:100%; justify-content:center;">
        ادفع الآن
      </button>
    </form>
  </div>
@endsection
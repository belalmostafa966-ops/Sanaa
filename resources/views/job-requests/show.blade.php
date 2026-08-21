@extends('layouts.app')

@section('title', $jobRequest->title . ' | صنعة')

@php
  $me = auth()->user();
  $isOwner = $jobRequest->client_id === $me->id;
  $isAssignedWorker = $jobRequest->assigned_worker_id === $me->id;
@endphp

@section('content')
  <div class="page-head">
    <h1>{{ $jobRequest->title }}</h1>
    <div class="sub">{{ $jobRequest->category->name ?? 'بدون تصنيف' }} — {{ $jobRequest->area }}</div>
  </div>

  <div class="card">
    <h3>تفاصيل الطلب</h3>
    <p style="font-size:.9rem; line-height:1.8; color:var(--text-soft);">{{ $jobRequest->description }}</p>
    <div style="margin-top:14px; display:flex; gap:10px; align-items:center;">
      <span class="badge neutral">{{ $jobRequest->status }}</span>
      <span class="meta" style="font-size:.8rem; color:var(--text-soft);">صاحب الطلب: {{ $jobRequest->client->name }}</span>
    </div>

    @if($isOwner && $jobRequest->status === 'open')
      <form method="POST" action="{{ route('client.job-requests.cancel', $jobRequest) }}" style="margin-top:16px;">
        @csrf
        <button type="submit" class="btn btn-danger btn-sm">إلغاء الطلب</button>
      </form>
    @endif

    @if($isOwner && $jobRequest->status === 'in_progress')
      <form method="POST" action="{{ route('client.job-requests.complete', $jobRequest) }}" style="margin-top:16px;">
        @csrf
        <button type="submit" class="btn btn-primary btn-sm">تأكيد إن الشغل خلص</button>
      </form>
    @endif
  </div>

  {{-- الصنايعي: فورم بعت عرض على طلب مفتوح --}}
  @if($me->role === 'worker' && $jobRequest->status === 'open')
    <div class="card" style="max-width:480px;">
      <h3>ابعت عرض سعر</h3>
      <form method="POST" action="{{ route('worker.offers.store', $jobRequest) }}">
        @csrf
        <div class="form-field">
          <label>السعر المقترح (ج.م)</label>
          <input type="number" step="0.01" name="price" required>
          @error('price') <div class="error">{{ $message }}</div> @enderror
        </div>
        <div class="form-field">
          <label>رسالة (اختياري)</label>
          <textarea name="message" rows="3" placeholder="اكتب تفاصيل عن عرضك..."></textarea>
        </div>
        <button type="submit" class="btn btn-primary" style="width:100%; justify-content:center;">ابعت العرض</button>
      </form>
    </div>
  @endif

  {{-- العميل: قائمة العروض اللي جت --}}
  @if($isOwner)
    <div class="card">
      <h3>العروض ({{ $jobRequest->offers->count() }})</h3>
      @forelse($jobRequest->offers as $offer)
        <div class="list-item">
          <div>
            <b>{{ $offer->worker->name }} — {{ $offer->price }} ج.م</b>
            @if($offer->message)
              <p>{{ $offer->message }}</p>
            @endif
            <div class="meta">
              <span class="badge {{ $offer->status === 'accepted' ? 'ok' : ($offer->status === 'rejected' ? 'danger' : 'warn') }}">
                {{ $offer->status }}
              </span>
            </div>
          </div>
          @if($jobRequest->status === 'open' && $offer->status === 'pending')
            <div style="display:flex; gap:8px;">
              <form method="POST" action="{{ route('client.offers.accept', $offer) }}">
                @csrf
                <button type="submit" class="btn btn-primary btn-sm">قبول</button>
              </form>
              <form method="POST" action="{{ route('client.offers.reject', $offer) }}">
                @csrf
                <button type="submit" class="btn btn-ghost btn-sm">رفض</button>
              </form>
            </div>
          @endif
        </div>
      @empty
        <div class="empty">لسه محدش بعت عرض.</div>
      @endforelse
    </div>
  @endif

  {{-- العميل: كارت الدفع الوهمي (بيظهر بعد ما الطلب يقفل) --}}
  @if($isOwner && $jobRequest->status === 'completed' && $jobRequest->payment)
    <div class="card" style="max-width:480px;">
      <h3>الدفع</h3>
      @if($jobRequest->payment->status === 'pending')
        <p style="font-size:.85rem; color:var(--text-soft);">
          الشغل خلص! ادفع قيمة العرض ({{ $jobRequest->payment->amount }} ج.م) عشان تقدر تقيّم الصنايعي.
        </p>
        <a href="{{ route('client.payments.show', $jobRequest) }}" class="btn btn-primary btn-sm">ادفع دلوقتي</a>
      @else
        <span class="badge ok">تم الدفع ✅</span>
        <p style="font-size:.8rem; color:var(--text-soft); margin-top:6px;">رقم العملية: {{ $jobRequest->payment->transaction_ref }}</p>
      @endif
    </div>
  @endif

  {{-- العميل: فورم تقييم بعد الإغلاق والدفع --}}
  @if($isOwner && $jobRequest->status === 'completed' && $jobRequest->payment && $jobRequest->payment->status === 'paid')
    <div class="card" style="max-width:480px;">
      <h3>قيّم الصنايعي</h3>
      @if($jobRequest->review)
        <p style="font-size:.85rem; color:var(--text-soft);">
          إنت قيّمت الطلب ده: {{ $jobRequest->review->rating }}/5
          @if($jobRequest->review->comment) — "{{ $jobRequest->review->comment }}" @endif
        </p>
      @else
        <form method="POST" action="{{ route('client.reviews.store', $jobRequest) }}">
          @csrf
          <div class="form-field">
            <label>التقييم (من 1 لـ 5)</label>
            <select name="rating" required>
              <option value="">اختار</option>
              @for($i = 5; $i >= 1; $i--)
                <option value="{{ $i }}">{{ $i }}</option>
              @endfor
            </select>
          </div>
          <div class="form-field">
            <label>تعليق (اختياري)</label>
            <textarea name="comment" rows="3"></textarea>
          </div>
          <button type="submit" class="btn btn-primary" style="width:100%; justify-content:center;">ابعت التقييم</button>
        </form>
      @endif
    </div>
  @endif
@endsection
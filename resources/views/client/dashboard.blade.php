@extends('layouts.app')

@section('title', 'لوحة العميل | صنعة')

@section('content')
  <div class="page-head">
    <h1>أهلاً بيك، {{ auth()->user()->name }} 👋</h1>
    <div class="sub">ده ملخص حسابك مع صنعة</div>
  </div>

  <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:20px; margin-bottom:20px;">
    <div class="card">
      <div style="font-size:1.9rem; font-weight:800; color:var(--ink); font-family:'JetBrains Mono',monospace;">
        {{ $ongoingCount }}
      </div>
      <div style="font-size:.8rem; color:var(--text-soft); margin-top:4px;">طلبات جارية</div>
    </div>
    <div class="card">
      <div style="font-size:1.9rem; font-weight:800; color:var(--ink); font-family:'JetBrains Mono',monospace;">
        {{ $completedCount }}
      </div>
      <div style="font-size:.8rem; color:var(--text-soft); margin-top:4px;">طلبات اتعملت وخلصت</div>
    </div>
    <div class="card">
      <div style="font-size:1.9rem; font-weight:800; color:var(--ink); font-family:'JetBrains Mono',monospace;">
        {{ number_format($totalPaid, 0) }}
      </div>
      <div style="font-size:.8rem; color:var(--text-soft); margin-top:4px;">إجمالي مدفوع (ج.م)</div>
    </div>
  </div>

  <div style="display:grid; grid-template-columns:2fr 1fr; gap:20px;">
    <div class="card">
      <h3>الطلب الشغال دلوقتي</h3>
      @if($activeJob)
        <div style="background:var(--paper-2); border-radius:14px; padding:18px;">
          <b style="display:block; margin-bottom:4px;">{{ $activeJob->assignedWorker->name ?? 'صنايعي' }}</b>
          <span style="font-size:.82rem; color:var(--text-soft); display:block;">الطلب: {{ $activeJob->title }} — {{ $activeJob->area }}</span>
        </div>
        <a href="{{ route('job-requests.show', $activeJob) }}" class="btn btn-primary btn-sm" style="margin-top:14px;">
          تفاصيل الطلب
        </a>
      @else
        <div class="empty">مفيش طلب شغال دلوقتي.</div>
      @endif
    </div>

    <div class="card">
      <h3>آخر إيصال</h3>
      @if($lastCompletedJob && $lastCompletedJob->offers->first())
        <div style="border:1.5px dashed rgba(44,53,144,.2); border-radius:12px; padding:14px;">
          <b style="display:block; font-size:.88rem;">{{ $lastCompletedJob->title }}</b>
          <span style="font-size:.76rem; color:var(--text-soft); display:block; margin-bottom:6px;">
            {{ $lastCompletedJob->assignedWorker->name ?? '' }} — {{ $lastCompletedJob->updated_at->format('d M Y') }}
          </span>
          <span style="font-family:'JetBrains Mono',monospace; font-weight:700; color:var(--ink);">
            {{ number_format($lastCompletedJob->offers->first()->price, 0) }} ج.م
          </span>
        </div>
      @else
        <div class="empty">لسه مفيش إيصالات.</div>
      @endif
    </div>
  </div>

  <div style="margin-top:20px; display:flex; gap:12px;">
    <a href="{{ route('client.job-requests.create') }}" class="btn btn-primary">اطلب صنايعي جديد</a>
    <a href="{{ route('client.job-requests.index') }}" class="btn btn-ghost">كل طلباتي</a>
  </div>
@endsection
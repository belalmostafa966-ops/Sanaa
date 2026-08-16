@extends('layouts.app')

@section('title', 'لوحة الصنايعي | صنعة')

@section('content')
  <div class="page-head">
    <h1>أهلاً بيك، {{ auth()->user()->name }} 👋</h1>
    <div class="sub">ده ملخص شغلك على صنعة</div>
  </div>

  <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:20px; margin-bottom:20px;">
    <div class="card">
      <div style="font-size:1.7rem; font-weight:800; color:var(--ink); font-family:'JetBrains Mono',monospace;">
        {{ $activeJobsCount }}
      </div>
      <div style="font-size:.78rem; color:var(--text-soft); margin-top:4px;">شغل جاري</div>
    </div>
    <div class="card">
      <div style="font-size:1.7rem; font-weight:800; color:var(--ink); font-family:'JetBrains Mono',monospace;">
        {{ $completedJobsCount }}
      </div>
      <div style="font-size:.78rem; color:var(--text-soft); margin-top:4px;">شغل خلصان</div>
    </div>
    <div class="card">
      <div style="font-size:1.7rem; font-weight:800; color:var(--ink); font-family:'JetBrains Mono',monospace;">
        {{ $pendingOffersCount }}
      </div>
      <div style="font-size:.78rem; color:var(--text-soft); margin-top:4px;">عروض مستنية رد</div>
    </div>
    <div class="card">
      <div style="font-size:1.7rem; font-weight:800; color:var(--ink); font-family:'JetBrains Mono',monospace;">
        {{ $openRequestsCount }}
      </div>
      <div style="font-size:.78rem; color:var(--text-soft); margin-top:4px;">طلبات متاحة دلوقتي</div>
    </div>
  </div>

  <div class="card">
    <h3>تحرك دلوقتي</h3>
    <div style="display:flex; gap:12px;">
      <a href="{{ route('worker.job-requests.browse') }}" class="btn btn-primary">تصفح الطلبات المتاحة</a>
      <a href="{{ route('worker.portfolio.index') }}" class="btn btn-ghost">بورتفوليو شغلي</a>
    </div>
  </div>
@endsection
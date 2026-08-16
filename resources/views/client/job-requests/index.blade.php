@extends('layouts.app')

@section('title', 'طلباتي | صنعة')

@php
  $statusLabels = [
    'open' => ['متاح لعروض', 'warn'],
    'in_progress' => ['جاري التنفيذ', 'ok'],
    'completed' => ['اتقفل ✓', 'neutral'],
    'cancelled' => ['ملغي', 'danger'],
  ];
@endphp

@section('content')
  <div class="page-head">
    <h1>طلباتي</h1>
    <div class="sub">كل الطلبات اللي عملتها على صنعة</div>
  </div>

  <div class="card">
    @forelse($requests as $request)
      <div class="list-item">
        <div>
          <b>{{ $request->title }}</b>
          <p>{{ $request->category->name ?? 'بدون تصنيف' }} — {{ $request->area }}</p>
          <div class="meta">
            {{ $request->offers->count() }} عرض
            @if($request->assignedWorker)
              — الصنايعي: {{ $request->assignedWorker->name }}
            @endif
          </div>
        </div>
        <div style="text-align:left; display:flex; flex-direction:column; align-items:flex-end; gap:8px;">
          @php [$label, $tone] = $statusLabels[$request->status] ?? [$request->status, 'neutral']; @endphp
          <span class="badge {{ $tone }}">{{ $label }}</span>
          <a href="{{ route('job-requests.show', $request) }}" class="btn btn-ghost btn-sm">التفاصيل</a>
        </div>
      </div>
    @empty
      <div class="empty">
        لسه مفيش طلبات. <a href="{{ route('client.job-requests.create') }}" style="color:var(--brass); font-weight:800;">اطلب صنايعي دلوقتي</a>
      </div>
    @endforelse
  </div>
@endsection
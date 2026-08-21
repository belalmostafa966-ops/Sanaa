@extends('layouts.app')

@section('title', $worker->name)

@section('content')
<div class="page-head" style="display:flex; justify-content:space-between; align-items:center;">
    <div>
        <h1>{{ $worker->name }}</h1>
        <div class="sub">بورتفوليو الصنايعي</div>
    </div>
    <a href="{{ route('workers.reviews', $worker->id) }}" class="btn btn-ghost">التقييمات</a>
</div>

<div class="card">
    @if ($items->isEmpty())
        <div class="empty">الصنايعي ده لسه ما ضافش شغلانات لبورتفوليوه.</div>
    @else
        <div style="display:grid; grid-template-columns:repeat(auto-fill,minmax(220px,1fr)); gap:16px;">
            @foreach ($items as $item)
                <div style="border:1px solid rgba(44,53,144,.08); border-radius:14px; overflow:hidden;">
                    @if ($item->image_path)
                        <img src="{{ asset('storage/'.$item->image_path) }}" alt="{{ $item->title }}" style="width:100%; height:140px; object-fit:cover;">
                    @else
                        <div style="width:100%; height:140px; background:var(--paper-2); display:flex; align-items:center; justify-content:center; color:var(--text-soft); font-size:.8rem;">
                            بدون صورة
                        </div>
                    @endif
                    <div style="padding:14px;">
                        <b style="display:block; font-size:.92rem; margin-bottom:6px;">{{ $item->title }}</b>
                        @if ($item->description)
                            <p style="font-size:.8rem; color:var(--text-soft);">{{ $item->description }}</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
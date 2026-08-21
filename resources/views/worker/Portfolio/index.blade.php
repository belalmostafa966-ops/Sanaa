@extends('layouts.app')

@section('title', 'بورتفوليو')

@section('content')
<div class="page-head" style="display:flex; justify-content:space-between; align-items:center;">
    <div>
        <h1>بورتفوليو</h1>
        <div class="sub">شغلانات سابقة تظهر للعملاء في بروفايلك العام</div>
    </div>
    <a href="{{ route('worker.portfolio.create') }}" class="btn btn-primary">+ إضافة شغلانة</a>
</div>

<div class="card">
    @if ($items->isEmpty())
        <div class="empty">لسه معندكش شغلانات مضافة. دوس "إضافة شغلانة" وابدأ اعرض شغلك.</div>
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
                            <p style="font-size:.8rem; color:var(--text-soft); margin-bottom:10px;">{{ $item->description }}</p>
                        @endif
                        <form action="{{ route('worker.portfolio.destroy', $item->id) }}" method="POST"
                              onsubmit="return confirm('متأكد إنك عايز تمسح الشغلانة دي؟');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">حذف</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
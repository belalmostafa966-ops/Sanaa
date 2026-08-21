@extends('layouts.app')

@section('title', 'إضافة شغلانة')

@section('content')
<div class="page-head">
    <h1>إضافة شغلانة جديدة</h1>
    <div class="sub">صورة وتفاصيل لشغلانة سابقة، هتظهر جوه بورتفوليوك</div>
</div>

<div class="card">
    <form action="{{ route('worker.portfolio.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-field">
            <label for="title">عنوان الشغلانة</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}" required placeholder="مثال: تركيب مطبخ خشب زان">
            @error('title') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-field">
            <label for="description">الوصف (اختياري)</label>
            <textarea id="description" name="description" rows="4" placeholder="تفاصيل عن الشغلانة، المدة، الخامات المستخدمة...">{{ old('description') }}</textarea>
            @error('description') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-field">
            <label for="image">صورة الشغلانة (اختياري)</label>
            <input type="file" id="image" name="image" accept="image/*">
            @error('image') <div class="error">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-primary">إضافة للبورتفوليو</button>
        <a href="{{ route('worker.portfolio.index') }}" class="btn btn-ghost">إلغاء</a>
    </form>
</div>
@endsection
@extends('layouts.app')

@section('title', 'اطلب صنايعي جديد | صنعة')

@section('content')
  <div class="page-head">
    <h1>اطلب صنايعي جديد</h1>
    <div class="sub">اكتب تفاصيل شغلانتك وهنعرضها على الصنايعية في منطقتك</div>
  </div>

  <div class="card" style="max-width:560px;">
    <form method="POST" action="{{ route('client.job-requests.store') }}">
      @csrf

      <div class="form-field">
        <label>التصنيف</label>
        <select name="category_id">
          <option value="">اختار التصنيف (اختياري)</option>
          @foreach($categories as $category)
            <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
              {{ $category->name }}
            </option>
          @endforeach
        </select>
        @error('category_id') <div class="error">{{ $message }}</div> @enderror
      </div>

      <div class="form-field">
        <label>عنوان الطلب</label>
        <input type="text" name="title" value="{{ old('title') }}" placeholder="مثال: تسريب مياه في المطبخ" required>
        @error('title') <div class="error">{{ $message }}</div> @enderror
      </div>

      <div class="form-field">
        <label>المنطقة</label>
        <input type="text" name="area" value="{{ old('area') }}" placeholder="مثال: التجمع الخامس" required>
        @error('area') <div class="error">{{ $message }}</div> @enderror
      </div>

      <div class="form-field">
        <label>وصف المشكلة</label>
        <textarea name="description" rows="5" placeholder="اشرح المشكلة بالتفصيل...">{{ old('description') }}</textarea>
        @error('description') <div class="error">{{ $message }}</div> @enderror
      </div>

      <button type="submit" class="btn btn-primary" style="width:100%; justify-content:center;">
        ابعت الطلب
      </button>
    </form>
  </div>
@endsection
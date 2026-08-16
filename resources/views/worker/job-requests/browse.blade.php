@extends('layouts.app')

@section('title', 'تصفح الطلبات | صنعة')

@section('content')
  <div class="page-head">
    <h1>تصفح الطلبات المتاحة</h1>
    <div class="sub">الطلبات دي لسه مفيش صنايعي اتكلف بيها، ابعت عرضك</div>
  </div>

  <div class="card">
    @forelse($requests as $request)
      <div class="list-item">
        <div>
          <b>{{ $request->title }}</b>
          <p>{{ $request->description }}</p>
          <div class="meta">
            {{ $request->category->name ?? 'بدون تصنيف' }} — {{ $request->area }} — بواسطة {{ $request->client->name }}
          </div>
        </div>
        <div>
          <a href="{{ route('job-requests.show', $request) }}" class="btn btn-primary btn-sm">التفاصيل وبعت عرض</a>
        </div>
      </div>
    @empty
      <div class="empty">مفيش طلبات متاحة دلوقتي، تعالى بعدين.</div>
    @endforelse
  </div>
@endsection
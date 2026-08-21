@extends('layouts.app')

@section('title', 'تقييمات '.$worker->name)

@section('content')
<div class="page-head">
    <h1>تقييمات {{ $worker->name }}</h1>
    <div class="sub">
        @if ($reviews->isNotEmpty())
            متوسط التقييم: <b style="color:var(--ink);">{{ $averageRating }} / 5</b> من {{ $reviews->count() }} تقييم
        @else
            لسه معندوش تقييمات
        @endif
    </div>
</div>

<div class="card">
    @if ($reviews->isEmpty())
        <div class="empty">لسه معندوش تقييمات.</div>
    @else
        @foreach ($reviews as $review)
            <div class="list-item">
                <div>
                    <b>{{ $review->client->name ?? 'عميل' }}</b>
                    @if ($review->comment)
                        <p>{{ $review->comment }}</p>
                    @endif
                    <div class="meta">{{ $review->created_at->diffForHumans() }}</div>
                </div>
                <span class="badge warn">{{ $review->rating }} / 5</span>
            </div>
        @endforeach
    @endif
</div>
@endsection
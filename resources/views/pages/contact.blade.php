@extends('layouts.public')

@section('title', 'تواصل معانا')

@section('content')
<div class="page-head">
  <h1>تواصل معانا</h1>
  <p>سؤال عن شراكة، اقتراح، أو أي حاجة مش متعلقة بمشكلة تقنية — احنا سامعينك.</p>
</div>

<div class="contact-grid">
  <div class="card">
    <h3>البريد الإلكتروني</h3>
    <p>لأي استفسار عام أو تعاون.</p>
    <a class="btn" href="mailto:hello@san3a.app">hello@san3a.app</a>
  </div>

  <div class="card">
    <h3>اتصل بينا</h3>
    <p>متاحين تليفونيًا خلال ساعات العمل الرسمية.</p>
    <a class="btn" href="tel:+201000000000">01000000000</a>
  </div>

  <div class="card">
    <h3>مشكلة تقنية؟</h3>
    <p>لو المشكلة تقنية في استخدام المنصة، الأسرع إنك تروح لصفحة الدعم الفني.</p>
    <a class="btn" href="{{ route('support') }}">الدعم الفني</a>
  </div>

  <div class="card">
    <h3>مقرنا</h3>
    <p>القاهرة، مصر.</p>
  </div>
</div>
@endsection
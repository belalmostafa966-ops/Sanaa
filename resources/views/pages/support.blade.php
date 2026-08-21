@extends('layouts.public')

@section('title', 'الدعم الفني')

@section('content')
<div class="page-head">
  <h1>الدعم الفني</h1>
  <p>لو واجهتك مشكلة تقنية في استخدام المنصة (تسجيل دخول، طلب مش ظاهر، عرض مش بيتبعت... إلخ) احنا هنا نساعدك.</p>
</div>

<div class="contact-grid">
  <div class="card">
    <h3>راسلنا على الإيميل</h3>
    <p>ابعتلنا تفاصيل المشكلة وهنرد عليك خلال 24 ساعة عمل.</p>
    <a class="btn" href="mailto:support@san3a.app">support@san3a.app</a>
  </div>

  <div class="card">
    <h3>واتساب الدعم</h3>
    <p>لأي مشكلة عاجلة، تقدر تكلمنا مباشرة على واتساب.</p>
    <a class="btn" href="https://wa.me/201000000000" target="_blank" rel="noopener">افتح واتساب</a>
  </div>

  <div class="card">
    <h3>الأسئلة الشائعة</h3>
    <p>ممكن تلاقي إجابة سؤالك جاهزة قبل ما تحتاج تكلمنا.</p>
    <a class="btn" href="{{ route('faq') }}">اتفرج على الأسئلة</a>
  </div>

  <div class="card">
    <h3>مواعيد الرد</h3>
    <p>فريق الدعم متاح من السبت للخميس، من 10 صباحًا لـ 8 مساءً.</p>
  </div>
</div>
@endsection
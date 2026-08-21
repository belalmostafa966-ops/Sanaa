@extends('layouts.public')

@section('title', 'سياسة الخصوصية')

@section('content')
<div class="page-head">
  <h1>سياسة الخصوصية</h1>
  <p>آخر تحديث: {{ now()->translatedFormat('d F Y') }}</p>
</div>

<div class="card">
  <h3 style="color:var(--ink); margin-bottom:10px;">١. البيانات اللي بنجمعها</h3>
  <p style="color:var(--text-soft); line-height:1.9; margin-bottom:24px;">
    بنجمع بيانات التسجيل الأساسية (الاسم، البريد الإلكتروني، رقم الموبايل، الدور: عميل أو صنايعي)، وتفاصيل طلبات الصيانة والعروض والتقييمات اللي بتتبادلها على المنصة.
  </p>

  <h3 style="color:var(--ink); margin-bottom:10px;">٢. استخدام البيانات</h3>
  <p style="color:var(--text-soft); line-height:1.9; margin-bottom:24px;">
    بنستخدم بياناتك عشان نوصّلك بالصنايعي أو العميل المناسب، ونعرض طلباتك وعروضك، ونحسّن جودة الخدمة. مبنبيعش بياناتك لأي طرف تالت.
  </p>

  <h3 style="color:var(--ink); margin-bottom:10px;">٣. مشاركة البيانات</h3>
  <p style="color:var(--text-soft); line-height:1.9; margin-bottom:24px;">
    بيانات التواصل (زي رقم الموبايل) بتتشارك بين العميل والصنايعي بس بعد قبول عرض، عشان يقدروا ينسقوا تفاصيل الشغل مباشرة.
  </p>

  <h3 style="color:var(--ink); margin-bottom:10px;">٤. أمان الحساب</h3>
  <p style="color:var(--text-soft); line-height:1.9; margin-bottom:24px;">
    كلمة السر بتتخزن مشفّرة، وننصحك متشاركش بيانات دخولك مع حد.
  </p>

  <h3 style="color:var(--ink); margin-bottom:10px;">٥. حقوقك</h3>
  <p style="color:var(--text-soft); line-height:1.9; margin-bottom:0;">
    تقدر تطلب تعديل أو حذف بياناتك في أي وقت من خلال <a href="{{ route('contact') }}" style="color:var(--brass); font-weight:700;">التواصل معانا</a>.
  </p>
</div>
@endsection
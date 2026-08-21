@extends('layouts.public')

@section('title', 'الأسئلة الشائعة')

@section('content')
<div class="page-head">
  <h1>الأسئلة الشائعة</h1>
  <p>كل حاجة محتاج تعرفها عن استخدام صنعة، سواء كنت عميل أو صنايعي.</p>
</div>

<div class="card">

  <details class="faq-item" open>
    <summary>إزاي أطلب صنايعي؟</summary>
    <p>سجّل حساب كعميل، اكتب تفاصيل الشغل اللي محتاجه، وهتوصلك عروض من صنايعية في منطقتك تختار من بينها.</p>
  </details>

  <details class="faq-item">
    <summary>إزاي أستقبل الفلوس أو أدفع؟</summary>
    <p>الدفع بيتم مباشرة بين العميل والصنايعي بعد إغلاق الطلب، ومفيش وسيط ماديّ من المنصة في الوقت الحالي.</p>
  </details>

  <details class="faq-item">
    <summary>الصنايعية اتأكدتوا منهم إزاي؟</summary>
    <p>كل صنايعي بيسجّل ببياناته الحقيقية وبورتفوليو شغل سابق، والعملاء بيقيّموا كل طلب بعد ما يخلص، عشان التقييمات تبقى مرآة حقيقية لجودة الشغل.</p>
  </details>

  <details class="faq-item">
    <summary>لو الشغل اتعطّل تاني بعد ما خلص؟</summary>
    <p>تقدر تتواصل مع نفس الصنايعي مباشرة، أو تفتح طلب جديد لو حابب تجرب صنايعي تاني.</p>
  </details>

  <details class="faq-item">
    <summary>إزاي أسجّل كصنايعي على المنصة؟</summary>
    <p>من زرار "سجّل كصنايعي" في الفوتر أو الصفحة الرئيسية، هتعمل حساب وتضيف بورتفوليو شغلك عشان العملاء يشوفوه.</p>
  </details>

  <details class="faq-item">
    <summary>عندي مشكلة أو سؤال مش موجود هنا؟</summary>
    <p>كلمنا من صفحة <a href="{{ route('contact') }}" style="color:var(--brass); font-weight:700;">تواصل معانا</a> وهنرد عليك في أقرب وقت.</p>
  </details>

</div>
@endsection
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'صنعة') | صنعة</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
<style>
  :root{
    --ink:#2C3590; --ink-2:#3D47A8; --paper:#F8F8FC; --paper-2:#ECEDF6;
    --brass:#F7941D; --brass-light:#FDB65A; --stamp:#D9600B;
    --text:#1B1E33; --text-soft:#585C74; --radius:18px;
    --shadow-sm: 0 10px 24px -12px rgba(44,53,144,.22);
  }
  *{margin:0;padding:0;box-sizing:border-box;}
  body{background:var(--paper); color:var(--text); font-family:'Cairo',sans-serif; -webkit-font-smoothing:antialiased;}
  a{color:inherit; text-decoration:none;}
  ul{list-style:none;}
  img{max-width:100%; display:block;}
  .wrap{max-width:900px; margin:0 auto; padding:0 28px;}

  /* ---- top bar ---- */
  .topbar{background:var(--ink); padding:20px 0;}
  .topbar .wrap{display:flex; align-items:center; justify-content:space-between;}
  .topbar .logo{color:#fff; font-weight:900; font-size:1.25rem;}
  .topbar .back{color:rgba(255,255,255,.8); font-size:.9rem; display:flex; align-items:center; gap:6px;}
  .topbar .back:hover{color:var(--brass-light);}

  /* ---- page content ---- */
  main{padding:60px 0 90px;}
  .page-head{margin-bottom:44px;}
  .page-head h1{font-size:2rem; font-weight:900; color:var(--ink); margin-bottom:14px;}
  .page-head p{color:var(--text-soft); font-size:1.02rem; line-height:1.9; max-width:640px;}

  .card{background:#fff; border-radius:var(--radius); padding:28px; box-shadow:var(--shadow-sm); margin-bottom:18px;}

  /* faq accordion */
  .faq-item{border-bottom:1px solid var(--paper-2); padding:18px 0;}
  .faq-item:last-child{border-bottom:none;}
  .faq-item summary{cursor:pointer; font-weight:700; font-size:1.02rem; color:var(--ink); list-style:none;}
  .faq-item summary::-webkit-details-marker{display:none;}
  .faq-item summary::after{content:"+"; float:left; font-size:1.3rem; color:var(--brass);}
  .faq-item[open] summary::after{content:"−";}
  .faq-item p{margin-top:12px; color:var(--text-soft); line-height:1.9;}

  /* contact / support blocks */
  .contact-grid{display:grid; grid-template-columns:1fr 1fr; gap:18px;}
  .contact-grid .card h3{color:var(--ink); font-size:1.05rem; margin-bottom:8px;}
  .contact-grid .card p{color:var(--text-soft); font-size:.92rem; line-height:1.8;}
  .contact-grid .card a.btn{display:inline-block; margin-top:12px; background:var(--brass); color:#fff; padding:10px 18px; border-radius:12px; font-weight:700; font-size:.9rem;}
  .contact-grid .card a.btn:hover{background:var(--stamp);}

  @media (max-width:640px){ .contact-grid{grid-template-columns:1fr;} }

  /* ---- footer (reused from home) ---- */
  footer{background:var(--ink); color:rgba(248,248,252,.7); padding:70px 0 14px; margin-top:40px;}
  .foot-grid{display:grid; grid-template-columns:1.4fr 1fr 1fr 1fr; gap:40px; padding-bottom:40px; border-bottom:1px solid rgba(248,248,252,.14);}
  .foot-grid p{font-size:.88rem; line-height:1.9;}
  .foot-logo{width:120px; margin-bottom:14px;}
  .foot-links li{margin-bottom:10px; font-size:.88rem;}
  .foot-links a:hover{color:var(--brass-light);}
  .foot-links h5{color:var(--paper); font-size:.95rem; margin-bottom:16px;}
  .bottom-bar{display:flex; justify-content:space-between; align-items:center; padding-top:26px; font-size:.8rem; flex-wrap:wrap; gap:14px;}
  .socials{display:flex; gap:12px;}
  .socials a{width:36px; height:36px; border-radius:50%; background:rgba(248,248,252,.08); display:flex; align-items:center; justify-content:center; transition:background .25s ease;}
  .socials a:hover{background:var(--brass);}
  .socials svg{width:16px; height:16px;}
  @media (max-width:980px){ .foot-grid{grid-template-columns:1fr 1fr;} }
  @media (max-width:560px){ .foot-grid{grid-template-columns:1fr;} }
</style>
@stack('styles')
</head>
<body>

<div class="topbar">
  <div class="wrap">
    <a class="logo" href="{{ route('home') }}">صنعة</a>
    <a class="back" href="{{ route('home') }}">→ رجوع للرئيسية</a>
  </div>
</div>

<main>
  <div class="wrap">
    @yield('content')
  </div>
</main>

@include('partials.footer')

</body>
</html>
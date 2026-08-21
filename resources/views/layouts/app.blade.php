<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'صنعة')</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet">
<style>
  :root{
    --ink:#2C3590; --ink-2:#3D47A8; --paper:#F8F8FC; --paper-2:#ECEDF6;
    --brass:#F7941D; --brass-light:#FDB65A; --stamp:#D9600B;
    --ok:#3E7A5E; --ok-bg:#E7F2EC; --warn:#B8860B; --warn-bg:#FCF1DA; --danger:#C0392B; --danger-bg:#FBEAE8;
    --text:#1B1E33; --text-soft:#585C74; --radius:16px;
    --shadow-sm: 0 10px 24px -12px rgba(44,53,144,.18);
  }
  *{margin:0;padding:0;box-sizing:border-box;}
  body{background:var(--paper); color:var(--text); font-family:'Cairo',sans-serif; min-height:100vh; display:flex; flex-direction:column;}
  a{color:inherit; text-decoration:none;}
  img{max-width:100%; display:block;}
  button, select, input, textarea{font-family:'Cairo',sans-serif;}

  .topbar{display:flex; align-items:center; justify-content:space-between; padding:18px 30px; background:#fff; border-bottom:2.5px solid rgba(44,53,144,.12);}
  .topbar .brand{display:flex; align-items:center; gap:10px; font-weight:900; font-size:1.1rem; color:var(--ink);}
  .topbar .mark{width:34px; height:34px; border-radius:10px; background:var(--brass); color:#fff; display:flex; align-items:center; justify-content:center; font-weight:900;}
  .topbar nav{display:flex; gap:18px; align-items:center; font-size:.85rem; font-weight:700; color:var(--text-soft);}
  .topbar nav a:hover{color:var(--ink);}
  .topbar .logout-form{display:flex; margin-inline-start:6px;}
  .topbar .logout-btn{
    display:flex; align-items:center; gap:6px;
    background-color:var(--danger-bg); border:2px solid var(--danger); border-radius:999px;
    padding:8px 16px; cursor:pointer; font-family:inherit; font-weight:700; font-size:.82rem;
    color:var(--danger); transition:background-color .15s ease, color .15s ease;
  }
  .topbar .logout-btn:hover{background-color:var(--danger) !important; color:#fff !important;}
  .topbar .logout-btn svg{width:16px; height:16px;}

  .content{max-width:960px; width:100%; margin:0 auto; padding:28px 20px 60px; flex:1;}
  .page-head{margin-bottom:22px;}
  .page-head h1{font-size:1.3rem; font-weight:900; margin-bottom:4px;}
  .page-head .sub{font-size:.85rem; color:var(--text-soft);}

  .card{background:#fff; border-radius:var(--radius); padding:22px; box-shadow:var(--shadow-sm); border:1px solid rgba(44,53,144,.06); margin-bottom:18px;}
  .card h3{font-size:1rem; font-weight:800; margin-bottom:14px;}

  .badge{display:inline-flex; align-items:center; gap:5px; font-size:.72rem; font-weight:800; padding:4px 10px; border-radius:999px;}
  .badge.ok{background:var(--ok-bg); color:var(--ok);}
  .badge.warn{background:var(--warn-bg); color:var(--warn);}
  .badge.danger{background:var(--danger-bg); color:var(--danger);}
  .badge.neutral{background:var(--paper-2); color:var(--ink);}

  .btn{display:inline-flex; align-items:center; gap:8px; border:none; border-radius:11px; padding:10px 16px; font-weight:800; font-size:.85rem; cursor:pointer;}
  .btn-primary{background:linear-gradient(120deg,var(--brass),var(--stamp)); color:#fff;}
  .btn-ghost{background:var(--paper-2); color:var(--ink);}
  .btn-danger{background:var(--danger-bg); color:var(--danger);}
  .btn-sm{padding:7px 12px; font-size:.78rem;}

  .form-field{margin-bottom:16px;}
  .form-field label{display:block; font-size:.82rem; font-weight:700; margin-bottom:7px;}
  .form-field input, .form-field select, .form-field textarea{
    width:100%; padding:11px 13px; border-radius:11px; border:1.5px solid rgba(44,53,144,.16); font-size:.9rem; outline:none;
  }
  .form-field input:focus, .form-field select:focus, .form-field textarea:focus{border-color:var(--brass);}
  .form-field .error{color:var(--danger); font-size:.78rem; margin-top:5px;}

  .flash{padding:13px 16px; border-radius:12px; margin-bottom:18px; font-size:.86rem; font-weight:700;}
  .flash.ok{background:var(--ok-bg); color:var(--ok);}
  .flash.err{background:var(--danger-bg); color:var(--danger);}

  .list-item{border-bottom:1px solid rgba(44,53,144,.06); padding:16px 0; display:flex; justify-content:space-between; align-items:flex-start; gap:14px;}
  .list-item:last-child{border-bottom:none;}
  .list-item b{display:block; font-size:.95rem; margin-bottom:4px;}
  .list-item p{font-size:.82rem; color:var(--text-soft); margin-bottom:6px;}
  .list-item .meta{font-size:.76rem; color:var(--text-soft);}

  .empty{text-align:center; padding:40px 20px; color:var(--text-soft); font-size:.88rem;}

  /* ---- contact / support style cards (لصفحات faq / support / contact / privacy) ---- */
  .contact-grid{display:grid; grid-template-columns:1fr 1fr; gap:18px; margin-top:10px;}
  .contact-grid .card{background:#fff; border-radius:var(--radius); padding:24px; box-shadow:var(--shadow-sm); border:1px solid rgba(44,53,144,.06);}
  .contact-grid .card h3{color:var(--ink); font-size:1.05rem; margin-bottom:8px; font-weight:800;}
  .contact-grid .card p{color:var(--text-soft); font-size:.9rem; line-height:1.8; margin-bottom:14px;}

  .contact-grid .card a.btn,
  .contact-grid .card a.btn:link,
  .contact-grid .card a.btn:visited{
    display:inline-block;
    background:var(--brass);
    color:#fff !important;
    text-decoration:none !important;
    padding:10px 20px;
    border-radius:12px;
    font-weight:800;
    font-size:.88rem;
    border:none;
    transition:background .2s ease, transform .15s ease;
  }
  .contact-grid .card a.btn:hover,
  .contact-grid .card a.btn:focus{
    background:var(--stamp);
    color:#fff !important;
    text-decoration:none !important;
    transform:translateY(-1px);
  }
  .contact-grid .card a.btn:active{
    transform:translateY(0);
  }

  @media (max-width:640px){ .contact-grid{grid-template-columns:1fr;} }

  /* ---- FAQ accordion (لصفحة faq) ---- */
  .faq-item{border-bottom:1px solid var(--paper-2); padding:18px 0;}
  .faq-item:last-child{border-bottom:none;}
  .faq-item summary{cursor:pointer; font-weight:700; font-size:1.02rem; color:var(--ink); list-style:none;}
  .faq-item summary::-webkit-details-marker{display:none;}
  .faq-item summary::after{content:"+"; float:left; font-size:1.3rem; color:var(--brass);}
  .faq-item[open] summary::after{content:"−";}
  .faq-item p{margin-top:12px; color:var(--text-soft); line-height:1.9;}
</style>
@stack('styles')
</head>
<body>

<div class="topbar">
  <a href="{{ route('home') }}" class="brand"><span class="mark">ص</span> صنعة</a>
  <nav>
    @auth
      @if(auth()->user()->role === 'client')
        <a href="{{ route('client.dashboard') }}">لوحة التحكم</a>
        <a href="{{ route('client.job-requests.index') }}">طلباتي</a>
        <a href="{{ route('client.job-requests.create') }}">اطلب صنايعي</a>
      @elseif(auth()->user()->role === 'worker')
        <a href="{{ route('worker.dashboard') }}">لوحة التحكم</a>
        <a href="{{ route('worker.job-requests.browse') }}">تصفح الطلبات</a>
        <a href="{{ route('worker.portfolio.index') }}">بورتفوليو</a>
      @endif
      <form method="POST" action="{{ route('logout') }}" class="logout-form">
        @csrf
        <button type="submit" class="logout-btn">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
          خروج
        </button>
      </form>
    @endauth
  </nav>
</div>

<div class="content">
  @if (session('status'))
    <div class="flash ok">{{ session('status') }}</div>
  @endif

  @yield('content')
</div>

{{-- استدعاء الفوتر المخصص لتطبيق صنعة --}}
@include('partials.footer')

</body>
</html>
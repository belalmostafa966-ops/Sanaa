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
  body{background:var(--paper); color:var(--text); font-family:'Cairo',sans-serif;}
  a{color:inherit; text-decoration:none;}
  img{max-width:100%; display:block;}
  button, select, input, textarea{font-family:'Cairo',sans-serif;}

  .topbar{display:flex; align-items:center; justify-content:space-between; padding:18px 30px; background:#fff; border-bottom:1px solid rgba(44,53,144,.08);}
  .topbar .brand{display:flex; align-items:center; gap:10px; font-weight:900; font-size:1.1rem; color:var(--ink);}
  .topbar .mark{width:34px; height:34px; border-radius:10px; background:var(--brass); color:#fff; display:flex; align-items:center; justify-content:center; font-weight:900;}
  .topbar nav{display:flex; gap:18px; align-items:center; font-size:.85rem; font-weight:700; color:var(--text-soft);}
  .topbar nav a:hover{color:var(--ink);}
  .topbar form button{background:none; border:none; cursor:pointer; font-family:inherit; font-weight:700; font-size:.85rem; color:var(--text-soft);}

  .content{max-width:960px; margin:0 auto; padding:28px 20px 60px;}
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
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">خروج</button>
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

</body>
</html>
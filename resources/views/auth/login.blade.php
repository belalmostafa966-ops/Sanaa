<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>تسجيل الدخول | صنعة</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
<style>
:root{
  --ink:#2C3590; --ink-2:#3D47A8; --paper:#F8F8FC;
  --brass:#F7941D; --stamp:#D9600B;
  --text:#1B1E33; --text-soft:#585C74;
  --danger:#C0392B;
  --radius:18px;
  --shadow-lg: 0 30px 60px -20px rgba(44,53,144,.30);
}
*{margin:0;padding:0;box-sizing:border-box;}
body{
  font-family:'Cairo',sans-serif; color:var(--text);
  min-height:100vh; display:flex; align-items:center; justify-content:center;
  padding:24px;
  background:
    radial-gradient(circle at 15% 20%, rgba(247,148,29,.18) 0, transparent 45%),
    radial-gradient(circle at 85% 80%, rgba(44,53,144,.25) 0, transparent 50%),
    linear-gradient(160deg,var(--ink),var(--ink-2));
}
a{color:inherit; text-decoration:none;}

.auth-card{
  width:100%; max-width:400px; background:var(--paper); border-radius:var(--radius);
  box-shadow:var(--shadow-lg); padding:40px 36px 34px; position:relative; overflow:hidden;
}
.auth-card::before{
  content:""; position:absolute; top:-40px; right:-40px; width:150px; height:150px; border-radius:50%;
  background:radial-gradient(circle, rgba(247,148,29,.22), transparent 70%);
}
.brand{display:flex; align-items:center; justify-content:center; gap:10px; margin-bottom:8px; position:relative; z-index:1;}
.brand b{font-weight:900; font-size:1.5rem; color:var(--ink);}
.sub{text-align:center; color:var(--text-soft); font-size:.92rem; margin-bottom:28px; position:relative; z-index:1;}

.field{margin-bottom:16px; position:relative; z-index:1;}
.field label{display:block; font-size:.84rem; font-weight:700; color:var(--text); margin-bottom:7px;}
.field input{
  width:100%; padding:12px 14px; border-radius:11px; border:1.5px solid rgba(44,53,144,.16);
  background:#fff; font-family:'Cairo',sans-serif; font-size:.94rem; color:var(--text); outline:none;
  transition:border-color .2s ease;
}
.field input:focus{border-color:var(--brass);}
.field .error{color:var(--danger); font-size:.78rem; font-weight:600; margin-top:6px;}

.remember-row{
  display:flex; align-items:center; gap:8px; margin:-4px 0 20px; font-size:.87rem; color:var(--text-soft);
  position:relative; z-index:1;
}
.remember-row input{width:16px; height:16px;}

.submit-btn{
  width:100%; border:none; border-radius:12px; padding:14px; cursor:pointer;
  font-family:'Cairo',sans-serif; font-weight:800; font-size:.98rem; color:#fff;
  background:linear-gradient(120deg,var(--brass),var(--stamp));
  box-shadow:0 12px 26px -10px rgba(217,96,11,.55);
  transition:transform .2s ease; position:relative; z-index:1;
}
.submit-btn:hover{transform:translateY(-2px);}

.auth-footer{text-align:center; margin-top:22px; font-size:.87rem; color:var(--text-soft); position:relative; z-index:1;}
.auth-footer a{color:var(--ink); font-weight:800; text-decoration:underline;}
</style>
</head>
<body>

<div class="auth-card">
  <div class="brand"><b>صنعة</b></div>
  <div class="sub">سجّل الدخول عشان تكمّل</div>

  <form action="{{ route('login') }}" method="POST">
    @csrf

    <div class="field">
      <label for="email">البريد الإلكتروني</label>
      <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="you@example.com">
      @error('email') <div class="error">{{ $message }}</div> @enderror
    </div>

    <div class="field">
      <label for="password">كلمة المرور</label>
      <input type="password" id="password" name="password" required placeholder="••••••••">
      @error('password') <div class="error">{{ $message }}</div> @enderror
    </div>

    <div class="remember-row">
      <input type="checkbox" id="remember" name="remember">
      <label for="remember">تذكرني على هذا الجهاز</label>
    </div>

    <button type="submit" class="submit-btn">دخول</button>
  </form>

  <div class="auth-footer">
    ليس لديك حساب؟ <a href="{{ route('register') }}">إنشاء حساب جديد</a>
  </div>
</div>

</body>
</html>
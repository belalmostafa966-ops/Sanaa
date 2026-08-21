<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- مهم: التاج ده لازم يكون موجود عشان أي AJAX request أو أي مشكلة سيشن تتحل -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>إنشاء حساب جديد | صنعة</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
<style>
:root{
  --ink:#2C3590; --ink-2:#3D47A8; --paper:#F8F8FC;
  --brass:#F7941D; --stamp:#D9600B;
  --text:#1B1E33; --text-soft:#585C74;
  --danger:#C0392B; --danger-bg:#FBEAE8;
  --radius:18px;
  --shadow-lg: 0 30px 60px -20px rgba(44,53,144,.30);
}
*{margin:0;padding:0;box-sizing:border-box;}
body{
  font-family:'Cairo',sans-serif; color:var(--text);
  min-height:100vh; display:flex; align-items:flex-start; justify-content:center;
  padding:24px;
  background:
    radial-gradient(circle at 15% 20%, rgba(247,148,29,.18) 0, transparent 45%),
    radial-gradient(circle at 85% 80%, rgba(44,53,144,.25) 0, transparent 50%),
    linear-gradient(160deg,var(--ink),var(--ink-2));
}
a{color:inherit; text-decoration:none;}

/* الكارد بقى مقفول على أقصى ارتفاع = ارتفاع الشاشة ناقص هامش بسيط،
   ولو المحتوى زاد (بسبب ظهور أخطاء) بيعمل سكرول جوه الكارد نفسه
   بدل ما يكبر الكارد ويكسر شكل الصفحة كلها */
.auth-card{
  width:100%; max-width:440px; background:var(--paper); border-radius:var(--radius);
  box-shadow:var(--shadow-lg); padding:40px 36px 34px; position:relative;
  max-height:calc(100vh - 48px); overflow-y:auto; overflow-x:hidden;
  margin-top:24px;
}
.auth-card::-webkit-scrollbar{width:6px;}
.auth-card::-webkit-scrollbar-thumb{background:rgba(44,53,144,.25); border-radius:10px;}
.auth-card::before{
  content:""; position:absolute; top:-40px; right:-40px; width:150px; height:150px; border-radius:50%;
  background:radial-gradient(circle, rgba(247,148,29,.22), transparent 70%);
}
.brand{display:flex; align-items:center; justify-content:center; gap:10px; margin-bottom:8px; position:relative; z-index:1;}
.brand b{font-weight:900; font-size:1.5rem; color:var(--ink);}
.sub{text-align:center; color:var(--text-soft); font-size:.92rem; margin-bottom:28px; position:relative; z-index:1;}

.field{margin-bottom:16px; position:relative; z-index:1;}
.field label{display:block; font-size:.84rem; font-weight:700; color:var(--text); margin-bottom:7px;}
.field input, .field select{
  width:100%; padding:12px 14px; border-radius:11px; border:1.5px solid rgba(44,53,144,.16);
  background:#fff; font-family:'Cairo',sans-serif; font-size:.94rem; color:var(--text); outline:none;
  transition:border-color .2s ease;
}
.field input:focus, .field select:focus{border-color:var(--brass);}
.field .error{color:var(--danger); font-size:.78rem; font-weight:600; margin-top:6px;}

.role-options{display:grid; grid-template-columns:1fr 1fr; gap:12px;}
.role-card{
  position:relative; border:1.5px solid rgba(44,53,144,.16); border-radius:12px; padding:14px 10px; text-align:center;
  cursor:pointer; transition:all .2s ease; background:#fff; display:block;
}
.role-card:hover{border-color:var(--brass);}
.role-card input{position:absolute; opacity:0; pointer-events:none;}
.role-card.checked{border-color:var(--brass); background:rgba(247,148,29,.08); box-shadow:0 0 0 1px var(--brass);}
.role-card .emoji{font-size:1.5rem; display:block; margin-bottom:6px;}
.role-card span.label{font-size:.84rem; font-weight:700; color:var(--ink);}

.submit-btn{
  width:100%; border:none; border-radius:12px; padding:14px; cursor:pointer; margin-top:6px;
  font-family:'Cairo',sans-serif; font-weight:800; font-size:.98rem; color:#fff;
  background:linear-gradient(120deg,var(--brass),var(--stamp));
  box-shadow:0 12px 26px -10px rgba(217,96,11,.55);
  transition:transform .2s ease; position:relative; z-index:1;
}
.submit-btn:hover{transform:translateY(-2px);}
.submit-btn:disabled{opacity:.6; cursor:not-allowed; transform:none;}

.auth-footer{text-align:center; margin-top:22px; font-size:.87rem; color:var(--text-soft); position:relative; z-index:1;}
.auth-footer a{color:var(--ink); font-weight:800; text-decoration:underline;}

/* صندوق تنبيه لو فيه أخطاء عامة (مثلاً من الـ Controller) */
.alert-box{
  background:var(--danger-bg); border:1px solid rgba(192,57,43,.25); color:var(--danger);
  border-radius:10px; padding:12px 14px; font-size:.85rem; font-weight:600; margin-bottom:18px;
  position:relative; z-index:1;
}
.alert-box ul{padding-inline-start:18px; margin-top:4px;}
</style>
</head>
<body>

<div class="auth-card">
  <div class="brand"><b>صنعة</b></div>
  <div class="sub">اعمل حسابك في دقيقة وابدأ مع صنعة</div>

  {{-- لو فيه أخطاء عامة (session/CSRF/طوابع) هتظهر هنا بدل ما الصفحة تبقى فاضية --}}
  @if ($errors->any())
    <div class="alert-box">
      <strong>في مشكلة في البيانات:</strong>
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  @if (session('error'))
    <div class="alert-box">{{ session('error') }}</div>
  @endif

  <form action="{{ route('register') }}" method="POST" id="registerForm">
    @csrf

    <div class="field">
      <label for="name">الاسم الكامل</label>
      <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus placeholder="مثال: محمد أحمد">
      @error('name') <div class="error">{{ $message }}</div> @enderror
    </div>

    <div class="field">
      <label for="email">البريد الإلكتروني</label>
      <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="you@example.com">
      @error('email') <div class="error">{{ $message }}</div> @enderror
    </div>

    <div class="field">
      <label>نوع الحساب</label>
      <div class="role-options">
        <label class="role-card {{ old('role', request('role')) == 'worker' ? 'checked' : '' }}" id="roleWorkerCard">
          <input type="radio" name="role" value="worker" {{ old('role', request('role')) == 'worker' ? 'checked' : '' }} onchange="updateRoleUI()">
          <span class="emoji">🛠️</span>
          <span class="label">صنايعي</span>
        </label>
        <label class="role-card {{ old('role', request('role')) == 'client' ? 'checked' : '' }}" id="roleClientCard">
          <input type="radio" name="role" value="client" {{ old('role', request('role')) == 'client' ? 'checked' : '' }} onchange="updateRoleUI()">
          <span class="emoji">🧑‍💼</span>
          <span class="label">عميل</span>
        </label>
      </div>
      @error('role') <div class="error">{{ $message }}</div> @enderror
    </div>

    <div class="field">
      <label for="password">كلمة المرور</label>
      <input type="password" id="password" name="password" required placeholder="••••••••">
      @error('password') <div class="error">{{ $message }}</div> @enderror
    </div>

    <div class="field">
      <label for="password_confirmation">تأكيد كلمة المرور</label>
      <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="••••••••">
    </div>

    <button type="submit" class="submit-btn" id="submitBtn">إنشاء الحساب</button>
  </form>

  <div class="auth-footer">
    لديك حساب بالفعل؟ <a href="{{ route('login') }}">تسجيل الدخول</a>
  </div>
</div>

<script>
function updateRoleUI(){
  document.getElementById('roleClientCard').classList.toggle('checked', document.querySelector('input[name=role][value=client]').checked);
  document.getElementById('roleWorkerCard').classList.toggle('checked', document.querySelector('input[name=role][value=worker]').checked);
}
// يمنع دبل-سبمشن ويوريك إن الفورم فعلاً بيتبعت
document.getElementById('registerForm').addEventListener('submit', function(){
  document.getElementById('submitBtn').disabled = true;
  document.getElementById('submitBtn').innerText = 'جاري الإنشاء...';
});
</script>
</body>
</html>
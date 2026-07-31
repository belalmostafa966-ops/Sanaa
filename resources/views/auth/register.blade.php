<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إنشاء حساب جديد - صنعة</title>
    <style>
        body { font-family: system-ui, -apple-system, sans-serif; background-color: #f4f6f9; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }
        .auth-card { background: #fff; padding: 2.5rem; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.08); width: 100%; max-width: 420px; }
        .auth-card h2 { text-align: center; color: #1e3a8a; margin-bottom: 1.5rem; }
        .form-group { margin-bottom: 1.25rem; }
        .form-group label { display: block; margin-bottom: 0.5rem; font-weight: 600; color: #374151; }
        .form-control { width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px; box-sizing: border-box; font-size: 1rem; }
        .form-control:focus { outline: none; border-color: #1e3a8a; }
        .btn-primary { width: 100%; padding: 0.85rem; background-color: #1e3a8a; color: white; border: none; border-radius: 8px; font-weight: bold; font-size: 1rem; cursor: pointer; }
        .btn-primary:hover { background-color: #1d4ed8; }
        .error-text { color: #dc2626; font-size: 0.875rem; margin-top: 0.25rem; }
        .auth-footer { text-align: center; margin-top: 1.5rem; font-size: 0.9rem; color: #6b7280; }
        .auth-footer a { color: #1e3a8a; text-decoration: none; font-weight: 600; }
    </style>
</head>
<body>

<div class="auth-card">
    <h2>إنشاء حساب جديد</h2>

    <form action="{{ route('register') }}" method="POST">
        @csrf

        <!-- الاسم -->
        <div class="form-group">
            <label for="name">الاسم الكامل</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required autofocus>
            @error('name')
                <div class="error-text">{{ $message }}</div>
            @enderror
        </div>

        <!-- البريد الإلكتروني -->
        <div class="form-group">
            <label for="email">البريد الإلكتروني</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
            @error('email')
                <div class="error-text">{{ $message }}</div>
            @enderror
        </div>

        <!-- نوع الحساب (Role) -->
        <div class="form-group">
            <label for="role">نوع الحساب</label>
            <select id="role" name="role" class="form-control" required>
                <option value="" disabled selected>اختر نوع الحساب...</option>
                <option value="client" {{ old('role') == 'client' ? 'selected' : '' }}>عميل (طالب خدمة)</option>
                <option value="worker" {{ old('role') == 'worker' ? 'selected' : '' }}>صنايعي / فني</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>مسؤول (Admin)</option>
            </select>
            @error('role')
                <div class="error-text">{{ $message }}</div>
            @enderror
        </div>

        <!-- كلمة المرور -->
        <div class="form-group">
            <label for="password">كلمة المرور</label>
            <input type="password" id="password" name="password" class="form-control" required>
            @error('password')
                <div class="error-text">{{ $message }}</div>
            @enderror
        </div>

        <!-- تأكيد كلمة المرور -->
        <div class="form-group">
            <label for="password_confirmation">تأكيد كلمة المرور</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn-primary">إنشاء الحساب</button>
    </form>

    <div class="auth-footer">
        لديك حساب بالفعل؟ <a href="{{ route('login') }}">تسجيل الدخول</a>
    </div>
</div>

</body>
</html>
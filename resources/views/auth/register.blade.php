<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إنشاء حساب جديد</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>

    <div class="auth-container">
        <h2>إنشاء حساب جديد</h2>

        <form action="{{ route('register') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">الاسم بالكامل</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                @error('name') <span class="error-message">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="email">البريد الإلكتروني</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                @error('email') <span class="error-message">{{ $message }}</span> @enderror
            </div>

            <!-- اختيار نوع الحساب -->
            <div class="form-group">
                <label for="role">نوع الحساب</label>
                <select id="role" name="role" required style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px; outline: none;">
                    <option value="" disabled selected>اختر نوع الحساب...</option>
                    <option value="client" {{ old('role') == 'client' ? 'selected' : '' }}>عميل (أبحث عن صنايعي)</option>
                    <option value="worker" {{ old('role') == 'worker' ? 'selected' : '' }}>صنايعي (أقدم خدمات)</option>
                </select>
                @error('role') <span class="error-message">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="password">كلمة السر</label>
                <input type="password" id="password" name="password" required>
                @error('password') <span class="error-message">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">تأكيد كلمة السر</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>

            <button type="submit" class="btn-primary">إنشاء الحساب</button>
        </form>

        <div class="auth-footer">
            <p>عندك حساب بالفعل؟ <a href="{{ route('login') }}">تسجيل الدخول</a></p>
        </div>
    </div>

</body>
</html>
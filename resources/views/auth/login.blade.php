<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول</title>
    <!-- استدعاء ملف الـ CSS -->
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>

    <div class="auth-container">
        <h2>تسجيل الدخول</h2>

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="email">البريد الإلكتروني</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
                @error('email') 
                    <span class="error-message">{{ $message }}</span> 
                @enderror
            </div>

            <div class="form-group">
                <label for="password">كلمة السر</label>
                <input type="password" id="password" name="password" required>
                @error('password') 
                    <span class="error-message">{{ $message }}</span> 
                @enderror
            </div>

            <div class="checkbox-group">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">تذكرني</label>
            </div>

            <button type="submit" class="btn-primary">دخول</button>
        </form>

        <div class="auth-footer">
            <p>معندكش حساب؟ <a href="{{ route('register') }}">حساب جديد</a></p>
        </div>
    </div>

</body>
</html>
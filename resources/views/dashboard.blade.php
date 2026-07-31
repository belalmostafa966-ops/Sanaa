<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>لوحة التحكم</title>
</head>
<body>
    <h1>أهلاً بك، {{ auth()->user()->name }} 👋</h1>

    <!-- زر تسجيل الخروج لازم يكون داخل Form وبيبعت POST -->
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">تسجيل الخروج</button>
    </form>
</body>
</html>
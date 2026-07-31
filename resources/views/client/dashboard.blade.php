<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>لوحة العميل</title>
</head>
<body>
    <h1>مرحباً بك عزيزي العميل: {{ auth()->user()->name }} 🛠️</h1>
    <p>هنا تقدر تبحث عن الصنايعية وتطلب خدماتهم.</p>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">تسجيل الخروج</button>
    </form>
</body>
</html>
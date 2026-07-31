<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>لوحة الصنايعي</title>
</head>
<body>
    <h1>أهلاً بك يا أسطى: {{ auth()->user()->name }} 🔧</h1>
    <p>هنا تقدر تشوف الطلبات المقدمة لك وتدير أعمالك.</p>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">تسجيل الخروج</button>
    </form>
</body>
</html>
<!-- admin dashboard view -->

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>لوحة تحكم الأدمن | صنعة</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>

<div class="app-shell">

    <!-- ---------- Sidebar ---------- -->
    <aside class="sidebar" id="sidebar">
        <div class="sb-brand">
            <div class="mark">ص</div>
            <div>
                <b>صنعة</b>
                <span>لوحة التحكم</span>
            </div>
        </div>

        <button class="sb-link active" type="button">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 12l9-9 9 9M4 10v10h6v-6h4v6h6V10"/></svg>
            الرئيسية
        </button>
        <button class="sb-link" type="button">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2M9 11a4 4 0 100-8 4 4 0 000 8zM23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
            المستخدمين
        </button>
        <button class="sb-link" type="button">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 12l2 2 4-4M12 3l8 4-8 4-8-4 8-4zM4 11v6l8 4 8-4v-6"/></svg>
            الصنايعية
        </button>
        <button class="sb-link" type="button">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18v12H3zM3 10h18"/></svg>
            الطلبات
        </button>

        <div class="sb-spacer"></div>

        <!-- ---------- Logout Form ---------- -->
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="sb-link">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4M16 17l5-5-5-5M21 12H9"/></svg>
                تسجيل الخروج
            </button>
        </form>

        <div class="sb-foot">© {{ date('Y') }} صنعة — لوحة الإدارة</div>
    </aside>

    <!-- ---------- Main ---------- -->
    <div class="main">
        <div class="topbar">
            <div style="display:flex; align-items:center; gap:14px;">
                <button class="menu-toggle" id="menuToggle" aria-label="القائمة">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
                <div>
                    <h1>لوحة التحكم</h1>
                    <div class="sub">نظرة عامة على المنصة</div>
                </div>
            </div>
            <div class="user-info">
                أهلاً، <b>{{ auth()->user()->name ?? 'الأدمن' }}</b>
            </div>
        </div>

        <div class="content">

            @if(session('success'))
                <div class="alert-box alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert-box alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- ---------- Stats ---------- -->
            <div class="grid cols-4">
                <div class="card stat-card">
                    <div class="icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2M9 11a4 4 0 100-8 4 4 0 000 8z"/></svg>
                    </div>
                    <div class="num">{{ $usersCount ?? 0 }}</div>
                    <div class="lbl">إجمالي المستخدمين</div>
                </div>
                <div class="card stat-card">
                    <div class="icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 12l2 2 4-4M12 3l8 4-8 4-8-4 8-4zM4 11v6l8 4 8-4v-6"/></svg>
                    </div>
                    <div class="num">{{ $craftsmenCount ?? 0 }}</div>
                    <div class="lbl">الصنايعية الموثّقين</div>
                </div>
                <div class="card stat-card">
                    <div class="icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18v12H3zM3 10h18"/></svg>
                    </div>
                    <div class="num">{{ $ordersCount ?? 0 }}</div>
                    <div class="lbl">الطلبات النشطة</div>
                </div>
                <div class="card stat-card">
                    <div class="icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg>
                    </div>
                    <div class="num">{{ $revenue ?? 0 }} ج.م</div>
                    <div class="lbl">الإيرادات هذا الشهر</div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.getElementById('sidebar');
    if (menuToggle) {
        menuToggle.addEventListener('click', () => sidebar.classList.toggle('open'));
    }
</script>
</body>
</html>
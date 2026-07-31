<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة تحكم الأدمن | صنعة</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet">
    
    {{-- ربط ملف الـ CSS --}}
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>

<!-- ---------- ADMIN DASHBOARD ---------- -->
<div class="app-shell" id="appShell">
    <aside class="sidebar" id="sidebar">
        <div class="sb-brand">
            <div class="mark">ص</div>
            <div><b>صنعة</b><span>لوحة الأدمن</span></div>
        </div>
        
        <button class="sb-link active" data-view="overview" onclick="showView('overview', this)">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3v18h18"/><path d="M7 15l4-4 3 3 5-6"/></svg>
            نظرة عامة
        </button>
        <button class="sb-link" data-view="approvals" onclick="showView('approvals', this)">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 6L9 17l-5-5"/></svg>
            اعتماد الصنايعية
        </button>
        <button class="sb-link" data-view="users" onclick="showView('users', this)">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            المستخدمين
        </button>
        <button class="sb-link" data-view="disputes" onclick="showView('disputes', this)">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><path d="M12 9v4M12 17h.01"/></svg>
            النزاعات
        </button>
        <button class="sb-link" data-view="payments" onclick="showView('payments', this)">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 10h20"/></svg>
            المدفوعات
        </button>
        
        <div class="sb-spacer"></div>
        
        {{-- فورم تسجيل الخروج --}}
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="sb-link">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><path d="M16 17l5-5-5-5"/><path d="M21 12H9"/></svg>
                خروج
            </button>
        </form>
        
        <div class="sb-foot">صنعة © {{ date('Y') }}</div>
    </aside>

    <main class="main">
        <div class="topbar">
            <div style="display:flex; align-items:center; gap:14px;">
                <button class="menu-toggle" onclick="document.getElementById('sidebar').classList.toggle('open')">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
                <div>
                    <h1 id="pageTitle">نظرة عامة</h1>
                    <div class="sub" id="pageSub">أداء المنصة ككل</div>
                </div>
            </div>
            
            {{-- اسم الأدمن اللي مسجل دخول --}}
            <div class="user-info">
                مرحباً، <b>{{ auth()->user()->name ?? 'الأدمن' }}</b>
            </div>
        </div>

        <div class="content">

            {{-- هندلة الأخطاء والرسائل --}}
            @if ($errors->any())
                <div class="alert-box alert-danger">
                    <ul style="padding-right: 20px; list-style-type: disc;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="alert-box alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert-box alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <!-- ---------- OVERVIEW ---------- -->
            <div class="view active" id="view-overview">
                <div class="grid cols-4" style="margin-bottom:20px;">
                    <div class="card stat-card">
                        <div class="icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="12" cy="7" r="4"/><path d="M5.5 21a6.5 6.5 0 0 1 13 0"/></svg></div>
                        <div class="num">0</div>
                        <div class="lbl">إجمالي العملاء</div>
                    </div>
                    <div class="card stat-card">
                        <div class="icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg></div>
                        <div class="num">0</div>
                        <div class="lbl">إجمالي الصنايعية</div>
                    </div>
                    <div class="card stat-card">
                        <div class="icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2"/></svg></div>
                        <div class="num">0</div>
                        <div class="lbl">طلبات الشهر ده</div>
                    </div>
                    <div class="card stat-card">
                        <div class="icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M12 1v22M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg></div>
                        <div class="num">0</div>
                        <div class="lbl">صافي عمولة صنعة (ج.م)</div>
                    </div>
                </div>
            </div>

            <!-- ---------- باقي الأقسام (مؤقتاً فاضية لحد ما نربطها بالداتابيز) ---------- -->
            <div class="view" id="view-approvals">
                <div class="card">
                    <h3>طلبات اعتماد الصنايعية</h3>
                    <p style="color: var(--text-soft); font-size: 0.9rem;">سيتم جلب البيانات من قاعدة البيانات هنا...</p>
                </div>
            </div>

            <div class="view" id="view-users">
                <div class="card">
                    <h3>كل المستخدمين</h3>
                    <p style="color: var(--text-soft); font-size: 0.9rem;">سيتم جلب البيانات من قاعدة البيانات هنا...</p>
                </div>
            </div>

            <div class="view" id="view-disputes">
                <div class="card">
                    <h3>النزاعات المفتوحة</h3>
                    <p style="color: var(--text-soft); font-size: 0.9rem;">سيتم جلب البيانات من قاعدة البيانات هنا...</p>
                </div>
            </div>

            <div class="view" id="view-payments">
                <div class="card">
                    <h3>آخر المدفوعات على المنصة</h3>
                    <p style="color: var(--text-soft); font-size: 0.9rem;">سيتم جلب البيانات من قاعدة البيانات هنا...</p>
                </div>
            </div>

        </div>
    </main>
</div>

<script>
    // سكربت بسيط للتبديل بين التابات (الـ Views)
    function showView(id, el) {
        document.querySelectorAll('.view').forEach(v => v.classList.remove('active'));
        document.getElementById('view-' + id).classList.add('active');
        document.querySelectorAll('.sb-link[data-view]').forEach(a => a.classList.remove('active'));
        if(el) el.classList.add('active');
        
        const titles = {
            overview: ['نظرة عامة', 'أداء المنصة ككل'],
            approvals: ['اعتماد الصنايعية', 'راجع بيانات الصنايعي قبل ما يشتغل على المنصة'],
            users: ['المستخدمين', 'كل العملاء والصنايعية المسجلين'],
            disputes: ['النزاعات', 'متابعة أي خلاف بين عميل وصنايعي'],
            payments: ['المدفوعات', 'كل المعاملات المالية على المنصة'],
        };
        
        document.getElementById('pageTitle').textContent = titles[id][0];
        document.getElementById('pageSub').textContent = titles[id][1];
        document.getElementById('sidebar').classList.remove('open');
    }
</script>

</body>
</html>
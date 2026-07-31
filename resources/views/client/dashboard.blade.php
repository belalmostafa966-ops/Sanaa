<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>لوحة العميل | صنعة</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet">
<style>
  :root{
    --ink:#2C3590; --ink-2:#3D47A8; --paper:#F8F8FC; --paper-2:#ECEDF6;
    --brass:#F7941D; --brass-light:#FDB65A; --stamp:#D9600B;
    --ok:#3E7A5E; --ok-bg:#E7F2EC; --warn:#B8860B; --warn-bg:#FCF1DA; --danger:#C0392B; --danger-bg:#FBEAE8;
    --text:#1B1E33; --text-soft:#585C74; --radius:16px;
    --shadow-lg: 0 30px 60px -20px rgba(44,53,144,.25);
    --shadow-sm: 0 10px 24px -12px rgba(44,53,144,.18);
  }
  *{margin:0;padding:0;box-sizing:border-box;}
  body{background:var(--paper); color:var(--text); font-family:'Cairo',sans-serif; -webkit-font-smoothing:antialiased;}
  a{color:inherit; text-decoration:none;}
  ul{list-style:none;}
  img{max-width:100%; display:block;}
  button, select, input, textarea{font-family:'Cairo',sans-serif;}

  .app-shell{display:flex; min-height:100vh;}

  /* ---------- sidebar ---------- */
  .sidebar{
    width:260px; flex:none; background:linear-gradient(180deg,var(--ink),var(--ink-2)); color:#fff;
    padding:26px 20px; display:flex; flex-direction:column; gap:6px; position:sticky; top:0; height:100vh;
  }
  .sb-brand{display:flex; align-items:center; gap:10px; margin-bottom:26px; padding:0 4px;}
  .sb-brand .mark{width:36px; height:36px; border-radius:10px; background:var(--brass); display:flex; align-items:center; justify-content:center; font-weight:900; color:#fff; flex:none;}
  .sb-brand b{font-size:1.15rem; font-weight:900;}
  .sb-brand span{display:block; font-size:.7rem; opacity:.7;}
  .sb-link{
    display:flex; align-items:center; gap:12px; padding:11px 12px; border-radius:11px; font-size:.9rem; font-weight:700;
    color:rgba(255,255,255,.78); cursor:pointer; transition:background .2s, color .2s;
  }
  .sb-link svg{width:18px; height:18px; flex:none;}
  .sb-link:hover{background:rgba(255,255,255,.08); color:#fff;}
  .sb-link.active{background:rgba(255,255,255,.14); color:#fff; box-shadow:inset 0 0 0 1px rgba(255,255,255,.1);}
  .sb-spacer{flex:1;}
  .sb-foot{font-size:.72rem; opacity:.55; padding:0 4px;}

  /* ---------- main ---------- */
  .main{flex:1; min-width:0;}
  .topbar{
    display:flex; align-items:center; justify-content:space-between; padding:18px 30px;
    background:#fff; border-bottom:1px solid rgba(44,53,144,.08); position:sticky; top:0; z-index:5;
  }
  .topbar h1{font-size:1.15rem; font-weight:800;}
  .topbar .sub{font-size:.78rem; color:var(--text-soft); margin-top:2px;}
  .user-chip{display:flex; align-items:center; gap:10px;}
  .user-chip .av{width:38px; height:38px; border-radius:50%; background:var(--paper-2); display:flex; align-items:center; justify-content:center; font-weight:800; color:var(--ink);}
  .user-chip .info b{display:block; font-size:.85rem;}
  .user-chip .info span{font-size:.72rem; color:var(--text-soft);}

  .content{padding:28px 30px 60px;}
  .view{display:none;}
  .view.active{display:block; animation:fadeIn .35s ease;}
  @keyframes fadeIn{from{opacity:0; transform:translateY(8px);} to{opacity:1; transform:translateY(0);}}

  .grid{display:grid; gap:20px;}
  .grid.cols-3{grid-template-columns:repeat(3,1fr);}
  .grid.cols-2{grid-template-columns:2fr 1fr;}

  .card{background:#fff; border-radius:var(--radius); padding:22px; box-shadow:var(--shadow-sm); border:1px solid rgba(44,53,144,.06);}
  .card h3{font-size:1rem; font-weight:800; margin-bottom:14px;}
  .stat-card .num{font-family:'JetBrains Mono',monospace; font-size:1.9rem; font-weight:700; color:var(--ink);}
  .stat-card .lbl{font-size:.8rem; color:var(--text-soft); margin-top:4px;}
  .stat-card .icon{width:38px; height:38px; border-radius:10px; background:var(--paper-2); display:flex; align-items:center; justify-content:center; margin-bottom:12px;}
  .stat-card .icon svg{width:19px; height:19px; color:var(--brass);}

  .badge{display:inline-flex; align-items:center; gap:5px; font-size:.72rem; font-weight:800; padding:4px 10px; border-radius:999px;}
  .badge.ok{background:var(--ok-bg); color:var(--ok);}
  .badge.warn{background:var(--warn-bg); color:var(--warn);}
  .badge.danger{background:var(--danger-bg); color:var(--danger);}

  table{width:100%; border-collapse:collapse; font-size:.86rem;}
  th{text-align:right; color:var(--text-soft); font-weight:700; font-size:.78rem; padding:10px 12px; border-bottom:1px solid rgba(44,53,144,.08);}
  td{padding:13px 12px; border-bottom:1px solid rgba(44,53,144,.06);}
  tr:last-child td{border-bottom:none;}

  .btn{display:inline-flex; align-items:center; gap:8px; border:none; border-radius:11px; padding:11px 18px; font-weight:800; font-size:.86rem; cursor:pointer; transition:transform .2s;}
  .btn:hover{transform:translateY(-2px);}
  .btn-primary{background:linear-gradient(120deg,var(--brass),var(--stamp)); color:#fff;}
  .btn-ghost{background:var(--paper-2); color:var(--ink);}
  .btn-sm{padding:7px 14px; font-size:.78rem;}

  .track-box{background:var(--paper-2); border-radius:14px; padding:20px; display:flex; align-items:center; gap:16px;}
  .track-map{width:90px; height:90px; border-radius:12px; background:linear-gradient(135deg,var(--ink),var(--ink-2)); flex:none; display:flex; align-items:center; justify-content:center;}
  .track-map svg{width:34px; height:34px; color:var(--brass-light);}
  .track-info b{display:block; font-size:.95rem; margin-bottom:4px;}
  .track-info span{font-size:.8rem; color:var(--text-soft); display:block; margin-bottom:2px;}
  .progress{height:6px; background:rgba(44,53,144,.1); border-radius:99px; margin-top:10px; overflow:hidden;}
  .progress i{display:block; height:100%; background:var(--ok); width:62%; border-radius:99px;}

  .form-field{margin-bottom:16px;}
  .form-field label{display:block; font-size:.82rem; font-weight:700; margin-bottom:7px;}
  .form-field input, .form-field select, .form-field textarea{
    width:100%; padding:11px 13px; border-radius:11px; border:1.5px solid rgba(44,53,144,.16); font-size:.9rem; outline:none;
  }
  .form-field input:focus, .form-field select:focus, .form-field textarea:focus{border-color:var(--brass);}

  .receipt{
    border:1.5px dashed rgba(44,53,144,.2); border-radius:12px; padding:16px; display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;
  }
  .receipt b{display:block; font-size:.88rem;}
  .receipt span{font-size:.76rem; color:var(--text-soft);}
  .receipt .amount{font-family:'JetBrains Mono',monospace; font-weight:700; color:var(--ink); font-size:1.05rem;}

  .wallet-chip{display:flex; align-items:center; gap:12px; background:var(--paper-2); border-radius:12px; padding:14px 16px; margin-bottom:14px;}
  .wallet-chip .ic{width:36px; height:36px; border-radius:9px; background:#fff; display:flex; align-items:center; justify-content:center; color:var(--brass);}

  .empty{text-align:center; padding:40px 20px; color:var(--text-soft);}

  @media (max-width: 900px){
    .sidebar{position:fixed; right:-280px; z-index:50; transition:right .25s ease; box-shadow:var(--shadow-lg);}
    .sidebar.open{right:0;}
    .grid.cols-3, .grid.cols-2{grid-template-columns:1fr;}
    .menu-toggle{display:flex !important;}
  }
  .menu-toggle{display:none; border:none; background:var(--paper-2); border-radius:10px; width:38px; height:38px; align-items:center; justify-content:center; cursor:pointer;}
</style>
</head>
<body>

<div class="app-shell">
  <aside class="sidebar" id="sidebar">
    <div class="sb-brand">
      <div class="mark">ص</div>
      <div><b>صنعة</b><span>لوحة العميل</span></div>
    </div>
    <a class="sb-link active" data-view="home" onclick="showView('home', this)">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 11l9-8 9 8"/><path d="M5 10v10h14V10"/></svg>
      الرئيسية
    </a>
    <a class="sb-link" data-view="requests" onclick="showView('requests', this)">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2"/><rect x="9" y="3" width="6" height="4" rx="1"/></svg>
      طلباتي
    </a>
    <a class="sb-link" data-view="new" onclick="showView('new', this)">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v14M5 12h14"/></svg>
      اطلب صنايعي جديد
    </a>
    <a class="sb-link" data-view="payments" onclick="showView('payments', this)">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 10h20"/></svg>
      الدفعات والإيصالات
    </a>
    <a class="sb-link" data-view="settings" onclick="showView('settings', this)">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.6 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.6a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
      الإعدادات
    </a>
    <div class="sb-spacer"></div>
    <a class="sb-link" href="index.html">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><path d="M16 17l5-5-5-5"/><path d="M21 12H9"/></svg>
      تسجيل خروج
    </a>
    <div class="sb-foot">صنعة © 2026</div>
  </aside>

  <main class="main">
    <div class="topbar">
      <div style="display:flex; align-items:center; gap:14px;">
        <button class="menu-toggle" onclick="document.getElementById('sidebar').classList.toggle('open')">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
        <div>
          <h1 id="pageTitle">أهلاً بيك 👋</h1>
          <div class="sub" id="pageSub">ده ملخص حسابك مع صنعة</div>
        </div>
      </div>
      <div class="user-chip">
        <div class="info" style="text-align:left;">
          <b id="userNameChip">عميل صنعة</b>
          <span id="userPhoneChip">—</span>
        </div>
        <div class="av" id="userAvatar">ع</div>
      </div>
    </div>

    <div class="content">

      <!-- ---------- HOME ---------- -->
      <div class="view active" id="view-home">
        <div class="grid cols-3" style="margin-bottom:20px;">
          <div class="card stat-card">
            <div class="icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2"/></svg></div>
            <div class="num">3</div>
            <div class="lbl">طلبات جارية</div>
          </div>
          <div class="card stat-card">
            <div class="icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M20 6L9 17l-5-5"/></svg></div>
            <div class="num">11</div>
            <div class="lbl">طلبات اتعملت وخلصت</div>
          </div>
          <div class="card stat-card">
            <div class="icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 10h20"/></svg></div>
            <div class="num">2,450</div>
            <div class="lbl">إجمالي مدفوع (ج.م)</div>
          </div>
        </div>

        <div class="grid cols-2">
          <div class="card">
            <h3>صنايعي في الطريق دلوقتي</h3>
            <div class="track-box">
              <div class="track-map">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 6-9 12-9 12S3 16 3 10a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
              </div>
              <div class="track-info">
                <b>أحمد سعيد — سباك</b>
                <span>على بعد 1.8 كم منك، هيوصل خلال ~12 دقيقة</span>
                <span>الطلب: تسريب مياه — الحي التاسع</span>
                <div class="progress"><i></i></div>
              </div>
            </div>
            <div style="margin-top:14px; display:flex; gap:10px;">
              <button class="btn btn-primary btn-sm">تتبّع على الخريطة</button>
              <button class="btn btn-ghost btn-sm">تواصل مع الصنايعي</button>
            </div>
          </div>
          <div class="card">
            <h3>آخر إيصال</h3>
            <div class="receipt">
              <div>
                <b>تصليح تكييف</b>
                <span>25 يوليو 2026 — كريم فتحي</span>
              </div>
              <div class="amount">350 ج.م</div>
            </div>
            <button class="btn btn-ghost btn-sm" style="width:100%; justify-content:center;" onclick="showView('payments', document.querySelector('[data-view=payments]'))">كل الإيصالات</button>
          </div>
        </div>
      </div>

      <!-- ---------- REQUESTS ---------- -->
      <div class="view" id="view-requests">
        <div class="card">
          <h3>طلباتي</h3>
          <table>
            <thead><tr><th>الخدمة</th><th>الصنايعي</th><th>التاريخ</th><th>الحالة</th><th></th></tr></thead>
            <tbody id="requestsTableBody"></tbody>
          </table>
        </div>
      </div>

      <!-- ---------- NEW REQUEST ---------- -->
      <div class="view" id="view-new">
        <div class="card" style="max-width:520px;">
          <h3>اطلب صنايعي جديد</h3>
          <form onsubmit="return submitNewRequest(event)">
            <div class="form-field">
              <label>نوع الخدمة</label>
              <select id="reqService" required>
                <option value="">اختار الخدمة</option>
                <option>سباكة</option><option>كهرباء</option><option>نجارة</option>
                <option>دهانات</option><option>تكييف وتبريد</option><option>حاجة تانية</option>
              </select>
            </div>
            <div class="form-field">
              <label>المنطقة</label>
              <input type="text" id="reqArea" placeholder="مثال: التجمع الخامس" required>
            </div>
            <div class="form-field">
              <label>وصف المشكلة</label>
              <textarea id="reqDesc" rows="4" placeholder="اشرح المشكلة باختصار..."></textarea>
            </div>
            <button type="submit" class="btn btn-primary" style="width:100%; justify-content:center;">ابعت الطلب</button>
          </form>
        </div>
      </div>

      <!-- ---------- PAYMENTS ---------- -->
      <div class="view" id="view-payments">
        <div class="grid cols-2">
          <div class="card">
            <h3>الإيصالات</h3>
            <div class="receipt"><div><b>تصليح تكييف</b><span>25 يوليو 2026 — كريم فتحي</span></div><div class="amount">350 ج.م</div></div>
            <div class="receipt"><div><b>تسليك حمام</b><span>14 يوليو 2026 — محمود عادل</span></div><div class="amount">180 ج.م</div></div>
            <div class="receipt"><div><b>دهان غرفة</b><span>2 يوليو 2026 — عمرو حسن</span></div><div class="amount">620 ج.م</div></div>
          </div>
          <div class="card">
            <h3>وسيلة الدفع المحفوظة</h3>
            <div id="walletDisplay"></div>
            <button class="btn btn-ghost btn-sm" style="width:100%; justify-content:center;" onclick="showView('settings', document.querySelector('[data-view=settings]'))">تعديل وسيلة الدفع</button>
          </div>
        </div>
      </div>

      <!-- ---------- SETTINGS ---------- -->
      <div class="view" id="view-settings">
        <div class="card" style="max-width:520px;">
          <h3>إعدادات الحساب</h3>
          <div class="form-field">
            <label>الاسم</label>
            <input type="text" id="setName">
          </div>
          <div class="form-field">
            <label>رقم الموبايل</label>
            <input type="tel" id="setPhone">
          </div>
          <div class="form-field">
            <label>وسيلة الدفع الأونلاين</label>
            <select id="setPaymentMethod" onchange="toggleSetWallet()">
              <option value="cash">كاش عند الاستلام</option>
              <option value="instapay">إنستاباي (InstaPay)</option>
              <option value="vodafone_cash">فودافون كاش</option>
              <option value="etisalat_cash">اتصالات كاش</option>
              <option value="orange_cash">أورنج كاش</option>
            </select>
          </div>
          <div class="form-field" id="setWalletField">
            <label>رقم المحفظة</label>
            <input type="tel" id="setWallet">
          </div>
          <button class="btn btn-primary" onclick="saveSettings()">حفظ التعديلات</button>
        </div>
      </div>

    </div>
  </main>
</div>

<script>
  const PAYMENT_LABELS = {
    cash: 'كاش عند الاستلام',
    instapay: 'إنستاباي (InstaPay)',
    vodafone_cash: 'فودافون كاش',
    etisalat_cash: 'اتصالات كاش',
    orange_cash: 'أورنج كاش'
  };

  function getCurrentUser(){
    try{
      const raw = localStorage.getItem('san3a_current_user');
      if(raw) return JSON.parse(raw);
    }catch(e){}
    return {name:'عميل صنعة', phone:'01000000000', type:'client', paymentMethod:'cash', paymentWallet:''};
  }

  function showView(id, el){
    document.querySelectorAll('.view').forEach(v => v.classList.remove('active'));
    document.getElementById('view-' + id).classList.add('active');
    document.querySelectorAll('.sb-link[data-view]').forEach(a => a.classList.remove('active'));
    if(el) el.classList.add('active');
    const titles = {
      home:['أهلاً بيك 👋','ده ملخص حسابك مع صنعة'],
      requests:['طلباتي','كل الطلبات اللي عملتها على صنعة'],
      new:['اطلب صنايعي جديد','هنوصلك بأقرب صنايعي موثّق'],
      payments:['الدفعات والإيصالات','كل إيصالاتك ووسيلة الدفع المحفوظة'],
      settings:['الإعدادات','بيانات حسابك ووسيلة الدفع']
    };
    document.getElementById('pageTitle').textContent = titles[id][0];
    document.getElementById('pageSub').textContent = titles[id][1];
    document.getElementById('sidebar').classList.remove('open');
  }

  const demoRequests = [
    {service:'تسريب مياه', pro:'أحمد سعيد', date:'31 يوليو 2026', status:'جاري التنفيذ', tone:'warn'},
    {service:'تصليح تكييف', pro:'كريم فتحي', date:'25 يوليو 2026', status:'اتقفل ✓', tone:'ok'},
    {service:'تسليك حمام', pro:'محمود عادل', date:'14 يوليو 2026', status:'اتقفل ✓', tone:'ok'},
    {service:'دهان غرفة', pro:'عمرو حسن', date:'2 يوليو 2026', status:'اتقفل ✓', tone:'ok'},
    {service:'كهرباء المطبخ', pro:'—', date:'—', status:'لسه مفيش صنايعي قبل', tone:'danger'},
  ];

  function renderRequests(){
    const body = document.getElementById('requestsTableBody');
    body.innerHTML = demoRequests.map(r => `
      <tr>
        <td>${r.service}</td>
        <td>${r.pro}</td>
        <td>${r.date}</td>
        <td><span class="badge ${r.tone}">${r.status}</span></td>
        <td><button class="btn btn-ghost btn-sm">تفاصيل</button></td>
      </tr>
    `).join('');
  }

  function submitNewRequest(e){
    e.preventDefault();
    const service = document.getElementById('reqService').value;
    const area = document.getElementById('reqArea').value;
    demoRequests.unshift({service: service || 'خدمة جديدة', pro:'—', date:'دلوقتي', status:'بندوّرلك على صنايعي في ' + area, tone:'warn'});
    renderRequests();
    showView('requests', document.querySelector('[data-view=requests]'));
    e.target.reset();
  }

  function renderWallet(){
    const u = getCurrentUser();
    const label = PAYMENT_LABELS[u.paymentMethod] || 'كاش عند الاستلام';
    const wallet = u.paymentWallet ? ` — ${u.paymentWallet}` : '';
    document.getElementById('walletDisplay').innerHTML = `
      <div class="wallet-chip">
        <div class="ic"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 10h20"/></svg></div>
        <div><b style="display:block; font-size:.88rem;">${label}</b><span style="font-size:.76rem; color:var(--text-soft);">${wallet || 'هيتم تأكيد الدفع وقت التسليم'}</span></div>
      </div>`;
  }

  function toggleSetWallet(){
    const method = document.getElementById('setPaymentMethod').value;
    document.getElementById('setWalletField').style.display = (method === 'cash') ? 'none' : 'block';
  }

  function fillSettingsForm(){
    const u = getCurrentUser();
    document.getElementById('setName').value = u.name || '';
    document.getElementById('setPhone').value = u.phone || '';
    document.getElementById('setPaymentMethod').value = u.paymentMethod || 'cash';
    document.getElementById('setWallet').value = u.paymentWallet || '';
    toggleSetWallet();
  }

  function saveSettings(){
    const u = getCurrentUser();
    u.name = document.getElementById('setName').value.trim() || u.name;
    u.phone = document.getElementById('setPhone').value.trim() || u.phone;
    u.paymentMethod = document.getElementById('setPaymentMethod').value;
    u.paymentWallet = (u.paymentMethod === 'cash') ? '' : document.getElementById('setWallet').value.trim();
    try{ localStorage.setItem('san3a_current_user', JSON.stringify(u)); }catch(e){}
    renderTopbar();
    renderWallet();
    alert('اتحفظت بياناتك بنجاح ✓');
  }

  function renderTopbar(){
    const u = getCurrentUser();
    document.getElementById('userNameChip').textContent = u.name || 'عميل صنعة';
    document.getElementById('userPhoneChip').textContent = u.phone || '';
    document.getElementById('userAvatar').textContent = (u.name || 'ع').trim().charAt(0);
  }

  renderTopbar();
  renderRequests();
  renderWallet();
  fillSettingsForm();
</script>
</body>
</html>

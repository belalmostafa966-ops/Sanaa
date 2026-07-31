<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>لوحة الصنايعي | صنعة</title>
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
  .sidebar{
    width:260px; flex:none; background:linear-gradient(180deg,var(--ink),var(--ink-2)); color:#fff;
    padding:26px 20px; display:flex; flex-direction:column; gap:6px; position:sticky; top:0; height:100vh;
  }
  .sb-brand{display:flex; align-items:center; gap:10px; margin-bottom:26px; padding:0 4px;}
  .sb-brand .mark{width:36px; height:36px; border-radius:10px; background:var(--brass); display:flex; align-items:center; justify-content:center; font-weight:900; color:#fff; flex:none;}
  .sb-brand b{font-size:1.15rem; font-weight:900;}
  .sb-brand span{display:block; font-size:.7rem; opacity:.7;}
  .sb-link{display:flex; align-items:center; gap:12px; padding:11px 12px; border-radius:11px; font-size:.9rem; font-weight:700; color:rgba(255,255,255,.78); cursor:pointer; transition:background .2s, color .2s;}
  .sb-link svg{width:18px; height:18px; flex:none;}
  .sb-link:hover{background:rgba(255,255,255,.08); color:#fff;}
  .sb-link.active{background:rgba(255,255,255,.14); color:#fff; box-shadow:inset 0 0 0 1px rgba(255,255,255,.1);}
  .sb-spacer{flex:1;}
  .sb-foot{font-size:.72rem; opacity:.55; padding:0 4px;}

  .main{flex:1; min-width:0;}
  .topbar{display:flex; align-items:center; justify-content:space-between; padding:18px 30px; background:#fff; border-bottom:1px solid rgba(44,53,144,.08); position:sticky; top:0; z-index:5;}
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
  .grid.portfolio-grid{grid-template-columns:repeat(3,1fr);}

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
  .btn-ok{background:var(--ok); color:#fff;}
  .btn-danger{background:var(--danger-bg); color:var(--danger);}
  .btn-sm{padding:7px 14px; font-size:.78rem;}

  .req-item{border:1.5px solid rgba(44,53,144,.1); border-radius:14px; padding:16px; margin-bottom:12px; display:flex; justify-content:space-between; align-items:center; gap:14px;}
  .req-item b{display:block; font-size:.9rem; margin-bottom:3px;}
  .req-item span{font-size:.78rem; color:var(--text-soft); display:block;}
  .req-actions{display:flex; gap:8px; flex:none;}

  .form-field{margin-bottom:16px;}
  .form-field label{display:block; font-size:.82rem; font-weight:700; margin-bottom:7px;}
  .form-field input, .form-field select, .form-field textarea{width:100%; padding:11px 13px; border-radius:11px; border:1.5px solid rgba(44,53,144,.16); font-size:.9rem; outline:none;}
  .form-field input:focus, .form-field select:focus, .form-field textarea:focus{border-color:var(--brass);}

  .wallet-chip{display:flex; align-items:center; gap:12px; background:var(--paper-2); border-radius:12px; padding:14px 16px; margin-bottom:14px;}
  .wallet-chip .ic{width:36px; height:36px; border-radius:9px; background:#fff; display:flex; align-items:center; justify-content:center; color:var(--brass);}

  .port-card{border:1.5px solid rgba(44,53,144,.1); border-radius:14px; overflow:hidden;}
  .port-card .thumb{height:130px; background:linear-gradient(135deg,var(--paper-2),#dfe1f2); display:flex; align-items:center; justify-content:center; color:var(--text-soft); font-size:.78rem;}
  .port-card .body{padding:14px;}
  .port-card b{display:block; font-size:.88rem; margin-bottom:4px;}
  .port-card p{font-size:.78rem; color:var(--text-soft); line-height:1.6; margin-bottom:10px;}

  .rating-stars{color:var(--brass); letter-spacing:2px;}

  @media (max-width: 900px){
    .sidebar{position:fixed; right:-280px; z-index:50; transition:right .25s ease; box-shadow:var(--shadow-lg);}
    .sidebar.open{right:0;}
    .grid.cols-3, .grid.cols-2, .grid.portfolio-grid{grid-template-columns:1fr;}
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
      <div><b>صنعة</b><span>لوحة الصنايعي</span></div>
    </div>
    <a class="sb-link active" data-view="home" onclick="showView('home', this)">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 11l9-8 9 8"/><path d="M5 10v10h14V10"/></svg>
      الرئيسية
    </a>
    <a class="sb-link" data-view="requests" onclick="showView('requests', this)">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 8v4l3 3"/><circle cx="12" cy="12" r="9"/></svg>
      طلبات جديدة
    </a>
    <a class="sb-link" data-view="schedule" onclick="showView('schedule', this)">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
      جدول شغلي
    </a>
    <a class="sb-link" data-view="earnings" onclick="showView('earnings', this)">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 1v22M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
      أرباحي
    </a>
    <a class="sb-link" data-view="portfolio" onclick="showView('portfolio', this)">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg>
      بورتفوليو الشغل
    </a>
    <a class="sb-link" data-view="profile" onclick="showView('profile', this)">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
      بروفايلي وتقييمي
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
          <div class="sub" id="pageSub">ده ملخص شغلك على صنعة</div>
        </div>
      </div>
      <div class="user-chip">
        <div class="info" style="text-align:left;">
          <b id="userNameChip">صنايعي صنعة</b>
          <span id="userProfChip">—</span>
        </div>
        <div class="av" id="userAvatar">ص</div>
      </div>
    </div>

    <div class="content">

      <!-- ---------- HOME ---------- -->
      <div class="view active" id="view-home">
        <div class="grid cols-3" style="margin-bottom:20px;">
          <div class="card stat-card">
            <div class="icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M12 8v4l3 3"/><circle cx="12" cy="12" r="9"/></svg></div>
            <div class="num">4</div>
            <div class="lbl">طلبات جديدة النهارده</div>
          </div>
          <div class="card stat-card">
            <div class="icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M12 1v22M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg></div>
            <div class="num">4,120</div>
            <div class="lbl">أرباح الشهر ده (ج.م)</div>
          </div>
          <div class="card stat-card">
            <div class="icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M12 2l2.9 6.4 7 .7-5.2 4.8 1.5 6.9L12 17.7 5.8 20.8l1.5-6.9L2.1 9.1l7-.7z"/></svg></div>
            <div class="num">4.8</div>
            <div class="lbl">تقييمك العام</div>
          </div>
        </div>

        <div class="card">
          <h3>طلبات محتاجة رد سريع</h3>
          <div id="homeReqList"></div>
        </div>
      </div>

      <!-- ---------- NEW REQUESTS ---------- -->
      <div class="view" id="view-requests">
        <div class="card">
          <h3>كل الطلبات الجديدة</h3>
          <div id="allReqList"></div>
        </div>
      </div>

      <!-- ---------- SCHEDULE ---------- -->
      <div class="view" id="view-schedule">
        <div class="card">
          <h3>جدول شغلي الأسبوع ده</h3>
          <table>
            <thead><tr><th>اليوم</th><th>الميعاد</th><th>الخدمة</th><th>العميل</th><th>الحالة</th></tr></thead>
            <tbody>
              <tr><td>السبت</td><td>10:00 ص</td><td>تصليح تسريب</td><td>محمد إبراهيم</td><td><span class="badge warn">هيبدأ دلوقتي</span></td></tr>
              <tr><td>السبت</td><td>2:00 م</td><td>تركيب سخان</td><td>ندى عادل</td><td><span class="badge ok">مؤكد</span></td></tr>
              <tr><td>الأحد</td><td>11:30 ص</td><td>صيانة تكييف</td><td>يوسف كمال</td><td><span class="badge ok">مؤكد</span></td></tr>
              <tr><td>الاتنين</td><td>—</td><td>—</td><td>—</td><td><span class="badge">يوم فاضي</span></td></tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- ---------- EARNINGS ---------- -->
      <div class="view" id="view-earnings">
        <div class="grid cols-2">
          <div class="card">
            <h3>سجل الأرباح</h3>
            <table>
              <thead><tr><th>الشغلانة</th><th>التاريخ</th><th>المبلغ</th><th>عمولة صنعة (20%)</th><th>صافي ليك</th></tr></thead>
              <tbody>
                <tr><td>تصليح تسريب</td><td>29 يوليو</td><td>350</td><td>70</td><td>280</td></tr>
                <tr><td>تركيب سخان</td><td>26 يوليو</td><td>900</td><td>180</td><td>720</td></tr>
                <tr><td>صيانة تكييف</td><td>21 يوليو</td><td>450</td><td>90</td><td>360</td></tr>
              </tbody>
            </table>
          </div>
          <div class="card">
            <h3>استلام أرباحك</h3>
            <div id="proWalletDisplay"></div>
            <p style="font-size:.8rem; color:var(--text-soft); margin-bottom:14px;">بنحول لك صافي أرباحك أسبوعيًا على نفس الوسيلة دي.</p>
            <button class="btn btn-ghost btn-sm" style="width:100%; justify-content:center;" onclick="showView('profile', document.querySelector('[data-view=profile]'))">تعديل وسيلة الاستلام</button>
          </div>
        </div>
      </div>

      <!-- ---------- PORTFOLIO ---------- -->
      <div class="view" id="view-portfolio">
        <div class="grid cols-2" style="margin-bottom:20px; align-items:start;">
          <div class="card">
            <h3>ضيف شغلانة لبورتفوليوهك</h3>
            <form onsubmit="return addPortfolioItem(event)">
              <div class="form-field">
                <label>عنوان الشغلانة</label>
                <input type="text" id="pfTitle" placeholder="مثال: تركيب مطبخ خشب زان" required>
              </div>
              <div class="form-field">
                <label>وصف قصير</label>
                <textarea id="pfDesc" rows="3" placeholder="اشرح الشغلانة والتفاصيل..."></textarea>
              </div>
              <div class="form-field">
                <label>رابط صورة (اختياري)</label>
                <input type="url" id="pfImg" placeholder="https://...">
              </div>
              <button type="submit" class="btn btn-primary" style="width:100%; justify-content:center;">إضافة للبورتفوليو</button>
            </form>
          </div>
          <div class="card">
            <h3>البورتفوليو العام بتاعك</h3>
            <p style="font-size:.85rem; color:var(--text-soft); line-height:1.7; margin-bottom:14px;">
              العملاء بيشوفوا شغلك من صفحة البورتفوليو العامة قبل ما يطلبوا منك. أي شغلانة تضيفها هنا تظهر هناك على طول.
            </p>
            <a href="portfolio.html" target="_blank" class="btn btn-ghost" style="width:100%; justify-content:center;">
              معاينة صفحة البورتفوليو
            </a>
          </div>
        </div>
        <div class="card">
          <h3>شغلانات البورتفوليو</h3>
          <div class="grid portfolio-grid" id="portfolioGrid"></div>
        </div>
      </div>

      <!-- ---------- PROFILE ---------- -->
      <div class="view" id="view-profile">
        <div class="grid cols-2">
          <div class="card">
            <h3>بياناتي</h3>
            <div class="form-field">
              <label>الاسم</label>
              <input type="text" id="setName">
            </div>
            <div class="form-field">
              <label>مجال الشغل</label>
              <select id="setProfession">
                <option value="سباكة">سباكة</option><option value="كهرباء">كهرباء</option>
                <option value="نجارة">نجارة</option><option value="دهانات">دهانات</option>
                <option value="تكييف وتبريد">تكييف وتبريد</option><option value="أخرى">حاجة تانية</option>
              </select>
            </div>
            <div class="form-field">
              <label>وسيلة استلام الأرباح</label>
              <select id="setPaymentMethod" onchange="toggleSetWallet()">
                <option value="cash">استلام كاش</option>
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
          <div class="card">
            <h3>تقييمي</h3>
            <div style="text-align:center; padding:10px 0 18px;">
              <div style="font-size:2.4rem; font-weight:900; color:var(--ink); font-family:'JetBrains Mono',monospace;">4.8</div>
              <div class="rating-stars" style="font-size:1.2rem;">★★★★★</div>
              <div style="font-size:.78rem; color:var(--text-soft); margin-top:4px;">من 63 تقييم</div>
            </div>
            <div style="border-top:1px solid rgba(44,53,144,.08); padding-top:14px;">
              <p style="font-size:.85rem; margin-bottom:8px;"><b>"شغل نضيف وسريع، جدًا محترم." </b><span style="display:block; color:var(--text-soft); font-size:.75rem;">— هبة السيد</span></p>
              <p style="font-size:.85rem;"><b>"وصل في الميعاد وسعره مناسب." </b><span style="display:block; color:var(--text-soft); font-size:.75rem;">— طارق فؤاد</span></p>
            </div>
          </div>
        </div>
      </div>

    </div>
  </main>
</div>

<script>
  const PAYMENT_LABELS = {
    cash: 'استلام كاش', instapay: 'إنستاباي (InstaPay)', vodafone_cash: 'فودافون كاش',
    etisalat_cash: 'اتصالات كاش', orange_cash: 'أورنج كاش'
  };

  function getCurrentUser(){
    try{
      const raw = localStorage.getItem('san3a_current_user');
      if(raw) return JSON.parse(raw);
    }catch(e){}
    return {name:'صنايعي صنعة', phone:'01000000000', type:'pro', profession:'سباكة', paymentMethod:'cash', paymentWallet:''};
  }

  function showView(id, el){
    document.querySelectorAll('.view').forEach(v => v.classList.remove('active'));
    document.getElementById('view-' + id).classList.add('active');
    document.querySelectorAll('.sb-link[data-view]').forEach(a => a.classList.remove('active'));
    if(el) el.classList.add('active');
    const titles = {
      home:['أهلاً بيك 👋','ده ملخص شغلك على صنعة'],
      requests:['طلبات جديدة','طلبات العملاء المستنية ردّك'],
      schedule:['جدول شغلي','مواعيدك المؤكدة الأسبوع ده'],
      earnings:['أرباحي','سجل أرباحك ووسيلة الاستلام'],
      portfolio:['بورتفوليو الشغل','اللي العميل بيشوفه قبل ما يطلب منك'],
      profile:['بروفايلي وتقييمي','بياناتك وتقييم العملاء ليك'],
    };
    document.getElementById('pageTitle').textContent = titles[id][0];
    document.getElementById('pageSub').textContent = titles[id][1];
    document.getElementById('sidebar').classList.remove('open');
  }

  const demoRequests = [
    {id:1, service:'تسريب مياه', client:'محمد إبراهيم', area:'الحي التاسع', time:'دلوقتي', price:'350 ج.م (تقريبي)'},
    {id:2, service:'تركيب سخان', client:'ندى عادل', area:'التجمع الأول', time:'بعد ساعة', price:'900 ج.م (تقريبي)'},
    {id:3, service:'صيانة تكييف', client:'يوسف كمال', area:'مدينتي', time:'بكرة الصبح', price:'450 ج.م (تقريبي)'},
    {id:4, service:'تسليك مطبخ', client:'سارة منير', area:'الشيخ زايد', time:'بكرة بالليل', price:'200 ج.م (تقريبي)'},
  ];

  function reqRow(r){
    return `
      <div class="req-item">
        <div>
          <b>${r.service} — ${r.client}</b>
          <span>${r.area} · ${r.time} · ${r.price}</span>
        </div>
        <div class="req-actions">
          <button class="btn btn-ok btn-sm" onclick="acceptRequest(${r.id})">قبول</button>
          <button class="btn btn-danger btn-sm" onclick="declineRequest(${r.id})">رفض</button>
        </div>
      </div>`;
  }

  function renderRequests(){
    document.getElementById('homeReqList').innerHTML = demoRequests.slice(0,2).map(reqRow).join('') || '<p style="color:var(--text-soft); font-size:.85rem;">مفيش طلبات جديدة دلوقتي.</p>';
    document.getElementById('allReqList').innerHTML = demoRequests.map(reqRow).join('') || '<p style="color:var(--text-soft); font-size:.85rem;">مفيش طلبات جديدة دلوقتي.</p>';
  }

  function acceptRequest(id){
    const idx = demoRequests.findIndex(r => r.id === id);
    if(idx > -1){ demoRequests.splice(idx,1); renderRequests(); }
  }
  function declineRequest(id){
    const idx = demoRequests.findIndex(r => r.id === id);
    if(idx > -1){ demoRequests.splice(idx,1); renderRequests(); }
  }

  function getPortfolio(){
    try{
      const raw = localStorage.getItem('san3a_portfolio_items');
      if(raw) return JSON.parse(raw);
    }catch(e){}
    return [];
  }

  function renderPortfolio(){
    const items = getPortfolio();
    const grid = document.getElementById('portfolioGrid');
    if(items.length === 0){
      grid.innerHTML = '<p style="color:var(--text-soft); font-size:.85rem; grid-column:1/-1;">لسه مفيش شغلانات مضافة. ضيف أول شغلانة من الفورم اللي فوق.</p>';
      return;
    }
    grid.innerHTML = items.map(it => `
      <div class="port-card">
        <div class="thumb">${it.img ? `<img src="${it.img}" style="width:100%;height:100%;object-fit:cover;" onerror="this.parentElement.textContent='تعذّر تحميل الصورة'">` : 'من غير صورة'}</div>
        <div class="body">
          <b>${it.title}</b>
          <p>${it.desc || ''}</p>
          <button class="btn btn-danger btn-sm" onclick="removePortfolioItem(${it.id})">حذف</button>
        </div>
      </div>
    `).join('');
  }

  function addPortfolioItem(e){
    e.preventDefault();
    const items = getPortfolio();
    items.unshift({
      id: Date.now(),
      title: document.getElementById('pfTitle').value.trim(),
      desc: document.getElementById('pfDesc').value.trim(),
      img: document.getElementById('pfImg').value.trim()
    });
    try{ localStorage.setItem('san3a_portfolio_items', JSON.stringify(items)); }catch(err){}
    renderPortfolio();
    e.target.reset();
    return false;
  }

  function removePortfolioItem(id){
    const items = getPortfolio().filter(it => it.id !== id);
    try{ localStorage.setItem('san3a_portfolio_items', JSON.stringify(items)); }catch(err){}
    renderPortfolio();
  }

  function renderProWallet(){
    const u = getCurrentUser();
    const label = PAYMENT_LABELS[u.paymentMethod] || 'استلام كاش';
    const wallet = u.paymentWallet ? ` — ${u.paymentWallet}` : '';
    document.getElementById('proWalletDisplay').innerHTML = `
      <div class="wallet-chip">
        <div class="ic"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 10h20"/></svg></div>
        <div><b style="display:block; font-size:.88rem;">${label}</b><span style="font-size:.76rem; color:var(--text-soft);">${wallet || 'هيتحدد وقت التحويل'}</span></div>
      </div>`;
  }

  function toggleSetWallet(){
    const method = document.getElementById('setPaymentMethod').value;
    document.getElementById('setWalletField').style.display = (method === 'cash') ? 'none' : 'block';
  }

  function fillSettingsForm(){
    const u = getCurrentUser();
    document.getElementById('setName').value = u.name || '';
    document.getElementById('setProfession').value = u.profession || 'سباكة';
    document.getElementById('setPaymentMethod').value = u.paymentMethod || 'cash';
    document.getElementById('setWallet').value = u.paymentWallet || '';
    toggleSetWallet();
  }

  function saveSettings(){
    const u = getCurrentUser();
    u.name = document.getElementById('setName').value.trim() || u.name;
    u.profession = document.getElementById('setProfession').value;
    u.paymentMethod = document.getElementById('setPaymentMethod').value;
    u.paymentWallet = (u.paymentMethod === 'cash') ? '' : document.getElementById('setWallet').value.trim();
    try{ localStorage.setItem('san3a_current_user', JSON.stringify(u)); }catch(e){}
    renderTopbar();
    renderProWallet();
    alert('اتحفظت بياناتك بنجاح ✓');
  }

  function renderTopbar(){
    const u = getCurrentUser();
    document.getElementById('userNameChip').textContent = u.name || 'صنايعي صنعة';
    document.getElementById('userProfChip').textContent = u.profession || '';
    document.getElementById('userAvatar').textContent = (u.name || 'ص').trim().charAt(0);
  }

  renderTopbar();
  renderRequests();
  renderPortfolio();
  renderProWallet();
  fillSettingsForm();
</script>
</body>
</html>

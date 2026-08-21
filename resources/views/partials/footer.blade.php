<footer style="background-color: #2C3590; color: #ffffff; padding: 48px 20px 24px; margin-top: auto; position: relative; z-index: 10;">
    <div style="max-width: 1180px; margin: 0 auto; padding: 0 15px;">
        
        <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 32px; margin-bottom: 40px;">
            
            <!-- الشعار والوصف -->
            <div style="max-width: 320px;">
                <div style="display: flex; align-items: center; gap: 10px; font-weight: 900; font-size: 1.4rem; color: #fff; margin-bottom: 12px;">
                    <span style="width: 36px; height: 36px; border-radius: 8px; background: #F7941D; color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 900; font-size: 1.1rem;">ص</span>
                    {{ config('app.name', 'صنعة') }}
                </div>
                <p style="font-size: 0.88rem; color: rgba(255, 255, 255, 0.75); line-height: 1.8; margin: 0;">
                    منصة صيانة منزلية مصرية بتوصل بين العميل والصنايعي بأمان، ضمان، وشفافية كاملة في كل خطوة.
                </p>
            </div>

            <!-- قائمة المنصة -->
            <div>
                <h5 style="font-size: 1rem; font-weight: 800; margin-bottom: 16px; color: #fff;">المنصة</h5>
                <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 10px; font-size: 0.88rem;">
                    <li><a href="{{ route('home') }}#how" style="color: rgba(255, 255, 255, 0.75); text-decoration: none;">إزاي بيشتغل</a></li>
                    <li><a href="{{ route('home') }}#trust" style="color: rgba(255, 255, 255, 0.75); text-decoration: none;">الأمان والضمان</a></li>
                </ul>
            </div>

            <!-- قائمة للصنايعية -->
            <div>
                <h5 style="font-size: 1rem; font-weight: 800; margin-bottom: 16px; color: #fff;">للصنايعية</h5>
                <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 10px; font-size: 0.88rem;">
                    <li><a href="{{ Route::has('register') ? route('register') : 'javascript:void(0);' }}" style="color: rgba(255, 255, 255, 0.75); text-decoration: none;">سجّل كصنايعي</a></li>
                    <li><a href="{{ route('home') }}#trust" style="color: rgba(255, 255, 255, 0.75); text-decoration: none;">شروط الانضمام</a></li>
                    <li><a href="{{ route('faq') }}" style="color: rgba(255, 255, 255, 0.75); text-decoration: none;">الأسئلة الشائعة</a></li>
                </ul>
            </div>

            <!-- قائمة تواصل معنا -->
            <div>
                <h5 style="font-size: 1rem; font-weight: 800; margin-bottom: 16px; color: #fff;">تواصل معنا</h5>
                <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 10px; font-size: 0.88rem;">
                    <li><a href="{{ route('support') }}" style="color: rgba(255, 255, 255, 0.75); text-decoration: none;">الدعم الفني</a></li>
                    <li><a href="{{ route('contact') }}" style="color: rgba(255, 255, 255, 0.75); text-decoration: none;">تواصل معنا</a></li>
                    <li><a href="{{ route('privacy') }}" style="color: rgba(255, 255, 255, 0.75); text-decoration: none;">سياسة الخصوصية</a></li>
                </ul>
            </div>

        </div>

        <!-- حقوق النشر + السوشيال ميديا -->
        <div style="border-top: 1px solid rgba(255, 255, 255, 0.15); padding-top: 20px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
            <div style="font-size: 0.82rem; color: rgba(255, 255, 255, 0.75);">
                &copy; {{ date('Y') }} {{ config('app.name', 'صنعة') }}. جميع الحقوق محفوظة.
            </div>

            <div style="display: flex; gap: 12px;">
                {{-- فيسبوك --}}
                <a href="https://www.facebook.com/profile.php?id=61592251305576&locale=ar_AR" target="_blank" rel="noopener" aria-label="صفحتنا على فيسبوك"
                   style="width:36px; height:36px; border-radius:50%; background:rgba(255,255,255,.08); display:flex; align-items:center; justify-content:center; transition:background .2s ease;"
                   onmouseover="this.style.background='#F7941D'" onmouseout="this.style.background='rgba(255,255,255,.08)'">
                    <svg viewBox="0 0 24 24" fill="#ffffff" width="16" height="16"><path d="M22 12a10 10 0 10-11.6 9.9v-7H7.9V12h2.5V9.8c0-2.5 1.5-3.9 3.8-3.9 1.1 0 2.2.2 2.2.2v2.5h-1.3c-1.2 0-1.6.8-1.6 1.6V12h2.8l-.4 2.9h-2.4v7A10 10 0 0022 12z"/></svg>
                </a>

                {{-- إنستجرام --}}
                <a href="https://www.instagram.com/san3aa.a/" target="_blank" rel="noopener" aria-label="صفحتنا على إنستجرام"
                   style="width:36px; height:36px; border-radius:50%; background:rgba(255,255,255,.08); display:flex; align-items:center; justify-content:center; transition:background .2s ease;"
                   onmouseover="this.style.background='#F7941D'" onmouseout="this.style.background='rgba(255,255,255,.08)'">
                    <svg viewBox="0 0 24 24" fill="#ffffff" width="16" height="16"><path d="M12 2.2c2.7 0 3 0 4.1.1 1 0 1.6.2 2 .4.5.2.9.4 1.2.8.4.3.6.7.8 1.2.2.4.4 1 .4 2 .1 1.1.1 1.4.1 4.1s0 3-.1 4.1c0 1-.2 1.6-.4 2-.2.5-.4.9-.8 1.2-.3.4-.7.6-1.2.8-.4.2-1 .4-2 .4-1.1.1-1.4.1-4.1.1s-3 0-4.1-.1c-1 0-1.6-.2-2-.4-.5-.2-.9-.4-1.2-.8-.4-.3-.6-.7-.8-1.2-.2-.4-.4-1-.4-2-.1-1.1-.1-1.4-.1-4.1s0-3 .1-4.1c0-1 .2-1.6.4-2 .2-.5.4-.9.8-1.2.3-.4.7-.6 1.2-.8.4-.2 1-.4 2-.4 1.1-.1 1.4-.1 4.1-.1zM12 0C9.3 0 8.9 0 7.8.1c-1.1.1-1.9.3-2.6.6-.7.3-1.3.7-1.9 1.3C2.7 2.6 2.3 3.2 2 3.9c-.3.7-.5 1.5-.6 2.6C1.3 7.6 1.3 8 1.3 10.7v2.6c0 2.7 0 3.1.1 4.2.1 1.1.3 1.9.6 2.6.3.7.7 1.3 1.3 1.9.6.6 1.2 1 1.9 1.3.7.3 1.5.5 2.6.6 1.1.1 1.5.1 4.2.1s3.1 0 4.2-.1c1.1-.1 1.9-.3 2.6-.6.7-.3 1.3-.7 1.9-1.3.6-.6 1-1.2 1.3-1.9.3-.7.5-1.5.6-2.6.1-1.1.1-1.5.1-4.2v-2.6c0-2.7 0-3.1-.1-4.2-.1-1.1-.3-1.9-.6-2.6-.3-.7-.7-1.3-1.3-1.9-.6-.6-1.2-1-1.9-1.3-.7-.3-1.5-.5-2.6-.6C15.1 0 14.7 0 12 0z"/><path d="M12 5.8a6.2 6.2 0 100 12.4 6.2 6.2 0 000-12.4zm0 10.2a4 4 0 110-8 4 4 0 010 8zM18.4 5.6a1.4 1.4 0 11-2.8 0 1.4 1.4 0 012.8 0z"/></svg>
                </a>

                {{-- واتساب (لينك عام، مش لرقم شخص معين) --}}
                <a href="https://wa.me/" target="_blank" rel="noopener" aria-label="تواصل معانا على واتساب"
                   style="width:36px; height:36px; border-radius:50%; background:rgba(255,255,255,.08); display:flex; align-items:center; justify-content:center; transition:background .2s ease;"
                   onmouseover="this.style.background='#F7941D'" onmouseout="this.style.background='rgba(255,255,255,.08)'">
                    <svg viewBox="0 0 24 24" fill="#ffffff" width="16" height="16"><path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91c0 1.71.45 3.38 1.29 4.85L2.05 22l5.36-1.4a9.87 9.87 0 004.63 1.18h.004c5.46 0 9.9-4.45 9.9-9.9 0-2.65-1.03-5.13-2.9-7-1.87-1.87-4.35-2.9-7-2.9zm0 18.06h-.003a8.2 8.2 0 01-4.18-1.14l-.3-.18-3.18.83.85-3.1-.2-.32a8.15 8.15 0 01-1.25-4.34c0-4.5 3.66-8.16 8.17-8.16 2.18 0 4.23.85 5.77 2.39a8.1 8.1 0 012.39 5.78c0 4.5-3.67 8.16-8.17 8.16zm4.48-6.12c-.24-.12-1.45-.72-1.68-.8-.22-.08-.39-.12-.55.12-.16.24-.63.8-.78.97-.14.16-.29.18-.53.06-.24-.12-1.03-.38-1.96-1.21-.72-.65-1.22-1.44-1.36-1.68-.14-.24-.02-.37.11-.5.11-.11.24-.29.36-.43.12-.14.16-.24.24-.4.08-.16.04-.31-.02-.43-.06-.12-.55-1.33-.75-1.82-.2-.48-.4-.41-.55-.42-.14-.01-.31-.01-.47-.01-.16 0-.43.06-.65.31-.22.24-.86.84-.86 2.05 0 1.21.88 2.38 1 2.54.12.16 1.73 2.64 4.2 3.7.59.25 1.05.4 1.41.52.59.19 1.13.16 1.55.1.47-.07 1.45-.59 1.66-1.16.2-.57.2-1.06.14-1.16-.06-.1-.22-.16-.46-.28z"/></svg>
                </a>
            </div>
        </div>

    </div>
</footer>
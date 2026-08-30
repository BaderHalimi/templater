<div>
    <section class="grid min-h-[calc(100vh-9rem)] items-center gap-10 lg:grid-cols-[0.95fr_1.05fr]">
        <div class="flex flex-col gap-6">
            <div class="flex flex-col gap-4">
                <h1 class="max-w-2xl text-4xl font-black leading-tight text-zinc-950 sm:text-5xl">اصنع دعوة لها حضور، لا
                    مجرد رسالة.</h1>
                <p class="max-w-xl text-lg leading-8 text-zinc-700">اجمع تفاصيل مشروعك، اختر النبرة المناسبة، وشاهد دعوتك
                    تتشكل لحظة بلحظة قبل إرسالها.</p>
            </div>
            <div class="flex flex-wrap gap-3">
                @auth
                    <a href="{{ route('projects.create') }}" wire:navigate
                        class="rounded-md bg-teal-700 px-5 py-3 font-bold text-white hover:bg-teal-800">إنشاء دعوة</a>
                    <a href="{{ route('projects.index') }}" wire:navigate
                        class="rounded-md border border-zinc-300 px-5 py-3 font-bold text-zinc-800 hover:bg-white">عرض
                        المشاريع</a>
                @else
                    <a href="{{ route('login') }}" wire:navigate
                        class="rounded-md bg-teal-700 px-5 py-3 font-bold text-white hover:bg-teal-800">الدخول بحساب الكلية</a>
                @endauth
            </div>
        </div>

        <div class="invite-stage min-h-[520px] rounded-md border border-zinc-200 bg-white p-6 shadow-sm">
            <section class="invitation-ticket welcome-ticket" aria-label="مثال على دعوة مناقشة مشروع">
                <div class="ticket-main">
                    <div class="flex items-center gap-2">
                        <img src="{{ asset('logo/ucas_eng_club_web.png') }}" alt="شعار نادي UCAS الهندسي"
                            class="h-16 w-12 object-contain sm:h-16 sm:w-12">
                        <p class="ticket-kicker" style="line-height: 1.7; letter-spacing: 0; text-transform: none;" dir="rtl">النــــــــادي الهنـــــــدسي<br><span class="text-[0.68rem] font-semibold">مساحة للابداع والتميز</span></p>
                    </div>
                    <div class="ticket-heading">
                        <span>دعوة لحضور</span>
                        <strong>مناقشة مشروع تخرج</strong>
                    </div>
                    <div class="ticket-facts">
                        <div><span>الساعة</span><strong>12:00 PM</strong></div>
                        <div><span>المكان</span><strong>قاعة المؤتمرات</strong></div>
                    </div>
                </div>
                <div class="ticket-date" aria-hidden="true"><strong>30</strong><span>أغسطس</span><small>2026</small>
                </div>
                <div class="ticket-code" aria-hidden="true"><span></span></div>
            </section>
            <div class="mt-8 rounded-md border border-teal-100 bg-teal-50 p-5 text-center">
                <p class="text-sm font-bold text-teal-800">ليست دعوة عادية</p>
                <p class="mt-3 leading-8 text-zinc-700">إنها مساحة تمنح مشروعكم موعده وصوته وحضوره.</p>
            </div>
        </div>
    </section>
</div>

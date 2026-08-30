<x-layouts.app title="Templater">
    <section class="grid min-h-[calc(100vh-9rem)] items-center gap-10 lg:grid-cols-[0.95fr_1.05fr]">
        <div class="flex flex-col gap-6">
            <p class="text-sm font-semibold text-teal-700">دعوات مناقشة مشاريع التخرج</p>
            <div class="flex flex-col gap-4">
                <h1 class="max-w-2xl text-4xl font-black leading-tight text-zinc-950 sm:text-5xl">
                    اصنع دعوة بريدية أنيقة، عاينها، وأرسلها فوراً.
                </h1>
                <p class="max-w-xl text-lg leading-8 text-zinc-700">
                    النظام يحول بيانات مشروعك وموعد المناقشة إلى دعوة عربية عصرية للمعاينة، وقالب HTML مناسب للإرسال عبر البريد.
                </p>
            </div>
            <div class="flex flex-wrap gap-3">
                @auth
                    <a href="{{ route('projects.create') }}" class="rounded-md bg-teal-700 px-5 py-3 font-bold text-white hover:bg-teal-800">إنشاء دعوة</a>
                    <a href="{{ route('projects.index') }}" class="rounded-md border border-zinc-300 px-5 py-3 font-bold text-zinc-800 hover:bg-white">عرض المشاريع</a>
                @else
                    <a href="{{ route('register') }}" class="rounded-md bg-teal-700 px-5 py-3 font-bold text-white hover:bg-teal-800">ابدأ الآن</a>
                    <a href="{{ route('login') }}" class="rounded-md border border-zinc-300 px-5 py-3 font-bold text-zinc-800 hover:bg-white">لدي حساب</a>
                @endauth
            </div>
        </div>

        <div class="invite-stage min-h-[520px] rounded-md border border-zinc-200 bg-white p-6 shadow-sm">
            <section class="invitation-ticket welcome-ticket" aria-label="مثال على دعوة مناقشة مشروع">
                <div class="ticket-main">
                    <p class="ticket-kicker">Graduation Project Defense</p>
                    <div class="ticket-heading">
                        <span>دعوة لحضور</span>
                        <strong>مناقشة مشروع تخرج</strong>
                    </div>
                    <div class="ticket-facts">
                        <div>
                            <span>الساعة</span>
                            <strong>12:00 PM</strong>
                        </div>
                        <div>
                            <span>المكان</span>
                            <strong>قاعة المؤتمرات</strong>
                        </div>
                    </div>
                </div>
                <div class="ticket-date" aria-hidden="true">
                    <strong>30</strong>
                    <span>أغسطس</span>
                    <small>2026</small>
                </div>
                <div class="ticket-code" aria-hidden="true"><span></span></div>
            </section>
            <div class="mt-8 rounded-md border border-teal-100 bg-teal-50 p-5 text-center">
                <p class="text-sm font-bold text-teal-800">السلام عليكم ورحمة الله وبركاته</p>
                <p class="mt-3 leading-8 text-zinc-700">يسرّنا دعوتكم لمشاركتنا لحظة حصاد سنوات الدراسة والجهد، وحضور مناقشة مشروع تخرجنا.</p>
            </div>
        </div>
    </section>
</x-layouts.app>

<div>
    <section class="mx-auto max-w-md rounded-md border border-zinc-200 bg-white p-6 shadow-sm">
        <h1 class="text-2xl font-black">الدخول بحساب الكلية الجامعية</h1>
        <p class="mt-2 text-sm leading-6 text-zinc-600">استخدم حساب Google الجامعي المنتهي بـ <span dir="ltr">@smail.ucas.edu.ps</span> أو <span dir="ltr">@ucas.edu.ps</span>.</p>

        @if (session('authError'))
            <p class="mt-5 rounded-md border border-red-200 bg-red-50 px-3 py-2 text-sm font-bold text-red-800">{{ session('authError') }}</p>
        @endif

        <a href="{{ route('auth.google.redirect') }}" class="mt-6 flex items-center justify-center rounded-md bg-teal-700 px-4 py-3 font-bold text-white hover:bg-teal-800">المتابعة باستخدام Google</a>
    </section>
</div>

<x-layouts.app title="إنشاء دعوة">
    <section class="rounded-md border border-zinc-200 bg-white p-6 shadow-sm">
        <div class="mb-6">
            <h1 class="text-3xl font-black">إنشاء دعوة مناقشة</h1>
            <p class="mt-2 text-zinc-600">أدخل بيانات المشروع والموعد، وبعد الحفظ ستظهر صفحة المعاينة والإرسال.</p>
        </div>

        <form method="POST" action="{{ route('projects.store') }}" class="flex flex-col gap-6">
            @csrf
            @include('projects.form')
            <div class="flex gap-3">
                <button class="rounded-md bg-teal-700 px-5 py-3 font-bold text-white hover:bg-teal-800">إنشاء الدعوة</button>
                <a href="{{ route('projects.index') }}" class="rounded-md border border-zinc-300 px-5 py-3 font-bold text-zinc-800 hover:bg-zinc-50">إلغاء</a>
            </div>
        </form>
    </section>
</x-layouts.app>

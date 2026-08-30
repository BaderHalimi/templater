<x-layouts.app title="تعديل الدعوة">
    <section class="rounded-md border border-zinc-200 bg-white p-6 shadow-sm">
        <div class="mb-6">
            <h1 class="text-3xl font-black">تعديل الدعوة</h1>
            <p class="mt-2 text-zinc-600">أي تعديل هنا سينعكس فوراً على المعاينة ورسائل البريد القادمة.</p>
        </div>

        <form method="POST" action="{{ route('projects.update', $project) }}" class="flex flex-col gap-6">
            @csrf
            @method('PUT')
            @include('projects.form', ['project' => $project])
            <div class="flex gap-3">
                <button class="rounded-md bg-teal-700 px-5 py-3 font-bold text-white hover:bg-teal-800">حفظ التعديلات</button>
                <a href="{{ route('projects.show', $project) }}" class="rounded-md border border-zinc-300 px-5 py-3 font-bold text-zinc-800 hover:bg-zinc-50">رجوع للمعاينة</a>
            </div>
        </form>
    </section>
</x-layouts.app>

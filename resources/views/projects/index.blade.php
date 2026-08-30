<x-layouts.app title="مشاريعي">
    <div class="flex flex-col gap-6">
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
            <div>
                <h1 class="text-3xl font-black">مشاريع الدعوات</h1>
                <p class="mt-2 text-zinc-600">أنشئ دعوة، عاين شكلها، ثم أرسلها لمجموعة إيميلات.</p>
            </div>
            <a href="{{ route('projects.create') }}" class="inline-flex items-center justify-center rounded-md bg-teal-700 px-4 py-3 font-bold text-white hover:bg-teal-800">مشروع جديد</a>
        </div>

        @if ($projects->isEmpty())
            <div class="rounded-md border border-dashed border-zinc-300 bg-white p-8 text-center">
                <h2 class="text-xl font-bold">لا توجد دعوات بعد</h2>
                <p class="mt-2 text-zinc-600">ابدأ بإدخال عنوان المشروع وأعضاء الفريق وموعد المناقشة.</p>
            </div>
        @else
            <div class="grid gap-4 md:grid-cols-2">
                @foreach ($projects as $project)
                    <article class="rounded-md border border-zinc-200 bg-white p-5 shadow-sm">
                        <h2 class="text-xl font-black leading-8">{{ $project->title }}</h2>
                        <p class="mt-3 text-sm text-zinc-600">{{ $project->discussion_at->translatedFormat('l، d F Y - h:i A') }}</p>
                        <p class="mt-1 text-sm text-zinc-600">{{ $project->discussion_place }}</p>
                        <div class="mt-5 flex gap-2">
                            <a href="{{ route('projects.show', $project) }}" class="rounded-md bg-zinc-950 px-3 py-2 text-sm font-bold text-white hover:bg-zinc-800">معاينة وإرسال</a>
                            <a href="{{ route('projects.edit', $project) }}" class="rounded-md border border-zinc-300 px-3 py-2 text-sm font-bold text-zinc-800 hover:bg-zinc-50">تعديل</a>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </div>
</x-layouts.app>

<div>
    @php
        $selectedTemplate = \App\InvitationTextTemplate::tryFrom($textTemplate) ?? \App\InvitationTextTemplate::Formal;
    @endphp

    <div class="grid gap-8 xl:grid-cols-[minmax(0,1fr)_340px]">
        <section class="rounded-md border border-zinc-200 bg-white p-6 shadow-sm">
            <div class="mb-6">
                <p class="text-sm font-bold text-teal-700">{{ $project ? 'تحرير الدعوة' : 'مشروع جديد' }}</p>
                <h1 class="mt-1 text-3xl font-black">{{ $project ? 'حدّث تفاصيل الموعد' : 'ابدأ من تفاصيل المشروع' }}</h1>
                <p class="mt-2 text-zinc-600">كل تعديل هنا ينعكس في البطاقة الجانبية مباشرة.</p>
            </div>

            <form wire:submit="save" class="flex flex-col gap-6">
                <div class="grid gap-5 lg:grid-cols-2">
                    <label class="flex flex-col gap-2 lg:col-span-2">
                        <span class="text-sm font-bold">عنوان المشروع</span>
                        <input wire:model.live.debounce.300ms="title" required class="rounded-md border border-zinc-300 px-3 py-2 focus:border-teal-700 focus:outline-none">
                        @error('title') <span class="text-sm text-red-700">{{ $message }}</span> @enderror
                    </label>

                    <label class="flex flex-col gap-2 lg:col-span-2">
                        <span class="text-sm font-bold">أعضاء الفريق</span>
                        <textarea wire:model.live.debounce.300ms="teamMembers" rows="4" required class="rounded-md border border-zinc-300 px-3 py-2 focus:border-teal-700 focus:outline-none" placeholder="اكتب كل اسم في سطر أو افصل بينهم بفاصلة"></textarea>
                        @error('teamMembers') <span class="text-sm text-red-700">{{ $message }}</span> @enderror
                    </label>

                    <label class="flex flex-col gap-2">
                        <span class="text-sm font-bold">المشرف</span>
                        <input wire:model.live.debounce.300ms="supervisor" class="rounded-md border border-zinc-300 px-3 py-2 focus:border-teal-700 focus:outline-none">
                        @error('supervisor') <span class="text-sm text-red-700">{{ $message }}</span> @enderror
                    </label>

                    <label class="flex flex-col gap-2">
                        <span class="text-sm font-bold">موعد المناقشة</span>
                        <input type="datetime-local" wire:model.live="discussionAt" required class="rounded-md border border-zinc-300 px-3 py-2 text-left focus:border-teal-700 focus:outline-none" dir="ltr">
                        @error('discussionAt') <span class="text-sm text-red-700">{{ $message }}</span> @enderror
                    </label>

                    <label class="flex flex-col gap-2 lg:col-span-2">
                        <span class="text-sm font-bold">مكان المناقشة</span>
                        <input wire:model.live.debounce.300ms="discussionPlace" required class="rounded-md border border-zinc-300 px-3 py-2 focus:border-teal-700 focus:outline-none">
                        @error('discussionPlace') <span class="text-sm text-red-700">{{ $message }}</span> @enderror
                    </label>

                    <label class="flex flex-col gap-2 lg:col-span-2">
                        <span class="text-sm font-bold">نبرة الدعوة</span>
                        <select wire:model.live="textTemplate" required class="rounded-md border border-zinc-300 bg-white px-3 py-2 focus:border-teal-700 focus:outline-none">
                            @foreach (\App\InvitationTextTemplate::options() as $value => $template)
                                <option wire:key="template-{{ $value }}" value="{{ $value }}">{{ $template['label'] }} - {{ $template['description'] }}</option>
                            @endforeach
                        </select>
                        @error('textTemplate') <span class="text-sm text-red-700">{{ $message }}</span> @enderror
                    </label>

                    <label class="flex flex-col gap-2 lg:col-span-2">
                        <span class="text-sm font-bold">ملاحظة إضافية اختيارية</span>
                        <textarea wire:model.live.debounce.300ms="notes" rows="3" class="rounded-md border border-zinc-300 px-3 py-2 focus:border-teal-700 focus:outline-none"></textarea>
                        @error('notes') <span class="text-sm text-red-700">{{ $message }}</span> @enderror
                    </label>
                </div>

                <div class="flex flex-wrap gap-3">
                    <button class="rounded-md bg-teal-700 px-5 py-3 font-bold text-white hover:bg-teal-800" wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="save">{{ $project ? 'حفظ التعديلات' : 'إنشاء الدعوة' }}</span>
                        <span wire:loading wire:target="save">جارٍ الحفظ...</span>
                    </button>
                    <a href="{{ $project ? route('projects.show', $project) : route('projects.index') }}" wire:navigate class="rounded-md border border-zinc-300 px-5 py-3 font-bold text-zinc-800 hover:bg-zinc-50">إلغاء</a>
                </div>
            </form>
        </section>

        <aside class="h-fit rounded-md border border-zinc-200 bg-white p-5 shadow-sm xl:sticky xl:top-6">
            <p class="text-sm font-bold text-teal-700">معاينة النبرة</p>
            <p class="mt-4 text-lg font-black text-zinc-900">{{ $selectedTemplate->greeting() }}</p>
            <p class="mt-3 leading-8 text-zinc-600">{{ $selectedTemplate->intro() }}</p>
            <div class="mt-5 border-r-4 border-teal-700 bg-teal-50 p-4">
                <p class="line-clamp-3 text-lg font-black leading-8 text-teal-900">{{ $title ?: 'عنوان مشروعك سيظهر هنا' }}</p>
            </div>
            <p class="mt-5 leading-8 text-zinc-600">{{ $selectedTemplate->closing() }}</p>
            <p class="mt-4 font-bold text-teal-800">{{ $selectedTemplate->signOff() }}</p>
        </aside>
    </div>
</div>

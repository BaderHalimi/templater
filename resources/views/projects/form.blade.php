@php
    $project ??= null;
@endphp

<div class="grid gap-5 lg:grid-cols-2">
    <label class="flex flex-col gap-2 lg:col-span-2">
        <span class="text-sm font-bold">عنوان المشروع</span>
        <input name="title" value="{{ old('title', $project?->title) }}" required class="rounded-md border border-zinc-300 px-3 py-2 focus:border-teal-700 focus:outline-none">
        @error('title') <span class="text-sm text-red-700">{{ $message }}</span> @enderror
    </label>

    <label class="flex flex-col gap-2 lg:col-span-2">
        <span class="text-sm font-bold">أعضاء الفريق</span>
        <textarea name="team_members" rows="4" required class="rounded-md border border-zinc-300 px-3 py-2 focus:border-teal-700 focus:outline-none" placeholder="اكتب كل اسم في سطر أو افصل بينهم بفاصلة">{{ old('team_members', $project ? implode("\n", $project->team_members) : '') }}</textarea>
        @error('team_members') <span class="text-sm text-red-700">{{ $message }}</span> @enderror
    </label>

    <label class="flex flex-col gap-2">
        <span class="text-sm font-bold">المشرف</span>
        <input name="supervisor" value="{{ old('supervisor', $project?->supervisor) }}" class="rounded-md border border-zinc-300 px-3 py-2 focus:border-teal-700 focus:outline-none">
        @error('supervisor') <span class="text-sm text-red-700">{{ $message }}</span> @enderror
    </label>

    <label class="flex flex-col gap-2">
        <span class="text-sm font-bold">موعد المناقشة</span>
        <input type="datetime-local" name="discussion_at" value="{{ old('discussion_at', $project?->discussion_at?->format('Y-m-d\TH:i')) }}" required class="rounded-md border border-zinc-300 px-3 py-2 text-left focus:border-teal-700 focus:outline-none" dir="ltr">
        @error('discussion_at') <span class="text-sm text-red-700">{{ $message }}</span> @enderror
    </label>

    <label class="flex flex-col gap-2 lg:col-span-2">
        <span class="text-sm font-bold">مكان المناقشة</span>
        <input name="discussion_place" value="{{ old('discussion_place', $project?->discussion_place) }}" required class="rounded-md border border-zinc-300 px-3 py-2 focus:border-teal-700 focus:outline-none">
        @error('discussion_place') <span class="text-sm text-red-700">{{ $message }}</span> @enderror
    </label>

    <label class="flex flex-col gap-2 lg:col-span-2">
        <span class="text-sm font-bold">أسلوب نص الدعوة</span>
        <select name="text_template" required class="rounded-md border border-zinc-300 bg-white px-3 py-2 focus:border-teal-700 focus:outline-none">
            @foreach (\App\InvitationTextTemplate::options() as $value => $template)
                <option value="{{ $value }}" @selected(old('text_template', $project?->text_template?->value ?? 'formal') === $value)>
                    {{ $template['label'] }} - {{ $template['description'] }}
                </option>
            @endforeach
        </select>
        @error('text_template') <span class="text-sm text-red-700">{{ $message }}</span> @enderror
    </label>

    <label class="flex flex-col gap-2 lg:col-span-2">
        <span class="text-sm font-bold">ملاحظات إضافية اختيارية</span>
        <textarea name="notes" rows="3" class="rounded-md border border-zinc-300 px-3 py-2 focus:border-teal-700 focus:outline-none">{{ old('notes', $project?->notes) }}</textarea>
        @error('notes') <span class="text-sm text-red-700">{{ $message }}</span> @enderror
    </label>
</div>

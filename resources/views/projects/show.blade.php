<x-layouts.app :title="'دعوة '.$project->title">
    <div class="grid gap-8 lg:grid-cols-[1fr_360px]">
        <section class="rounded-md border border-zinc-200 bg-white p-4 shadow-sm sm:p-6">
            <div class="mb-5 flex flex-col justify-between gap-3 sm:flex-row sm:items-center">
                <div>
                    <p class="text-sm font-bold text-teal-700">معاينة الدعوة</p>
                    <h1 class="mt-1 text-2xl font-black leading-9">{{ $project->title }}</h1>
                </div>
                <a href="{{ route('projects.edit', $project) }}" class="rounded-md border border-zinc-300 px-4 py-2 text-center text-sm font-bold hover:bg-zinc-50">تعديل التفاصيل</a>
            </div>

            <div class="web-invitation-preview">
                <div class="preview-sparkline" aria-hidden="true"></div>
                <div class="floating-envelope small" aria-hidden="true">
                    <div class="envelope-back"></div>
                    <div class="envelope-card">
                        <span>دعوة رسمية</span>
                        <strong>مناقشة مشروع</strong>
                        <small>{{ $project->discussion_at->translatedFormat('l، d F Y') }}</small>
                    </div>
                    <div class="envelope-front"></div>
                    <div class="envelope-flap"></div>
                </div>

                <article class="invitation-paper">
                    <p class="text-base font-bold text-teal-800">السلام عليكم ورحمة الله وبركاته،</p>
                    <p>تحية طيبة وبعد،</p>
                    <p>يسرّنا ويسعدنا دعوتكم لمشاركتنا لحظة حصاد سنوات الدراسة والجهد، وحضور مناقشة مشروع تخرجنا بعنوان:</p>

                    <h2>{{ $project->title }}</h2>

                    <div class="detail-grid">
                        <div>
                            <span>فريق العمل</span>
                            <strong>{{ implode('، ', $project->team_members) }}</strong>
                        </div>
                        @if ($project->supervisor)
                            <div>
                                <span>تحت إشراف</span>
                                <strong>{{ $project->supervisor }}</strong>
                            </div>
                        @endif
                        <div>
                            <span>اليوم والتاريخ</span>
                            <strong>{{ $project->discussion_at->translatedFormat('l، d F Y') }}</strong>
                        </div>
                        <div>
                            <span>التوقيت</span>
                            <strong>{{ $project->discussion_at->translatedFormat('h:i A') }}</strong>
                        </div>
                        <div class="lg:col-span-2">
                            <span>المكان</span>
                            <strong>{{ $project->discussion_place }}</strong>
                        </div>
                    </div>

                    @if ($project->notes)
                        <p>{{ $project->notes }}</p>
                    @endif

                    <p>يسعدنا حضوركم وتشريفكم لنا في هذه المناسبة المميزة، فحضوركم يكتمل به فرحنا ويسعدنا جداً.</p>
                    <p class="signature">دمتم بخير وود،<br>فريق المشروع</p>
                </article>
            </div>
        </section>

        <aside class="h-fit rounded-md border border-zinc-200 bg-white p-5 shadow-sm">
            <h2 class="text-xl font-black">إرسال الدعوة</h2>
            <p class="mt-2 text-sm leading-6 text-zinc-600">أدخل كل بريد في سطر، أو افصل بينها بفاصلة. سيتم إرسال HTML الدعوة فوراً.</p>

            <form method="POST" action="{{ route('projects.invitations.send', $project) }}" class="mt-5 flex flex-col gap-4">
                @csrf
                <label class="flex flex-col gap-2">
                    <span class="text-sm font-bold">الإيميلات</span>
                    <textarea name="emails" rows="8" required class="rounded-md border border-zinc-300 px-3 py-2 text-left focus:border-teal-700 focus:outline-none" dir="ltr" placeholder="friend@example.com&#10;teacher@example.com">{{ old('emails') }}</textarea>
                    @error('emails') <span class="text-sm text-red-700">{{ $message }}</span> @enderror
                </label>
                <button class="rounded-md bg-teal-700 px-4 py-3 font-bold text-white hover:bg-teal-800">إرسال الآن</button>
            </form>
        </aside>
    </div>
</x-layouts.app>

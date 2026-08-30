@php
    $textTemplate = $project->invitationTextTemplate();
@endphp

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
                <section class="invitation-ticket" aria-label="ملخص موعد مناقشة المشروع">
                    <div class="ticket-main">
                        <p class="ticket-kicker" style="line-height: 1.7; letter-spacing: 0; text-transform: none;" dir="rtl">النــــــــادي الهنـــــــدسي<br><span class="text-[0.68rem] font-semibold">مساحة للابداع والتميز</span></p>
                        <div class="ticket-heading">
                            <span>دعوة لحضور</span>
                            <strong>مناقشة مشروع تخرج</strong>
                        </div>
                        <div class="ticket-facts">
                            <div>
                                <span>الساعة</span>
                                <strong>{{ $project->discussion_at->translatedFormat('h:i A') }}</strong>
                            </div>
                            <div>
                                <span>المكان</span>
                                <strong>{{ $project->discussion_place }}</strong>
                            </div>
                        </div>
                    </div>
                    <div class="ticket-date" aria-hidden="true">
                        <strong>{{ $project->discussion_at->translatedFormat('d') }}</strong>
                        <span>{{ $project->discussion_at->translatedFormat('F') }}</span>
                        <small>{{ $project->discussion_at->translatedFormat('Y') }}</small>
                    </div>
                    <div class="ticket-code" aria-hidden="true"><span></span></div>
                </section>

                <article class="invitation-paper">
                    <p class="text-base font-bold text-teal-800">{{ $textTemplate->greeting() }}</p>
                    <p>{{ $textTemplate->intro() }}</p>

                    <h2>{{ $project->title }}</h2>

                    <div class="detail-grid">
                        <div>
                            <span>أعضاء الفريق</span>
                            <ul class="team-members">
                                @foreach ($project->team_members as $member)
                                    <li>{{ $member }}</li>
                                @endforeach
                            </ul>
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

                    <p>{{ $textTemplate->closing() }}</p>
                    <p class="signature">{{ $textTemplate->signOff() }}<br>فريق المشروع</p>
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

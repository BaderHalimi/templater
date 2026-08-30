<!DOCTYPE html>
<html lang="ar" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            @keyframes cardLift {
                0% { transform: translateY(18px); opacity: 0.68; }
                55% { transform: translateY(-8px); opacity: 1; }
                100% { transform: translateY(0); opacity: 1; }
            }
            body { margin: 0; background: #f7f4ef; color: #18181b; font-family: Arial, Tahoma, sans-serif; }
            .wrap { width: 100%; padding: 28px 0; }
            .shell { width: 92%; max-width: 680px; margin: 0 auto; background: #ffffff; border: 1px solid #ded8ce; border-radius: 8px; overflow: hidden; }
            .hero { background: #0f766e; padding: 30px 24px; text-align: center; color: #ffffff; }
            .envelope { position: relative; width: 190px; height: 118px; margin: 0 auto 24px; }
            .card { position: absolute; left: 20px; right: 20px; top: -18px; background: #fffaf0; border-radius: 6px; padding: 18px 10px; color: #134e4a; box-shadow: 0 16px 28px rgba(15, 23, 42, 0.20); animation: cardLift 1.4s ease-out both; }
            .front { position: absolute; inset: 35px 0 0; background: #f59e0b; border-radius: 0 0 8px 8px; }
            .flap { position: absolute; left: 0; right: 0; top: 35px; height: 78px; background: #fbbf24; clip-path: polygon(0 0, 50% 62%, 100% 0, 100% 100%, 0 100%); }
            h1 { margin: 0; font-size: 24px; line-height: 1.5; }
            .content { padding: 30px 28px; font-size: 16px; line-height: 2; }
            .title { margin: 24px 0; padding: 18px; border-right: 5px solid #0f766e; background: #f0fdfa; font-size: 22px; line-height: 1.55; font-weight: 800; color: #115e59; }
            .details { margin: 22px 0; border-collapse: collapse; width: 100%; }
            .details td { padding: 12px; border-bottom: 1px solid #e7e5e4; vertical-align: top; }
            .label { width: 34%; color: #52525b; font-size: 13px; font-weight: 700; }
            .value { color: #18181b; font-weight: 700; }
            .footer { padding: 18px 28px 30px; color: #52525b; font-size: 14px; text-align: center; }
        </style>
    </head>
    <body>
        <div class="wrap">
            <div class="shell">
                <div class="hero">
                    <div class="envelope" aria-hidden="true">
                        <div class="card">دعوة مناقشة</div>
                        <div class="front"></div>
                        <div class="flap"></div>
                    </div>
                    <h1>دعوة لحضور مناقشة مشروع تخرج</h1>
                </div>

                <div class="content">
                    <p>السلام عليكم ورحمة الله وبركاته،</p>
                    <p>تحية طيبة وبعد،</p>
                    <p>يسرّنا ويسعدنا دعوتكم لمشاركتنا لحظة حصاد سنوات الدراسة والجهد، وحضور مناقشة مشروع تخرجنا بعنوان:</p>

                    <div class="title">{{ $project->title }}</div>

                    <table class="details" role="presentation">
                        <tr>
                            <td class="label">فريق العمل</td>
                            <td class="value">{{ implode('، ', $project->team_members) }}</td>
                        </tr>
                        @if ($project->supervisor)
                            <tr>
                                <td class="label">تحت إشراف</td>
                                <td class="value">{{ $project->supervisor }}</td>
                            </tr>
                        @endif
                        <tr>
                            <td class="label">اليوم والتاريخ</td>
                            <td class="value">{{ $project->discussion_at->translatedFormat('l، d F Y') }}</td>
                        </tr>
                        <tr>
                            <td class="label">التوقيت</td>
                            <td class="value">{{ $project->discussion_at->translatedFormat('h:i A') }}</td>
                        </tr>
                        <tr>
                            <td class="label">المكان</td>
                            <td class="value">{{ $project->discussion_place }}</td>
                        </tr>
                    </table>

                    @if ($project->notes)
                        <p>{{ $project->notes }}</p>
                    @endif

                    <p>يسعدنا حضوركم وتشريفكم لنا في هذه المناسبة المميزة، فحضوركم يكتمل به فرحنا ويسعدنا جداً.</p>
                    <p>دمتم بخير وود،<br>فريق المشروع</p>
                </div>

                <div class="footer">تم إرسال هذه الدعوة عبر Templater</div>
            </div>
        </div>
    </body>
</html>

@php
    $textTemplate = $project->invitationTextTemplate();
@endphp

<!DOCTYPE html>
<html lang="ar" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="format-detection" content="telephone=no,date=no,address=no,email=no,url=no">
        <style>
            @media only screen and (max-width: 640px) {
                .email-shell { width: 100% !important; }
                .email-outer { padding: 12px 0 !important; }
                .email-padding { padding: 26px 20px 8px !important; }
                .ticket-main { padding: 20px 16px !important; }
                .ticket-date { width: 82px !important; padding: 14px 4px !important; }
                .ticket-date-number { font-size: 36px !important; }
                .ticket-date-month { margin-top: 6px !important; font-size: 12px !important; }
                .ticket-date-year { font-size: 10px !important; }
                .ticket-logo { width: 36px !important; height: 48px !important; }
                .ticket-kicker { font-size: 9px !important; line-height: 1.5 !important; letter-spacing: 0.6px !important; }
                .ticket-pretitle { font-size: 12px !important; }
                .ticket-title { font-size: 20px !important; line-height: 1.35 !important; }
                .ticket-facts { margin-top: 20px !important; }
                .ticket-time-cell { padding-left: 8px !important; }
                .ticket-fact-label { font-size: 10px !important; }
                .ticket-fact-value { font-size: 12px !important; line-height: 1.45 !important; }
                .email-greeting { font-size: 16px !important; }
                .email-copy { font-size: 14px !important; line-height: 1.85 !important; }
                .project-title { margin: 20px 0 !important; padding: 15px 16px !important; font-size: 19px !important; line-height: 1.45 !important; }
                .detail-label, .detail-value { display: block !important; width: auto !important; }
                .detail-label { padding: 10px 10px 3px !important; font-size: 12px !important; border-bottom: 0 !important; }
                .detail-value { padding: 0 10px 10px !important; font-size: 13px !important; line-height: 1.75 !important; }
                .email-footer { padding: 18px 20px 24px !important; font-size: 11px !important; }
            }
        </style>
    </head>
    <body style="margin: 0; padding: 0; background-color: #edf4f1; color: #18181b; font-family: Tahoma, Arial, sans-serif;" dir="rtl">
        <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="width: 100%; border-collapse: collapse; background-color: #edf4f1;" dir="rtl">
            <tr>
                <td class="email-outer" align="center" style="padding: 28px 12px;">
                    <table role="presentation" class="email-shell" width="640" cellspacing="0" cellpadding="0" border="0" style="width: 640px; max-width: 640px; border-collapse: collapse; background-color: #ffffff; border: 1px solid #d9e5df;" dir="rtl">
                        <tr>
                            <td style="padding: 0;">
                                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="width: 100%; border-collapse: collapse;" dir="rtl">
                                    <tr>
                                        <td class="ticket-main" valign="top" style="padding: 30px 32px; background-color: #173c39; color: #ffffff;">
                                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" style="border-collapse: collapse; margin: 0 0 26px;" dir="rtl">
                                                <tr>
                                                    <td valign="middle" style="padding-left: 10px;">
                                                        <img src="{{ asset('logo/ucas_eng_club_web.png') }}" width="48" height="64" alt="شعار نادي UCAS الهندسي" class="ticket-logo" style="display: block; width: 48px; height: 64px; border: 0; object-fit: contain;">
                                                    </td>
                                                    <td class="ticket-kicker" valign="middle" style="color: #a7d7c6; font-size: 11px; font-weight: 700; letter-spacing: 1px;">GRADUATION PROJECT DEFENSE</td>
                                                </tr>
                                            </table>
                                            <p class="ticket-pretitle" style="margin: 0 0 8px; color: #e3efea; font-size: 14px; font-weight: 700;">دعوة لحضور</p>
                                            <h1 class="ticket-title" style="margin: 0; color: #ffffff; font-size: 27px; line-height: 1.4; font-weight: 800;">مناقشة مشروع تخرج</h1>
                                            <table role="presentation" class="ticket-facts" width="100%" cellspacing="0" cellpadding="0" border="0" style="width: 100%; border-collapse: collapse; margin-top: 28px;" dir="rtl">
                                                <tr>
                                                    <td class="ticket-time-cell" valign="top" style="padding-left: 20px;">
                                                        <p class="ticket-fact-label" style="margin: 0 0 5px; color: #a7d7c6; font-size: 11px; font-weight: 700;">الساعة</p>
                                                        <p class="ticket-fact-value" style="margin: 0; color: #ffffff; font-size: 14px; font-weight: 700;">{{ $project->discussion_at->translatedFormat('h:i A') }}</p>
                                                    </td>
                                                    <td valign="top">
                                                        <p class="ticket-fact-label" style="margin: 0 0 5px; color: #a7d7c6; font-size: 11px; font-weight: 700;">المكان</p>
                                                        <p class="ticket-fact-value" style="margin: 0; color: #ffffff; font-size: 14px; line-height: 1.6; font-weight: 700;">{{ $project->discussion_place }}</p>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td class="ticket-date" width="142" align="center" valign="middle" style="width: 142px; padding: 22px 10px; background-color: #f3eee4; border-right: 1px dashed #8bc9b5; color: #173c39;">
                                            <p class="ticket-date-number" style="margin: 0; color: #173c39; font-size: 50px; line-height: 1; font-weight: 800;">{{ $project->discussion_at->translatedFormat('d') }}</p>
                                            <p class="ticket-date-month" style="margin: 8px 0 4px; color: #173c39; font-size: 14px; font-weight: 800;">{{ $project->discussion_at->translatedFormat('F') }}</p>
                                            <p class="ticket-date-year" style="margin: 0; color: #5f756f; font-size: 12px; font-weight: 700;">{{ $project->discussion_at->translatedFormat('Y') }}</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr>
                            <td class="email-padding" style="padding: 34px 38px 12px;">
                                <p class="email-greeting" style="margin: 0; color: #0f766e; font-size: 17px; line-height: 1.8; font-weight: 800;">{{ $textTemplate->greeting() }}</p>
                                <p class="email-copy" style="margin: 18px 0 0; color: #3f3f46; font-size: 16px; line-height: 2;">{{ $textTemplate->intro() }}</p>

                                <div class="project-title" style="margin: 24px 0; padding: 19px 20px; background-color: #f0fdfa; border-right: 5px solid #0f766e; color: #115e59; font-size: 24px; line-height: 1.55; font-weight: 800; word-break: break-word;">{{ $project->title }}</div>

                                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="width: 100%; border-collapse: collapse; border: 1px solid #e2e8e5;" dir="rtl">
                                    <tr>
                                        <td class="detail-label" width="155" valign="top" style="width: 155px; padding: 15px; border-bottom: 1px solid #e2e8e5; color: #5f756f; font-size: 13px; font-weight: 700;">أعضاء الفريق</td>
                                        <td class="detail-value" valign="top" style="padding: 15px; border-bottom: 1px solid #e2e8e5; color: #18181b; font-size: 15px; line-height: 1.9; font-weight: 700;">
                                            @foreach ($project->team_members as $member)
                                                <div style="margin: 0 0 4px;">{{ $loop->iteration }}. {{ $member }}</div>
                                            @endforeach
                                        </td>
                                    </tr>
                                    @if ($project->supervisor)
                                        <tr>
                                            <td class="detail-label" width="155" valign="top" style="width: 155px; padding: 15px; border-bottom: 1px solid #e2e8e5; color: #5f756f; font-size: 13px; font-weight: 700;">تحت إشراف</td>
                                            <td class="detail-value" valign="top" style="padding: 15px; border-bottom: 1px solid #e2e8e5; color: #18181b; font-size: 15px; line-height: 1.8; font-weight: 700;">{{ $project->supervisor }}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td class="detail-label" width="155" valign="top" style="width: 155px; padding: 15px; border-bottom: 1px solid #e2e8e5; color: #5f756f; font-size: 13px; font-weight: 700;">اليوم والتاريخ</td>
                                        <td class="detail-value" valign="top" style="padding: 15px; border-bottom: 1px solid #e2e8e5; color: #18181b; font-size: 15px; line-height: 1.8; font-weight: 700;">{{ $project->discussion_at->translatedFormat('l، d F Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="detail-label" width="155" valign="top" style="width: 155px; padding: 15px; border-bottom: 1px solid #e2e8e5; color: #5f756f; font-size: 13px; font-weight: 700;">التوقيت</td>
                                        <td class="detail-value" valign="top" style="padding: 15px; border-bottom: 1px solid #e2e8e5; color: #18181b; font-size: 15px; line-height: 1.8; font-weight: 700;">{{ $project->discussion_at->translatedFormat('h:i A') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="detail-label" width="155" valign="top" style="width: 155px; padding: 15px; color: #5f756f; font-size: 13px; font-weight: 700;">المكان</td>
                                        <td class="detail-value" valign="top" style="padding: 15px; color: #18181b; font-size: 15px; line-height: 1.8; font-weight: 700;">{{ $project->discussion_place }}</td>
                                    </tr>
                                </table>

                                @if ($project->notes)
                                    <p class="email-copy" style="margin: 24px 0 0; color: #3f3f46; font-size: 16px; line-height: 2;">{{ $project->notes }}</p>
                                @endif

                                <p class="email-copy" style="margin: 25px 0 0; color: #3f3f46; font-size: 16px; line-height: 2;">{{ $textTemplate->closing() }}</p>
                                <p class="email-copy" style="margin: 18px 0 0; color: #0f766e; font-size: 16px; line-height: 1.9; font-weight: 800;">{{ $textTemplate->signOff() }}<br>فريق المشروع</p>
                            </td>
                        </tr>
                        <tr>
                            <td class="email-footer" align="center" style="padding: 24px 28px 30px; color: #71817c; font-size: 12px; line-height: 1.8;">دعوة مشروع تخرج تم إعدادها عبر <a href="{{ config('app.url') }}" style="color: #0f766e; font-weight: 800; text-decoration: none;">{{ config('app.name') }}</a></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>

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
                .email-padding { padding-right: 20px !important; padding-left: 20px !important; }
                .ticket-main { padding: 24px 20px !important; }
                .ticket-date { width: 108px !important; }
                .ticket-date-number { font-size: 40px !important; }
                .detail-label, .detail-value { display: block !important; width: auto !important; }
                .detail-value { padding-top: 0 !important; }
            }
        </style>
    </head>
    <body style="margin: 0; padding: 0; background-color: #edf4f1; color: #18181b; font-family: Tahoma, Arial, sans-serif;" dir="rtl">
        <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="width: 100%; border-collapse: collapse; background-color: #edf4f1;" dir="rtl">
            <tr>
                <td align="center" style="padding: 28px 12px;">
                    <table role="presentation" class="email-shell" width="640" cellspacing="0" cellpadding="0" border="0" style="width: 640px; max-width: 640px; border-collapse: collapse; background-color: #ffffff; border: 1px solid #d9e5df;" dir="rtl">
                        <tr>
                            <td style="padding: 0;">
                                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="width: 100%; border-collapse: collapse;" dir="rtl">
                                    <tr>
                                        <td class="ticket-main" valign="top" style="padding: 30px 32px; background-color: #173c39; color: #ffffff;">
                                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" style="border-collapse: collapse; margin: 0 0 26px;" dir="rtl">
                                                <tr>
                                                    <td valign="middle" style="padding-left: 10px;">
                                                        <img src="{{ asset('logo/ucas_eng_club_web.png') }}" width="48" height="64" alt="شعار نادي UCAS الهندسي" style="display: block; width: 48px; height: 64px; border: 0; object-fit: contain;">
                                                    </td>
                                                    <td valign="middle" style="color: #a7d7c6; font-size: 11px; font-weight: 700; letter-spacing: 1px;">GRADUATION PROJECT DEFENSE</td>
                                                </tr>
                                            </table>
                                            <p style="margin: 0 0 8px; color: #e3efea; font-size: 14px; font-weight: 700;">دعوة لحضور</p>
                                            <h1 style="margin: 0; color: #ffffff; font-size: 27px; line-height: 1.4; font-weight: 800;">مناقشة مشروع تخرج</h1>
                                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="width: 100%; border-collapse: collapse; margin-top: 28px;" dir="rtl">
                                                <tr>
                                                    <td valign="top" style="padding-left: 20px;">
                                                        <p style="margin: 0 0 5px; color: #a7d7c6; font-size: 11px; font-weight: 700;">الساعة</p>
                                                        <p style="margin: 0; color: #ffffff; font-size: 14px; font-weight: 700;">{{ $project->discussion_at->translatedFormat('h:i A') }}</p>
                                                    </td>
                                                    <td valign="top">
                                                        <p style="margin: 0 0 5px; color: #a7d7c6; font-size: 11px; font-weight: 700;">المكان</p>
                                                        <p style="margin: 0; color: #ffffff; font-size: 14px; line-height: 1.6; font-weight: 700;">{{ $project->discussion_place }}</p>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td class="ticket-date" width="142" align="center" valign="middle" style="width: 142px; padding: 22px 10px; background-color: #f3eee4; border-right: 1px dashed #8bc9b5; color: #173c39;">
                                            <p class="ticket-date-number" style="margin: 0; color: #173c39; font-size: 50px; line-height: 1; font-weight: 800;">{{ $project->discussion_at->translatedFormat('d') }}</p>
                                            <p style="margin: 8px 0 4px; color: #173c39; font-size: 14px; font-weight: 800;">{{ $project->discussion_at->translatedFormat('F') }}</p>
                                            <p style="margin: 0; color: #5f756f; font-size: 12px; font-weight: 700;">{{ $project->discussion_at->translatedFormat('Y') }}</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr>
                            <td class="email-padding" style="padding: 34px 38px 12px;">
                                <p style="margin: 0; color: #0f766e; font-size: 17px; line-height: 1.8; font-weight: 800;">{{ $textTemplate->greeting() }}</p>
                                <p style="margin: 18px 0 0; color: #3f3f46; font-size: 16px; line-height: 2;">{{ $textTemplate->intro() }}</p>

                                <div style="margin: 24px 0; padding: 19px 20px; background-color: #f0fdfa; border-right: 5px solid #0f766e; color: #115e59; font-size: 24px; line-height: 1.55; font-weight: 800; word-break: break-word;">{{ $project->title }}</div>

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
                                    <p style="margin: 24px 0 0; color: #3f3f46; font-size: 16px; line-height: 2;">{{ $project->notes }}</p>
                                @endif

                                <p style="margin: 25px 0 0; color: #3f3f46; font-size: 16px; line-height: 2;">{{ $textTemplate->closing() }}</p>
                                <p style="margin: 18px 0 0; color: #0f766e; font-size: 16px; line-height: 1.9; font-weight: 800;">{{ $textTemplate->signOff() }}<br>فريق المشروع</p>
                            </td>
                        </tr>
                        <tr>
                            <td align="center" style="padding: 24px 28px 30px; color: #71817c; font-size: 12px; line-height: 1.8;">دعوة مشروع تخرج تم إعدادها عبر <a href="{{ config('app.url') }}" style="color: #0f766e; font-weight: 800; text-decoration: none;">{{ config('app.name') }}</a></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>

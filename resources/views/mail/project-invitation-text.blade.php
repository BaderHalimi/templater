@php
    $textTemplate = $project->invitationTextTemplate();
@endphp
{{ $textTemplate->greeting() }}

{{ $textTemplate->intro() }}

{{ $project->title }}

أعضاء الفريق:
@foreach ($project->team_members as $member)
- {{ $member }}
@endforeach

@if ($project->supervisor)
تحت إشراف:
{{ $project->supervisor }}

@endif
تفاصيل موعد المناقشة:
اليوم والتاريخ: {{ $project->discussion_at->translatedFormat('l، d F Y') }}
التوقيت: {{ $project->discussion_at->translatedFormat('h:i A') }}
المكان: {{ $project->discussion_place }}

@if ($project->notes)
{{ $project->notes }}

@endif
{{ $textTemplate->closing() }}

{{ $textTemplate->signOff() }}
فريق المشروع

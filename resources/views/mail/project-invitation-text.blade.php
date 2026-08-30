السلام عليكم ورحمة الله وبركاته،

تحية طيبة وبعد،

يسرّنا ويسعدنا دعوتكم لمشاركتنا لحظة حصاد سنوات الدراسة والجهد، وحضور مناقشة مشروع تخرجنا بعنوان:

{{ $project->title }}

فريق العمل:
{{ implode('، ', $project->team_members) }}

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
يسعدنا حضوركم وتشريفكم لنا في هذه المناسبة المميزة، فحضوركم يكتمل به فرحنا ويسعدنا جداً.

دمتم بخير وود،
فريق المشروع

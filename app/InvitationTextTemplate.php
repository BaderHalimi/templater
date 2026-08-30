<?php

namespace App;

enum InvitationTextTemplate: string
{
    case Formal = 'formal';
    case Warm = 'warm';
    case Concise = 'concise';
    case Academic = 'academic';

    /**
     * @return array<string, array{label: string, description: string}>
     */
    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn (self $template): array => [
                $template->value => [
                    'label' => $template->label(),
                    'description' => $template->description(),
                ],
            ])
            ->all();
    }

    /**
     * @return array<int, string>
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function label(): string
    {
        return match ($this) {
            self::Formal => 'رسمي وواضح',
            self::Warm => 'ودّي ومعبّر',
            self::Concise => 'مختصر ومباشر',
            self::Academic => 'أكاديمي رصين',
        };
    }

    public function description(): string
    {
        return match ($this) {
            self::Formal => 'صياغة مناسبة للدكاترة والإدارة والضيوف الرسميين.',
            self::Warm => 'صياغة لطيفة تناسب الأصدقاء والعائلة والزملاء.',
            self::Concise => 'رسالة قصيرة لمن يفضّل دعوة مباشرة بلا إطالة.',
            self::Academic => 'نبرة جامعية هادئة تركز على سياق المناقشة.',
        };
    }

    public function greeting(): string
    {
        return match ($this) {
            self::Formal => 'إلى من نعتز بحضورهم،',
            self::Warm => 'لأن النجاح يصبح أجمل حين يُشارك،',
            self::Concise => 'دعوة خاصة،',
            self::Academic => 'جلسة عرض ونقاش،',
        };
    }

    public function intro(): string
    {
        return match ($this) {
            self::Formal => 'نفتح لكم مقعداً في الموعد الذي نعرض فيه خلاصة رحلة البحث والتجربة، ونناقش مشروع تخرجنا بعنوان:',
            self::Warm => 'ندعوكم لتكونوا جزءاً من لحظة انتظرناها طويلاً؛ لحظة عرض ثمرة عملنا المشترك بعنوان:',
            self::Concise => 'يسعدنا حضوركم لمناقشة مشروع التخرج بعنوان:',
            self::Academic => 'ندعوكم إلى جلسة علمية نستعرض فيها منهجية المشروع ونتائجه ومساراته التطبيقية بعنوان:',
        };
    }

    public function closing(): string
    {
        return match ($this) {
            self::Formal => 'وجودكم يمنح هذا الموعد وزنه الحقيقي، ويسعدنا أن تشاركونا هذه المحطة.',
            self::Warm => 'وجودكم هو التفصيلة التي نرغب بها في هذه الذكرى، وننتظر لقاءكم بشوق.',
            self::Concise => 'حضوركم يسعدنا ويشرّفنا.',
            self::Academic => 'نتطلع إلى حوار مهني ثري وملاحظات قيّمة تعمّق أثر هذا العمل.',
        };
    }

    public function signOff(): string
    {
        return match ($this) {
            self::Formal => 'بانتظار حضوركم الكريم،',
            self::Warm => 'نلتقي بكم هناك،',
            self::Concise => 'مع التحية،',
            self::Academic => 'مع بالغ التقدير،',
        };
    }
}

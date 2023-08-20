<?php

namespace App\Filament\Resources\CourseResource\Widgets;

use Filament\Widgets\Widget;

class LessonsWidget extends Widget
{
    protected int | string | array $columnSpan = 'full';
    protected static string $view = 'filament.resources.course-resource.widgets.lessons-widget';

    public function updateLessonOrder($list)
    {
        dd($list);
    }
}

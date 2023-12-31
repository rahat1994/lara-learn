<?php

namespace App\Filament\Resources\CourseResource\Widgets;

use Filament\Widgets\Widget;

class StudentStatistics extends Widget
{
    protected int | string | array $columnSpan = 'full';
    protected static string $view = 'filament.resources.course-resource.widgets.student-statistics';
}

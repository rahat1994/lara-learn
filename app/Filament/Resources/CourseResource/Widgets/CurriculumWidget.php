<?php

namespace App\Filament\Resources\CourseResource\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Database\Eloquent\Model;

class CurriculumWidget extends Widget
{
    protected int | string | array $columnSpan = 'full';
    protected static string $view = 'filament.resources.course-resource.widgets.curriculums-widget';
    public ?Model $record = null;
    public function updateLessonOrder($list)
    {
        dd($this->record);
    }
}

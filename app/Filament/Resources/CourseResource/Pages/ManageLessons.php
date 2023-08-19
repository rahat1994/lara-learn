<?php

namespace App\Filament\Resources\CourseResource\Pages;

use App\Filament\Resources\CourseResource;
use App\Filament\Resources\CourseResource\Widgets\LessonsWidget;
use App\Models\Course;
use Filament\Resources\Pages\Page;

class ManageLessons extends Page
{
    protected static string $resource = CourseResource::class;
    public Course $record;
    protected static string $view = 'filament.resources.course-resource.pages.manage-lessons';

    protected function getHeaderWidgets(): array
    {
        return [
            LessonsWidget::class,
        ];
    }
}

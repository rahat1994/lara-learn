<?php

namespace App\Filament\Resources\CourseResource\Pages;

use App\Filament\Resources\CourseResource;
use App\Filament\Resources\CourseResource\Widgets\CurriculumWidget;
use App\Filament\Resources\CourseResource\Widgets\LessonsWidget;
use App\Models\Course;
use Filament\Resources\Pages\Page;

class ManageCurriculums extends Page
{
    protected static string $resource = CourseResource::class;

    protected static ?string $title = 'Course Curriculum';
    public Course $record;
    protected static string $view = 'filament.resources.course-resource.pages.manage-curriculums';

    protected function getHeaderWidgets(): array
    {
        return [
            CurriculumWidget::class,
        ];
    }
}

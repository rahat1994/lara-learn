<?php

namespace App\Filament\Resources\CourseResource\Pages;

use App\Filament\Resources\CourseResource;
use App\Filament\Resources\CourseResource\Widgets\CourseSaleChart;
use App\Filament\Resources\CourseResource\Widgets\LatestOrders;
use App\Filament\Resources\CourseResource\Widgets\StudentStatistics;
use App\Models\Course;
use Filament\Resources\Pages\Page;

class CourseDashBoard extends Page
{
    protected static string $resource = CourseResource::class;

    public Course $record;

    protected static ?string $title = 'Dashboard';

    protected static string $view = 'filament.resources.course-resource.pages.course-dash-board';

    protected function getHeaderWidgets(): array
    {
        return [
            CourseSaleChart::class,
            StudentStatistics::class,
            LatestOrders::class,
        ];
    }
}

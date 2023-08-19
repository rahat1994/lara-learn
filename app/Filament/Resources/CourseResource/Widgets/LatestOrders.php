<?php

namespace App\Filament\Resources\CourseResource\Widgets;

use App\Models\Course;
use Closure;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestOrders extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';
    protected function getTableQuery(): Builder
    {
        return Course::query()->latest();
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('id'),
            Tables\Columns\TextColumn::make('title')
                ->label('Title'),
        ];
    }
}

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LessonResource\Pages;
use App\Filament\Resources\LessonResource\RelationManagers;
use App\Forms\Components\LlDuration;
use App\Models\Lesson;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LessonResource extends Resource
{
    protected static ?string $model = Lesson::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'Lara Learn';

    public static function form(Form $form): Form
    {

        return $form
            ->schema([
                TextInput::make('title')
                    ->autofocus()
                    ->required()
                    ->maxLength(255)
                    ->placeholder(__('forms.title')),
                RichEditor::make('content')
                    ->required()
                    ->placeholder(__('forms.description')),
                TextInput::make('video_url')->url(),
                Hidden::make('user_id')
                    ->default(fn () => auth()->user()->id),
                Section::make(__('lesson_admin.settings'))
                    ->collapsible()
                    ->schema([
                        LlDuration::make('duration')
                            ->datalist([
                                'Minutes',
                                'Hours',
                                'Days',
                                'Weeks',
                                'Months',
                                'Years',

                            ]),
                        Checkbox::make(__('preview'))
                            ->default(false)
                            ->helperText(__('lesson_admin.preview_helper_text')),
                    ]),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLessons::route('/'),
            'create' => Pages\CreateLesson::route('/create'),
            'view' => Pages\ViewLesson::route('/{record}'),
            'edit' => Pages\EditLesson::route('/{record}/edit'),
        ];
    }
}

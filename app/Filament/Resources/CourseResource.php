<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CourseResource\Pages;
use App\Filament\Resources\CourseResource\RelationManagers;
use App\Filament\Resources\CourseResource\Tables\SingleActions\ManageCourseAction;
use App\Filament\Resources\CourseResource\Widgets\CourseSaleChart;
use App\Forms\Components\LlDuration;
use App\Models\Course;
use AymanAlhattami\FilamentPageWithSidebar\FilamentPageSidebar;
use AymanAlhattami\FilamentPageWithSidebar\PageNavigationItem;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';


    protected static ?string $navigationGroup = 'Lara Learn';
    protected static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label(__('forms.title'))
                    ->autofocus()
                    ->required()
                    ->maxLength(255)
                    ->placeholder(__('forms.title')),
                RichEditor::make('description')
                    ->required()
                    ->label(__('forms.description'))
                    ->placeholder(__('forms.description_placeholder')),
                FileUpload::make('image')
                    ->image()
                    ->directory('course_featured_images')
                    ->required()
                    ->placeholder(__('forms.featured_image')),
                Section::make(__('course_admin.settings'))->schema([
                    Tabs::make(__('course_admin.settings'))
                        ->tabs([
                            Tab::make(__('course_admin.general_settings'))->schema([
                                LlDuration::make('duration')
                                    ->datalist([
                                        'Minutes',
                                        'Hours',
                                        'Days',
                                        'Weeks',
                                        'Months',
                                        'Years'
                                    ]),
                                Checkbox::make('allow_repurchase')
                                    ->default(true)
                                    ->helperText(__('course_admin.allow_repurchase_helper_text')),
                                Select::make('course_level')
                                    ->helperText(__('course_admin.course_level_helper_text'))
                                    ->options([
                                        'All Levels' => 'All Levels',
                                        'Beginner Level' => 'Beginner Level',
                                        'Intermediate Level' => 'Intermediate Level',
                                        'Expert Level' => 'Expert Level',
                                    ]),
                                Select::make('language')
                                    ->helperText(__('course_admin.language_helper_text'))
                                    ->options([
                                        'English' => 'English',
                                        'Arabic' => 'Arabic',
                                        'French' => 'French',
                                        'Spanish' => 'Spanish',
                                    ]),
                                TextInput::make('fake_students_enrolled')
                                    ->helperText(__('course_admin.fake_students_enrolled_helper_text'))
                                    ->numeric()->default(0),
                                TextInput::make('max_students')
                                    ->helperText(__('course_admin.max_students_helper_text'))
                                    ->numeric(),
                                TextInput::make('retake_course')
                                    ->helperText(__('course_admin.retake_course_helper_text'))
                                    ->numeric(),
                                CheckBox::make('finish_button')
                                    ->helperText(__('course_admin.finish_button_helper_text')),
                                Checkbox::make('featured_list')
                                    ->helperText(__('course_admin.featured_list_helper_text'))
                                    ->default(false),
                                Textarea::make('featured_review')
                                    ->helperText(__('course_admin.featured_review_helper_text'))
                                    ->rows(3)
                                    ->placeholder(__('course_admin.featured_review_placeholder')),
                                TextInput::make('external_link')->url()->helperText(__('course_admin.external_link_helper_text'))
                            ]),
                            Tab::make(__('course_admin.pricing'))->schema([
                                TextInput::make('regular_price')
                                    ->label(__('course_admin.regular_price'))
                                    ->numeric()
                                    ->default(0)
                                    ->required(),
                                TextInput::make('sale_price')
                                    ->label(__('course_admin.sale_price'))
                                    ->default(0)
                                    ->numeric(),
                                Checkbox::make('free_course')
                                    ->default(false),
                            ]),
                            Tab::make(__('course_admin.extra_information'))->schema([
                                Repeater::make('requirements')
                                    ->label(__('course_admin.requirements'))
                                    ->defaultItems(0)
                                    ->schema([
                                        TextInput::make('requirement')
                                            ->placeholder(__('course_admin.requirement_placeholder'))
                                            ->required(),
                                    ]),
                                Repeater::make('target_audience')
                                    ->label(__('course_admin.target_audience'))
                                    ->defaultItems(0)
                                    ->schema([
                                        TextInput::make('target_audience')
                                            ->placeholder(__('course_admin.target_audience_placeholder'))
                                            ->required(),
                                    ]),
                                Repeater::make('key_features')
                                    ->label(__('course_admin.key_features'))
                                    ->defaultItems(0)
                                    ->schema([
                                        TextInput::make('key_features')
                                            ->placeholder(__('course_admin.key_feature_placeholder'))
                                            ->required(),
                                    ]),
                            ]),
                            Tab::make(__('course_admin.evaluation'))->schema([
                                Radio::make('evaluation')
                                    ->options([
                                        'evaluate_via_lessons' => 'Evaluate via lessons',
                                        'evaluate_via_results_of_the_final_quiz' => 'Evaluate via results of the final quiz',
                                        'evaluate_via_passed_quizzes' => 'Evaluate via passed quizes',
                                        'evaluate_via_questions' => 'Evaluate via questions',
                                        'evaluate_via_mark' => 'Evaluate via mark',
                                    ])
                                    ->default('evaluate_via_lessons')
                                    ->helperText(__('course_admin.evaluation_helper_text')),
                                TextInput::make('pass_mark')
                                    ->numeric()
                                    ->default(80)
                                    ->required(),
                            ])
                        ]),

                ])->collapsible()->compact(),
                Hidden::make('user_id')
                    ->default(fn () => auth()->user()->id),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->words(5)
                    ->description(fn (Course $record): string => trim(substr($record->description, 0, 10)) . '...')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('user.name')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                ManageCourseAction::make()
                    ->url(fn (Course $record): string => static::getUrl('course-dashboard', ['record' => $record->id])),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),

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
            'index' => Pages\ListCourses::route('/'),
            'create' => Pages\CreateCourse::route('/create'),
            'view' => Pages\ViewCourse::route('/{record}'),
            'edit' => Pages\EditCourse::route('/edit/{record}'),
            'course-dashboard' => Pages\CourseDashboard::route('/{record}/dashboard'),
            'manage-lessons' => Pages\ManageLessons::route('/{record}/manage-lessons'),
            'student-list' => Pages\CourseStudentList::route('/{record}/student-list'),
            'settings' => Pages\CourseSettings::route('/{record}/settings'),
            'general-info' => Pages\CourseDashboard::route('/{record}/general-info'),
        ];
    }

    public static function sidebar(Course $record): FilamentPageSidebar
    {
        return FilamentPageSidebar::make()
            ->setNavigationItems([
                PageNavigationItem::make('Dashboard')
                    ->url(function () use ($record) {
                        return static::getUrl('course-dashboard', ['record' => $record->id]);
                    })->isActiveWhen(function () {
                        return request()->route()->getName() == 'filament.resources.courses.course-dashboard';
                    })->icon('heroicon-o-collection'),
                PageNavigationItem::make('Manage Lessons')
                    ->url(function () use ($record) {
                        return static::getUrl('manage-lessons', ['record' => $record->id]);
                    })->isActiveWhen(function () {
                        return request()->route()->getName() == 'filament.resources.courses.manage-lessons';
                    })->icon('heroicon-o-collection'),
                PageNavigationItem::make('Student List')
                    ->url(function () use ($record) {
                        return static::getUrl('student-list', ['record' => $record->id]);
                    })->isActiveWhen(function () {
                        return request()->route()->getName() == 'filament.resources.courses.student-list';
                    })->icon('heroicon-o-collection'),
                PageNavigationItem::make('Settings')
                    ->url(function () use ($record) {
                        return static::getUrl('settings', ['record' => $record->id]);
                    })->isActiveWhen(function () {
                        return request()->route()->getName() == 'filament.resources.courses.settings';
                    })->icon('heroicon-o-collection'),
                PageNavigationItem::make('Genral Info')
                    ->url(function () use ($record) {
                        return static::getUrl('general-info', ['record' => $record->id]);
                    })->isActiveWhen(function () {
                        return request()->route()->getName() == 'filament.resources.courses.general-info';
                    })->icon('heroicon-o-collection'),
            ]);
    }

    public static function getWidgets(): array
    {
        return [
            CourseSaleChart::class
        ];
    }
}

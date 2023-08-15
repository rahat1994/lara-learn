<?php

namespace App\Filament\Resources\CourseResource\Tables\SingleActions;

use Closure;
use Filament\Forms\ComponentContainer;
use Filament\Support\Actions\Concerns\CanCustomizeProcess;
use Filament\Tables\Actions\Concerns\InteractsWithRelationship;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Arr;

class ManageCourseAction extends Action
{
    use CanCustomizeProcess;
    use InteractsWithRelationship;

    protected ?Closure $mutateRecordDataUsing = null;

    public static function getDefaultName(): ?string
    {
        return 'Manage';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label(__('course_admin.manage'));

        $this->modalHeading(fn (): string => __('filament-support::actions/edit.single.modal.heading', ['label' => $this->getRecordTitle()]));

        $this->modalButton(__('filament-support::actions/edit.single.modal.actions.save.label'));

        $this->successNotificationTitle(__('filament-support::actions/edit.single.messages.saved'));

        $this->icon('heroicon-o-cog');
        // $this->mountUsing(function (ComponentContainer $form, Model $record): void {

        //     $data = $record->attributesToArray();

        //     if ($this->mutateRecordDataUsing) {
        //         $data = $this->evaluate($this->mutateRecordDataUsing, ['data' => $data]);
        //     }

        //     $form->fill($data);
        // });

        // $this->action(function (): void {
        //     $this->process(function (array $data, Model $record) {
        //         $relationship = $this->getRelationship();

        //         if ($relationship instanceof BelongsToMany) {
        //             $pivotColumns = $relationship->getPivotColumns();
        //             $pivotData = Arr::only($data, $pivotColumns);

        //             if (count($pivotColumns)) {
        //                 $record->{$relationship->getPivotAccessor()}->update($pivotData);
        //             }

        //             $data = Arr::except($data, $pivotColumns);
        //         }

        //         $record->update($data);
        //     });

        //     $this->success();
        // });
    }

    public function mutateRecordDataUsing(?Closure $callback): static
    {
        $this->mutateRecordDataUsing = $callback;

        return $this;
    }
}

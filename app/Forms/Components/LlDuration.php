<?php

namespace App\Forms\Components;

use Closure;
use Filament\Forms\Components\Field;
use Illuminate\Contracts\Support\Arrayable;

class LlDuration extends Field
{
    protected string $view = 'forms.components.ll-duration';

    protected array | Arrayable | Closure | null $datalistOptions = null;

    public function datalist(array | Arrayable | Closure | null $options): static
    {
        $this->datalistOptions = $options;

        return $this;
    }

    public function getDatalistOptions(): ?array
    {
        $options = $this->evaluate($this->datalistOptions);

        if ($options instanceof Arrayable) {
            $options = $options->toArray();
        }

        return $options;
    }
}

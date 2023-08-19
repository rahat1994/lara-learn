<x-filament::widget>
    <x-filament::card>
        <ul wire:sortable="updateTaskOrder">
            @foreach (['Laundry', 'Coding', 'Gym'] as $task)
            <li wire:sortable.item="{{ $task }}" wire:key="task-{{ $task }}">
                <h4 wire:sortable.handle>{{ $task }}</h4>
            </li>
            @endforeach
        </ul>

    </x-filament::card>
</x-filament::widget>

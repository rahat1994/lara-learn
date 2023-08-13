<x-dynamic-component :component="$getFieldWrapperView()" :id="$getId()" :label="$getLabel()" :label-sr-only="$isLabelHidden()" :helper-text="$getHelperText()" :hint="$getHint()" :hint-action="$getHintAction()" :hint-color="$getHintColor()" :hint-icon="$getHintIcon()" :required="$isRequired()" :state-path="$getStatePath()">

    <span x-data="{duration:$wire.entangle('{{ $getStatePath() }}').defer, options: {{json_encode($getDatalistOptions())}} ,duration_count:($wire.{{$getStatePath()}} != null) ? $wire.{{$getStatePath()}}.split(' ')[0]:0, duration_unit: ($wire.{{$getStatePath()}} != null) ? $wire.{{$getStatePath()}}.split(' ')[0]:'minutes'}">




        <input @change="duration = duration_count + ' ' + duration_unit" x-model="duration_count" class="filament-forms-input appearance-none bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" type="number" placeholder="0">
        <select @change="duration = duration_count + ' ' + duration_unit" x-model="duration_unit" class="filament-forms-input appearance-none bg-gray-200 text-gray-700 border border-red-500 rounded py-3 mb-3 leading-tight focus:outline-none focus:bg-white">

            <template x-for="option in options">
                <option x-text="option"></option>
            </template>
        </select>
    </span>
</x-dynamic-component>

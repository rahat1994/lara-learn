<x-dynamic-component :component="$getFieldWrapperView()" :id="$getId()" :label="$getLabel()" :label-sr-only="$isLabelHidden()" :helper-text="$getHelperText()" :hint="$getHint()" :hint-action="$getHintAction()" :hint-color="$getHintColor()" :hint-icon="$getHintIcon()" :required="$isRequired()" :state-path="$getStatePath()">
    <div x-data="{ state: $wire.entangle('{{ $getStatePath() }}').defer }">
        <!-- Interact with the `state` property in Alpine.js -->
    </div>

    {{-- <span>
        <input class="filament-forms-input block rounded-lg shadow-sm outline-none transition duration-75 focus:ring-1 focus:ring-inset disabled:opacity-70 border-gray-300 focus:border-primary-500 focus:ring-primary-500" type="number" name="duration" />
        <select>
            <option value="hours">Hours</option>
            <option value="days">Days</option>
            <option value="weeks">Weeks</option>
            <option value="months">Months</option>
            <option value="years">Years</option>
        </select>
    </span> --}}

    <span x-data="{duration:$wire.entangle('{{ $getStatePath() }}').defer, duration_count:($wire.{{$getStatePath()}} != null) ? $wire.{{$getStatePath()}}.split(' ')[0]:0, duration_unit: ($wire.{{$getStatePath()}} != null) ? $wire.{{$getStatePath()}}.split(' ')[0]:'minutes'}">











        <input @change="duration = duration_count + ' ' + duration_unit" x-model="duration_count" class="filament-forms-input appearance-none bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="number" placeholder="0">
        <select @change="duration = duration_count + ' ' + duration_unit" x-model="duration_unit" class="filament-forms-input appearance-none bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white">
            <option value="minutes">Minutes</option>
            <option value="hours">Hours</option>
            <option value="days">Days</option>
            <option value="weeks">Weeks</option>
            <option value="months">Months</option>
            <option value="years">Years</option>
        </select>
    </span>



</x-dynamic-component>

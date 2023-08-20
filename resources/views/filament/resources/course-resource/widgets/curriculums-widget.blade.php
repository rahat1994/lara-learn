<x-filament::widget>
    <x-filament::card>

        <div class="container mx-auto" x-data="sort()" x-init="init()">
            <ul class="p-6" x-ref="items" id="items">
                <template x-for="value in list" x-ref="list_template">
                    <li class="flex items-center border rounded shadow bg-white p-4 m-4" :data-id="value">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span class="text-sm font-bold text-gray-600" x-text="value.name">
                        </span>
                    </li>
                </template>
            </ul>

            <div class="flex justify-center">
                <button x-on:click="$wire.updateLessonOrder(list)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Update Lesson Order
                </button>
            </div>
        </div>

        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('sort', () => ({
                    list: [{
                        id: 1,
                        name: "John",
                    }, {
                        id: 2,
                        name: "rob",
                    }, {
                        id: 3,
                        name: "Rahat",
                    }],
                    init() {
                        Sortable.create(this.$refs.items, {
                            onEnd: (event) => {
                                let list = Alpine.raw(this.list);
                                let moved_step = list.splice(event.oldIndex, 1)[0]
                                list.splice(event.newIndex, 0, moved_step)

                                // HACK update prevKeys to new sort order
                                let keys = []
                                for (let step of list) {
                                    keys.push(step.id)
                                }
                                this.$refs.list_template._x_prevKeys = keys

                                // HACK to support inject elements
                                const elements = this.$refs.list_template
                                    .parentElement
                                    .querySelectorAll('li');

                                [].slice.call(elements).forEach((ele, i) => {
                                    if (ele?._x_dataStack[0]?.i != null) {
                                        ele._x_dataStack[0].i = i;
                                    }
                                });
                            },
                        });
                    },
                }))
            })
        </script>

    </x-filament::card>
</x-filament::widget>
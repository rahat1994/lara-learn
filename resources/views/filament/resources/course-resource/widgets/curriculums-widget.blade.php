<x-filament::widget>
    <x-filament::card>

        <div class="container mx-auto" x-data="sort()" x-init="init()">
            <ul class="p-6" x-ref="items" id="items">
                <template x-for="value in list" x-ref="list_template">
                    <li class="flex items-center border rounded shadow bg-white p-4 m-4" :data-id="value">
                        <span class="text-sm font-bold text-gray-600" x-text="value.title"></span>
                    </li>
                </template>
            </ul>

            <div class="flex">
                <button x-on:click="$wire.updateLessonOrder(list)" class="hover:bg-blue-700 font-bold py-2 px-4 rounded">
                    Update Lesson Order
                </button>
            </div>
        </div>

        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('sort', () => ({
                    list: [{
                        id: 1,
                        title: "Curriculum 1",
                        description: "Curriculum 1 description",
                        modules: [{
                            id: 1,
                            title: "Lesson 1",
                            type: 'lesson'
                        }, {
                            id: 2,
                            title: "Quiz 1",
                            type: 'quiz'
                        }, {
                            id: 2,
                            title: "Lesson 3",
                            type: 'lesson'
                        }]
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
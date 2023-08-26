<x-filament::widget>
    <x-filament::card>

        <div x-data="sort()" x-init="init()">
            <ul x-ref="items" id="items">
                <template x-for="value in list" x-ref="list_template">
                    <li class="px-2 py-1 flex flex-col" :data-id="value.id">
                        <div class="basis-1" x-text="value.title"></div>
                        <div class="basis-1" x-text="value.description"></div>
                        <ul class="basis-1">
                            <template x-for="module in value.modules">
                                <li x-text="module.title" :data-id="module.id"></li>
                            </template>
                        </ul>
                    </li>

                </template>
            </ul>

            <div class="flex">
                <button x-on:click="$wire.updateLessonOrder(list)">
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
                        },
                        {
                            id: 2,
                            title: "Curriculum 2",
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
                        }
                    ],
                    init() {
                        // log the list
                        console.log(this.list[0])
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
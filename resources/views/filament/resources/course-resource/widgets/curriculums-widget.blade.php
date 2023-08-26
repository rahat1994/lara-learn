<x-filament::widget>
    <x-filament::card>

        <div class="bg-gray-100" x-data="sort()" x-init="init()">
            <ul x-ref="items" id="items">
                <template x-for="value in list" x-ref="list_template">
                    <li class="px-3 py-2 mt-3 flex flex-col rounded border-2 border-inherit" :data-id="value.id">
                        <div class="text-2xl subpixel-antialiased font-bold handle cursor-move" x-text="value.title"></div>
                        <div class="text-sm  font-extralight" x-text="value.description"></div>
                        <ul class="curriculum_modules p-4" x-bind:id="`curriculum_modules_no_`+value.id">
                            <template x-for="module in value.modules">
                                <li class="p-1 bg-white rounded border-2 border-inherit font-medium" x-text="module.title" :data-id="module.id"></li>
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
                                id: 4,
                                title: "Lesson 1",
                                type: 'lesson'
                            }, {
                                id: 5,
                                title: "Quiz 1",
                                type: 'quiz'
                            }, {
                                id: 6,
                                title: "Lesson 3",
                                type: 'lesson'
                            }]
                        }
                    ],
                    init() {
                        // get all elemts by class name curriculum_modules


                        setTimeout(() => {
                            const elements = this.$refs.items.querySelectorAll('.curriculum_modules');
                            elements.forEach((ele, i) => {
                                Sortable.create(ele, {
                                    group: 'curriculum_modules',
                                    onEnd: (event) => {
                                        let list = Alpine.raw(this.list);
                                        console.log(event.oldIndex);
                                        console.log(event.newIndex);
                                        console.log(event.from.id);
                                        console.log(event.to.id);
                                        console.log(event.item.dataset.id);
                                        console.log(event);
                                    },
                                });
                            });
                        }, 500);


                        Sortable.create(this.$refs.items, {
                            handle: '.handle',
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
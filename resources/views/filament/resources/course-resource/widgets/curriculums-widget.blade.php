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
            <!-- bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded -->
            <div class="flex flex-row-reverse">
                <button x-on:click="$wire.updateLessonOrder(list)" @class([ 'filament-button filament-button-size-md inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset min-h-[2.25rem] px-4 text-sm text-white shadow focus:ring-white border-transparent bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700 filament-page-button-action'=> true,
                    'opacity-50 cursor-not-allowed'=> false,
                    ])
                    >
                    Update Lesson Order
                </button>
            </div>
        </div>

        <script>
            document.addEventListener('alpine:init', () => {


                Alpine.data('sort', () => ({
                    changesMade: false,
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

                        setTimeout(() => {
                            const elements = this.$refs.items.querySelectorAll('.curriculum_modules');
                            elements.forEach((ele, i) => {
                                Sortable.create(ele, {
                                    group: 'curriculum_modules',
                                    onEnd: (event) => {
                                        let list = Alpine.raw(this.list);

                                        let origin_module_index = Number(event.from.id.split('_')[3]) - 1;
                                        let destination_module_index = Number(event.to.id.split('_')[3]) - 1;

                                        let moved_module = list[origin_module_index].modules.splice(event.oldIndex, 1)[0]
                                        list[destination_module_index].modules.splice(event.newIndex, 0, moved_module)
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
                            },
                        });
                    },
                }))
            })
        </script>

    </x-filament::card>
</x-filament::widget>
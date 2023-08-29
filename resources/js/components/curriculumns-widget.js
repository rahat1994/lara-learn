export default function CurriculumnsWidget() {
    return {
        changesMade: false,
        list: [{
            id: 1,
            title: "Curriculum 1",
            description: "Curriculum 1 description",
            modules: [{
                id: 1,
                title: "Lesson 1",
                type: "lesson"
            }, {
                id: 2,
                title: "Quiz 1",
                type: "quiz"
            }, {
                id: 2,
                title: "Lesson 3",
                type: "lesson"
            }]
        },
        {
            id: 2,
            title: "Curriculum 2",
            description: "Curriculum 1 description",
            modules: [{
                id: 4,
                title: "Lesson 1",
                type: "lesson"
            }, {
                id: 5,
                title: "Quiz 1",
                type: "quiz"
            }, {
                id: 6,
                title: "Lesson 3",
                type: "lesson"
            }]
        }
        ],
        init: function () {
            console.log(this.$refs)
            const elements = this.$refs.items.querySelectorAll(
                '.curriculum_modules');

            elements.forEach((ele, i) => {
                console.log(ele)
                Sortable.create(ele, {
                    group: 'curriculum_modules',
                    onEnd: (event) => {
                        //let list = Alpine.raw(list);
                        console.log(list);
                        let origin_module_index = Number(event
                            .from.id.split('_')[3]) - 1;
                        let destination_module_index = Number(
                            event.to.id.split('_')[3]) - 1;

                        let moved_module = list[
                            origin_module_index].modules
                            .splice(event.oldIndex, 1)[0]
                        list[destination_module_index].modules
                            .splice(event.newIndex, 0,
                                moved_module)
                    },
                });
            });
            Sortable.create(this.$refs.items, {
                handle: '.handle',
                onEnd: (event) => {
                    let list = Alpine.raw(this.list);
                    let moved_step = list.splice(event.oldIndex, 1)[0]
                    list.splice(event.newIndex, 0, moved_step)
                },
            });
        }
    }
}

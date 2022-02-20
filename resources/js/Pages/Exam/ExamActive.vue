<template>
    <div class="flex flex-col">
        <div class="overflow-x-auto">
            <div class="py-4 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="relative w-full">
                    <Breadcrumbs />

                    <div v-for="(question,key) in Questions" >
                        <h1>{{question.value}}</h1>
                        <div v-for="answer in question.answers" class="form-control">
                            <label class="cursor-pointer label">
                                <span class="label-text w-full break-all">{{answer.value}}</span>
                                <input v-on:click="selectAnswer(question.id,answer.id)" type="radio" :name="question.id" :checked="answer.id === question.selectedAnswer" class="radio checked:bg-red-500">
                            </label>
                        </div>
                    </div>

                    <button v-on:click="endExam(this.Exam_id)" class="btn btn-wide">Zakończ egzamin</button>


                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Breadcrumbs from "@/Components/Breadcrumbs";
import {Inertia} from "@inertiajs/inertia";

export default {
    name: "Exam",
    components: {
        Breadcrumbs,
    },
    props:{
        Questions:{
            type: Array
        },
        Exam_id:{
            type: String
        }
    },
    methods:{
        endExam(examId){
            Inertia.post(route('exam.end'),{
                exam_id: examId,
            })
        },
        selectAnswer(question, answer){
            axios.post(route('exam.select_answer'),{
                exam_id: this.Exam_id,
                question_id: question,
                selected_answer_id: answer,
            });
        }
    }
}
</script>

<style scoped>

</style>

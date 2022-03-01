<template>
    <div class="flex flex-col">
        <div class="overflow-x-auto">
            <div class="py-4 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="relative w-full">
                    <Breadcrumbs :crumbs="crumbs"/>
                    <div class="flex justify-end mt-4">
                        <span class="mr-3">Pozostało: </span>
                        <vue-countdown class="flex justify-center" @end="refreshData()" :time="getExamExpireTime(Ended_at)" v-slot="{ days, hours, minutes, seconds }">
                            {{ minutes }} minut, {{ seconds }} sekund.
                        </vue-countdown>
                    </div>
                    <div v-for="(question,key) in Questions"  class="p-4">
                        <div class="flex mt-2 mb-2 items-baseline">
                            <span class="mr-4 text-2xl font-extralight">{{key + 1 }}.</span>
                            <span class="text-xl font-extralight">{{question.value}}</span>
                        </div>

                        <div v-for="(answer,k) in question.answers" class="form-control answers">
                            <label class="cursor-pointer label hover:bg-base-200">
                                <span class="mr-3 bg-gray-100 p-3 rounded-full"> {{ String.fromCharCode(65 + k) }}</span>
                                <span class="label-text w-full  ">{{answer.value}}</span>
                                <input v-on:click="selectAnswer(question.id,answer.id)" type="radio" :name="question.id" :checked="answer.id === question.selectedAnswer" class="radio checked:bg-red-500">
                            </label>
                        </div>
                    </div>
                    <div class="w-full flex justify-center">
                        <button v-on:click="endExam(this.Exam_id)" class="btn btn-wide w-5/6 flex">Zakończ egzamin</button>
                    </div>


                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Breadcrumbs from "@/Components/Breadcrumbs";
import {Inertia} from "@inertiajs/inertia";
import VueCountdown from '@chenfengyuan/vue-countdown';

export default {
    name: "Exam",
    components: {
        Breadcrumbs,
        VueCountdown
    },
    props:{
        Questions:{
            type: Array
        },
        Exam_id:{
            type: String
        },
        Ended_at: {
            type: Date,
        }
    },
    data(){
      return{
          crumbs: [
              {
                  name: 'Egzaminy',
                  route: 'exam.index'
              },
              {
                  name: window.location.pathname.split('/')[2],
                  route: ''
              }
          ],
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
        },
        getExamExpireTime(time)
        {
            const now = new Date();
            const expireExam = new Date(time);
            return expireExam - now;
        },
        refreshData()
        {
            Inertia.reload({ only: ['exams'] });
        }
    }
}
</script>

<style scoped lang="scss">
    .answers{
        label{
            border-top: 1px solid #1a202c;
            border-left: 1px solid #1a202c;
            border-right: 1px solid #1a202c;

        }
        &:last-child{
            label {
                border-bottom: 1px solid #1a202c;
            }
            margin-bottom: 10px;
        }
    }

</style>

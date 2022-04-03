<template>
    <Breadcrumbs :crumbs="crumbs"/>
    <div class="flex justify-center items-center mt-4 mb-4 text-3xl " :class="is_passed ? 'text-green-400' : 'text-red-600'">
        {{is_passed ? "Egzamin zdany" : "Egzamin niezdany"}}
    </div>
    <div v-for="(question,key) in Questions"  class="p-4">
        <div class="flex mt-2 mb-2 items-baseline">
            <span class="mr-4 text-2xl font-extralight">{{key + 1 }}.</span>
            <span class="text-xl font-extralight flex items-center">{{question.value}}</span>
        </div>
        <div class="flex items-center" v-if="!checkCorrectAnswer(question.selectedAnswer,question.correctAnswer[0].id)">
            Odpowiedź nieprawidłowa
            <svg  xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="red" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </div>
        <div class="flex items-center" v-if="checkCorrectAnswer(question.selectedAnswer,question.correctAnswer[0].id)">
            Odpowiedź prawidłowa
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="green" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
            </svg>
        </div>
        <div v-for="(answer,k) in question.answers" class="form-control answers">
            <label class="label">
                <span class="mr-3 bg-gray-100 p-3 rounded-full"> {{ String.fromCharCode(65 + k) }}</span>
                <span class="label-text w-full  ">{{answer.value}}</span>
                <span v-if="answer.id === question.selectedAnswer" class="badge badge-sm badge-ghost w-20 h-12">Wybrana odpowiedź</span>
                <span v-if="question.correctAnswer[0].id != question.selectedAnswer && answer.id === question.correctAnswer[0].id" class="badge badge-sm badge-ghost w-20 h-12 bg-green-600">Prawidłowa odpowiedź</span>
            </label>
        </div>

    </div>
</template>

<script>
import Breadcrumbs from "@/Components/Breadcrumbs";

export default {
    name: "ExamEnded",
    components: {
        Breadcrumbs,
    },
    props:{
        Questions:{
            type: Array
        },
        Exam_id:{
            type: String
        },
        is_passed:{
            type: Boolean
        }
    },
    data(){
      return {
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
        checkCorrectAnswer(correctAnswerId, selectedAnswerId)
        {
            return correctAnswerId === selectedAnswerId;
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

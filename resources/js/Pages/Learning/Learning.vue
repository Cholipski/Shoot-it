<template>
<!--    <div class="flex items-center gap-3" v-if="answerSelected">-->
<!--        <span> Nastepne pytanie wyświetli się za </span>-->
<!--        <vue-countdown v-if="answerSelected" class="flex justify-center" @end="nextQuestion()" :time="10000" v-slot="{ days, hours, minutes, seconds }">-->
<!--            {{ minutes }} minut, {{ seconds }} sekund.-->
<!--        </vue-countdown>-->
<!--    </div>-->


    <div class="flex h-24 mb-2 justify-center md:justify-start">
        <div class="w-full text-xl p-6 h-full flex items-center">
            {{question.value}}
        </div>
    </div>
    <div v-for="(answer, index) in this.answers" :key="index + random"
         v-on:click="checkAnswer(answer)"
         class="border-gray-500 border-2 mt-2 p-4 rounded flex"
         :class="[!answerSelected ? 'hover:bg-gray-100 cursor-pointer': '']">
        <span
            class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 rounded-full border h-12">
            {{ String.fromCharCode(65 + index) }}
        </span>
        <span class="pl-4 flex justify-between w-full items-center">
            {{answer.value}}
            <svg v-if="answer.id === correctAnswer[0].id && answerSelected" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="Green">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>

            <svg v-if="selectedAnswer && answer.id === selectedAnswer.id && answerSelected && wrongAnswer" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="Red" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </span>
    </div>

    <div v-if="answerSelected && wrongAnswer" class="flex justify-center items-center flex-col">
        <span class="text-red-600 text-xl mt-8">
            Odpowiedź niepoprawna
        </span>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-48 w-48" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
    </div>

    <div v-if="answerSelected && selectedAnswer.id === correctAnswer[0].id" class="flex justify-center items-center flex-col">
        <span class="text-green-400 text-xl mt-8">
            Odpowiedź poprawna
        </span>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-48 w-48" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
    </div>

    <div v-if="answerSelected" class="flex justify-center">
        <button v-on:click="nextQuestion" class="btn w-4/6 mt-6 btn-outline">Następne pytanie</button>
    </div>
</template>

<script>
import {random} from "lodash";
import VueCountdown from '@chenfengyuan/vue-countdown';
import {Inertia} from "@inertiajs/inertia";

export default {
    name: "Learning",
    components:{
      VueCountdown
    },
    props: {
        question: {
            type: Object
        },
        correctAnswer: {
            type: Array
        },
        answers: {
            type: Array
        }
    },
    data() {
      return {
          answerSelected: false,
          progressTimer: 0,
          wrongAnswer: false,
          selectedAnswer: null
      }
    },
    methods: {
        random() {
            return random(1000);
        },
        checkAnswer(answer)
        {
            if(!this.answerSelected)
            {
                this.answerSelected = true;
                this.wrongAnswer = this.correctAnswer[0].id !== answer.id;
                this.selectedAnswer = answer;
            }
        },
        nextQuestion()
        {
            this.answerSelected = false;
            Inertia.visit(route('learning.update',this.question.category_id), { method: 'put' })
        }

    },
}
</script>

<style scoped>

</style>

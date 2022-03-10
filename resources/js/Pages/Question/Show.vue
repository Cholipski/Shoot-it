<template>
    <breadcrumbs :crumbs="crumbs" />
    <span class="text-2xl md:text-3xl items-center justify-center text-gray-400 font-bold flex mt-7 mb-2">
        Pytanie z kategorii: UOBiA
        <modal-default>
            <template v-slot:ButtonOpen>
                <sup>
                    <i class="fas fa-info-circle text-black"></i>
                </sup>
            </template>
            <template v-slot:main>
                <span>
                    Ustawa z dnia 21 maja 1999 r. o broni i amunicji – polska ustawa regulująca zasady wydawania i cofania pozwoleń na broń, procedur obrotu bronią i amunicją, zasady jej posiadania przez cudzoziemców oraz zasady działania strzelnic.
                </span>
            </template>
            <template v-slot:header>
                Ustawa o broni i amunicji
            </template>
        </modal-default>

    </span>
    <div class="mt-8">
        <div class="flex h-36 mb-6 justify-center md:justify-start">
            <div class="w-full p-6 h-full flex items-center">
                {{this.data.question}}
            </div>
        </div>

        <div class="flex flex-col">
            <div class="flex justify-center md:justify-end mt-2">
                <button type="button" v-on:click="this.showCorrectAnswer = !this.showCorrectAnswer" class="text-gray-900 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-gray-600 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-800">
                    {{this.showCorrectAnswer ? 'Ukryj prawidłową odpowiedź' : 'Pokaż prawidłową odpowiedź'}}</button>

            </div>
            <div v-for="(answer, index) in this.data.answers" :key="index + random"
                 class="border-gray-300 border-2 mt-2 p-4 rounded cursor-pointer flex bg-gray-100 hover:bg-gray-200"
                 :class="[answer.is_correct && showCorrectAnswer ? 'border-green-700' : 'border-gray-300']">
                <span
                    class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 rounded-full border border-r-0 border-gray-300">
                    {{ String.fromCharCode(65 + index) }}
                </span>
                <span class="pl-4 flex justify-between w-full">
                    {{answer.value}}
                    <svg v-if="answer.is_correct && showCorrectAnswer" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="Green">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </span>

            </div>
        </div>
    </div>
</template>

<script>
import ModalDefault from "@/Components/ModalDefault";
import {random} from "lodash";
import Breadcrumbs from "@/Components/Breadcrumbs";

export default {
    name: "Show",
    components: {
        ModalDefault,
        Breadcrumbs
    },
    props: ['data'],
    methods: {
        random() {
            return random(1000);
        }
    },
    data(){
        return{
            crumbs: [
                {
                    name: 'Pytania egzaminacyjne',
                    route: 'question.index'
                },
                {
                    name: window.location.pathname.split('/')[2],
                    route: ''
                }
            ],
            showCorrectAnswer: false,
        }
    }
}
</script>

<style scoped>

</style>

<template>
    <div class="flex flex-col">
        <div class="overflow-x-auto">
            <div class="py-4 inline-block min-w-full sm:px-6 lg:px-8">
                <span class="text-3xl items-center justify-center text-gray-400 font-bold flex mt-7 mb-2">
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
                    <div class="flex h-48 mb-6">
                        <div class="w-3/4 p-6 h-full">
                            {{this.data.question}}
                        </div>
                        <div class="w-1/4 h-full bg-gray-50 border-gray-100 border-2">
                        </div>
                    </div>

                    <div class="flex flex-col">
                        <div class="flex justify-end mt-2">
                            <button type="button" v-on:click="this.showCorrectAnswer = !this.showCorrectAnswer" class="text-gray-900 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-gray-600 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-800">
                                {{this.showCorrectAnswer ? 'Ukryj prawidłową odpowiedź' : 'Pokaż prawidłową odpowiedź'}}</button>

                        </div>
                        <div v-for="(answer, index) in this.data.answers" :key="index + random"
                             class="border-gray-300 border-2 mt-2 p-4 rounded cursor-pointer"
                            :class="[answer.is_correct && showCorrectAnswer ? 'border-green-700 bg-green-600 text-white hover:bg-green-800' : 'border-gray-300 bg-gray-100 hover:bg-gray-200']">
                            <span
                                class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 rounded-full border border-r-0 border-gray-300 dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                {{ String.fromCharCode(65 + index) }}
                            </span>
                            <span class="pl-4 w-1/2">
                                {{answer.value}}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Tooltip from "@/Components/Tooltip";
import ModalDefault from "@/Components/ModalDefault";
import {random} from "lodash";

export default {
    name: "Show",
    components: {
        Tooltip,
        ModalDefault
    },
    props: ['data'],
    methods: {
        random() {
            return random(1000);
        }
    },
    data(){
        return{
            showCorrectAnswer: false,
        }
    }
}
</script>

<style scoped>

</style>

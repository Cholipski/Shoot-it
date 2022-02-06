<template>
    <div class="flex flex-col">
        <div class="overflow-x-auto">
            <div class="py-4 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="relative w-full">
                    <Breadcrumbs/>

                    <div class="flex items-center justify-center mt-16">
                        <Link :href="route('exam.create')" class="text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-md px-5 py-1.5 text-center mr-2 mb-2 dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800">Rozpocznij nowy egzamin</Link>
                    </div>
                    <div class="mt-7 mb-3">
                        <span class="text-2xl text-gray-400">Historia egzaminów</span>
                    </div>
                    <div class="flex justify-end">
                        <a href="#" class="inline-flex items-center py-2 px-4 mr-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                            <svg class="mr-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd"></path></svg>
                            Następne
                        </a>
                        <a href="#" class="inline-flex items-center py-2 px-4 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                            Poprzednie
                            <svg class="ml-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </a>
                    </div>
                    <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 p-4">
                        <div v-for="exam in exams.data" class="p-6 mt-4 mr-4 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                            <h4 class="mb-2 text-lg font-bold tracking-tight text-gray-900 dark:text-white flex justify-center items-center">Egzamin # {{exam.exam_number}}</h4>
                            <a href="#" class="flex justify-center items-center">
                                <h4 class="mb-2 text-lg font-bold tracking-tight text-gray-900 dark:text-white">
                                    {{ formatDate(exam.created_at) }}</h4>
                            </a>
                            <span class="mb-2 font-bold tracking-tight flex justify-center items-center" :class="[classExamStatus(exam)]">
                                {{ examStatus(exam) }}
                            </span>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400 h-8">
                                <span v-if="!exam.is_active">Poprawne odpwiedzi: 9/10</span>
                                <vue-countdown v-else :time="20 * 60 * 1000" v-slot="{ days, hours, minutes, seconds }">
                                    Pozostały czas: {{ minutes }} minut, {{ seconds }} sekund.
                                </vue-countdown>
                            </p>
                            <a v-if="!exam.is_active" href="#" class="w-full flex sm:w-auto flex bg-gray-800 hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 text-white rounded-lg items-center justify-center px-4 py-2.5 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                <div class="-mt-1 font-sans text-sm font-semibold">Szczegóły</div>
                            </a>
                            <a v-else href="#" class="w-full flex sm:w-auto flex bg-gray-800 hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 text-white rounded-lg items-center justify-center px-4 py-2.5 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                <div class="-mt-1 font-sans text-sm font-semibold">Kontynuuj</div>
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Breadcrumbs from "@/Components/Breadcrumbs";
import {Link} from "@inertiajs/inertia-vue3";
import moment from "moment";
import VueCountdown from '@chenfengyuan/vue-countdown';
import {Inertia} from "@inertiajs/inertia";

export default {
    name: "Index",
    props:{
      exams:{
          type: Object
      }
    },
    data(){
        return{
           examInProgress: this.$attrs.flash.message ?  this.$attrs.flash.message.examInProgress : 0,
        }
    },
    components:{
        Breadcrumbs,
        Link,
        VueCountdown
    },
    methods:{
        formatDate(date) {
                return moment(date).format('Y-MM-DD HH:mm');
        },

        examStatus(exam){
            if(exam.is_active){
                return "Egzamin w trakcie";
            }
            else{
                if(exam.is_passed){
                    return "Zdany";
                }
                else{
                    return "Niezdany";
                }
            }
        },
        classExamStatus(exam){
            if(exam.is_active){
                return "text-gray-700";
            }
            else{
                if(exam.is_passed){
                    return "text-green-400";
                }
                else{
                    return "text-red-700";
                }
            }
        }
    }
}
</script>

<style scoped lang="scss">

</style>

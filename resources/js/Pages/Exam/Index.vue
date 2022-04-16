<template>
    <Breadcrumbs :crumbs="crumbs"/>

    <div class="flex items-center justify-center mt-16" v-if="exams.data.length !== 0">
        <Link :href="route('exam.create')" class="text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-md px-5 py-1.5 text-center mr-2 mb-2 dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800">Rozpocznij nowy egzamin</Link>
    </div>
    <div class="flex items-center justify-center mt-16" v-if="exams.data.length === 0">
        <Link :href="route('exam.create')" class="text-gray-900 text-3xl hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-md px-5 py-1.5 text-center mr-2 mb-2 dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800">Rozpocznij nowy egzamin</Link>
    </div>
    <div v-if="exams.data.length === 0" class="flex justify-center w-full mt-8">
        <svg version="1.1" class="w-1/6" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 508 508" style="enable-background:new 0 0 508 508;" xml:space="preserve">
<circle style="fill:#FD8469;" cx="254" cy="254" r="254"/>
            <path style="fill:#FFFFFF;" d="M122.8,102.4v302.8c0,8.8,7.2,16.4,16.4,16.4H316v-52.4c0-9.2,7.2-16.4,16.4-16.4h52.4V102.4  c0-8.8-7.2-16.4-16.4-16.4H139.2C130,86.4,122.8,93.6,122.8,102.4z"/>
            <path style="fill:#E6E9EE;" d="M316,421.6l68.8-68.8h-52c-9.2,0-16.4,7.2-16.4,16.4v52.4H316z"/>
            <g>
	<path style="fill:#84DBFF;" d="M259.6,297.2l-10.8-25.6h-49.6l-10.8,25.6h-28l50.8-118h25.6l50.8,118H259.6z M224,214.4l-14.8,34.4   h29.6L224,214.4z"/>
                <path style="fill:#84DBFF;" d="M309.2,239.2v-22.4h-21.6v-15.2h21.6v-22.4H326v22.4h21.6v15.2H326v22.4H309.2z"/>
</g>
            <g>
</g>
            <g>
</g>
            <g>
</g>
            <g>
</g>
            <g>
</g>
            <g>
</g>
            <g>
</g>
            <g>
</g>
            <g>
</g>
            <g>
</g>
            <g>
</g>
            <g>
</g>
            <g>
</g>
            <g>
</g>
            <g>
</g>
</svg>
    </div>
    <div class="mt-7 mb-3" v-if="exams.data.length !== 0">
        <span class="text-2xl text-gray-400">Historia egzaminów</span>
    </div>

    <div class="flex justify-center md:justify-end" v-if="exams.data.length !== 0">
        <Link :href="previous().url" class="inline-flex items-center py-2 px-4 mr-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700">
            <svg class="mr-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd"></path></svg>
            Następne
        </Link>
        <Link :href="next().url" class="inline-flex items-center py-2 px-4 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700">
            Poprzednie
            <svg class="ml-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        </Link>
    </div>
    <div class="w-full grid-cols-4 shadow stats mt-4 hidden md:flex" v-for="exam in exams.data">
        <div class="stat place-items-center place-content-center">
            <div class="stat-value text-xl font-normal  ">Egzamin # {{exam.exam_number}}</div>
            <div class="stat-desc">{{ formatDate(exam.created_at) }}</div>
        </div>

        <div class="stat place-items-center place-content-center">
            <div v-if="exam.is_active">
                <div class="stat-value flex justify-center text-sm lg:text-xl font-normal">
                    Pozostały czas:
                </div>
                <div class="stat-desc">
                    <vue-countdown class="flex justify-center" @end="refreshData()" :time="getExamExpireTime(exam.ended_at)" v-slot="{ days, hours, minutes, seconds }">
                        {{ minutes }} minut, {{ seconds }} sekund.
                    </vue-countdown>
                </div>
            </div>
            <div v-else>
                <div class="stat-value text-sm flex justify-center text-md font-normal">
                    Poprawne odpwiedzi:
                </div>
                <div class="stat-desc flex justify-center">
                    {{getScore(exam.score)}}
                </div>
            </div>

        </div>
        <div class="stat place-items-center place-content-center">
            <div class="stat-value text-info text-sm lg:text-xl font-normal" v-if="exam.is_active">w trakcie</div>
            <div class="stat-value text-sm lg:text-xl font-normal" :class="exam.is_passed ? 'text-success' : 'text-error'" v-else> {{ examStatus(exam) }}</div>
        </div>

        <div class="stat place-items-center place-content-center">
            <div class="tooltip tooltip-left z-50" data-tip="Wyświetl">
                <Link :href="route('exam.show',exam.id)">
                    <svg class="w-7 h-7 view-exam-icon" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                </Link>
            </div>
        </div>
    </div>
    <div class="w-full shadow mt-4 block md:hidden" v-for="exam in exams.data">
        <div tabindex="0" class="collapse border border-base-300 bg-base-100 rounded-box collapse-arrow">
            <div class="collapse-title text-xl font-medium flex justify-center items-center">
                <div class="stat-value text-xl font-normal mr-5 ">Egzamin # {{exam.exam_number}}</div>
                <div class="stat-desc">{{ formatDate(exam.created_at) }}</div>
            </div>
            <div class="collapse-content">
                <div>
                    <div v-if="exam.is_active">
                        <div class="stat-value flex justify-center text-sm lg:text-xl font-normal">
                            Pozostały czas:
                        </div>
                        <div class="stat-desc">
                            <vue-countdown class="flex justify-center" @end="refreshData()" :time="getExamExpireTime(exam.ended_at)" v-slot="{ days, hours, minutes, seconds }">
                                {{ minutes }} minut, {{ seconds }} sekund.
                            </vue-countdown>
                        </div>
                    </div>
                    <div v-else class="flex items-center justify-center">
                        <div class="stat-value text-sm lg:text-xl font-normal">
                            Poprawne odpwiedzi:
                        </div>
                        <div class="stat-desc flex justify-center ml-5">
                            {{getScore(exam.score)}}
                        </div>
                    </div>
                </div>
                <div class="flex justify-center mt-3 mb-4">
                    <div class="stat-value text-info text-xl font-normal" v-if="exam.is_active">w trakcie</div>
                    <div class="stat-value text-xl font-normal" :class="exam.is_passed ? 'text-success' : 'text-error'" v-else> {{ examStatus(exam) }}</div>
                </div>
                <div class="flex justify-center">
                    <Link :href="route('exam.show',exam.id)" class="flex items-center border-2 border-gray-500 rounded-lg p-2">
                        <svg class="w-7 h-7 view-exam-icon" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        <span>Wyświetl szczegóły</span>
                    </Link>
                </div>
            </div>
        </div>
    </div>

    <ModalActiveExam />
</template>

<script>
import Breadcrumbs from "@/Components/Breadcrumbs";
import {Link} from "@inertiajs/inertia-vue3";
import moment from "moment";
import VueCountdown from '@chenfengyuan/vue-countdown';
import ModalActiveExam from "@/Components/ModalActiveExam";
import {Inertia} from "@inertiajs/inertia";
import PaginationBar from "@/Components/PaginationBar";

export default {
    name: "Index",
    props:{
      exams:{
          type: Object
      }
    },
    components:{
        Breadcrumbs,
        Link,
        VueCountdown,
        ModalActiveExam,
        PaginationBar
    },
    data(){
        return{
            crumbs: [
                {
                    name: 'Egzaminy',
                    route: 'exam.index'
                },
            ],
           examInProgress: this.$attrs.flash.exam_in_progress ?  this.$attrs.flash.exam_in_progress : 0,
        }
    },
    mounted() {
        if(this.examInProgress === 1){
            document.getElementById('active-exam-button').click();
           this.examInProgress = 0;
        }
    },
    methods:{
        formatDate(date) {
            return moment(date).format('Y-MM-DD HH:mm');
        },

        examStatus(exam){

            if(exam.is_passed){
                return "Zdany";
            }
            else{
                return "Niezdany";
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
        },
        getScore(scoresJson){
            let scores = JSON.parse(scoresJson);
            return scores.score+'/'+scores.maxScore;
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
        },
        previous: function () {
            return this.exams.links[0];
        },
        next: function () {
            return this.exams.links[this.exams.links.length - 1];
        }
    }
}
</script>

<style scoped lang="scss">
    .view-exam-icon{
        stroke:black;
        &:hover{
            stroke: #718096;
        }
    }
</style>

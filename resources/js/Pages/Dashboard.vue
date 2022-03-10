<template>
    <Head title="Dashboard"/>

    <Breadcrumbs :crumbs="crumbs"/>

    <div class="flex text-3xl justify-center justify-items-center pb-5 mb-10 mt-6">
        <h1>Witaj {{ this.$page.props.auth.user.first_name }}</h1>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 grid-rows-1 gap-4">
        <div>
            <h1 class="flex justify-center text-xl pb-5">Liczba egzaminów w tygodniu</h1>
            <VueApexCharts :options="chartOptions" :series="series" height="350"
                           type="bar"></VueApexCharts>
        </div>
        <div>
            <h1 class="flex justify-center text-xl pb-5">Egzaminy zaliczone</h1>
            <VueApexCharts :options="options2" :series="series2" class="flex justify-center justify-items-center"
                           type="donut" width="380"></VueApexCharts>
        </div>
    </div>
    <div class="grid grid-cols-1 grid-rows-1" v-if="lastExams">
        <span class="text-xl mb-2 mt-10 text-neutral">Ostatnie egzaminy</span>
        <div class="w-full grid-cols-3 md:grid-cols-4 shadow stats mt-4" v-for="exam in this.lastExams">
            <div class="stat place-items-center place-content-center">
                <div class="stat-value text-sm  md:text-xl font-normal  ">Egzamin # {{exam.exam_number}}</div>
                <div class="stat-desc">{{ formatDate(exam.created_at) }}</div>
            </div>

            <div class="stat place-items-center place-content-center hidden md:block">
                <div class="stat-value text-sm lg:text-md flex justify-center font-normal">
                    <span class="hidden lg:block">
                        Poprawne odpwiedzi:
                    </span>
                    <span class="block lg:hidden">
                        Poprawne odp.
                    </span>
                </div>
                <div class="stat-desc flex justify-center">
                    {{getScore(exam.score)}}
                </div>
            </div>
            <div class="stat place-items-center place-content-center">
                <div class="stat-value text-info text-sm lg:text-xl font-normal" v-if="exam.is_active">w trakcie</div>
                <div class="stat-value text-sm lg:text-xl font-normal" :class="exam.is_passed ? 'text-success' : 'text-error'" v-else> {{ examStatus(exam) }}</div>
            </div>

            <div class="stat place-items-center place-content-center">
                <div class="tooltip tooltip-left z-50" data-tip="Wyświetl">
                    <Link :href="route('exam.show',exam.id)">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>                                    </Link>
                </div>
            </div>
        </div>

    </div>
</template>
<script>
import VueApexCharts from 'vue3-apexcharts'
import moment from "moment";
import VueCountdown from '@chenfengyuan/vue-countdown';
import Breadcrumbs from "@/Components/Breadcrumbs";
import {Link} from "@inertiajs/inertia-vue3";

export default {
    components: {
        VueApexCharts,
        VueCountdown,
        Breadcrumbs,
        Link
    },
    props: {
        examPassed: {
            type: Number,
            required: true,
        },
        examFailed: {
            type: Number,
            required: true,
        },
        lastExams: {
            type: Object,
            required: false,
        },
        weekExams :{
            type: Object,
            required: false,
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

        getDataForWeeklyChart(){
            if(this.weekExams.length === 0){
                return [0];
            }
            else{
                let data = [];
                for(let i = 1; i <= 7; i++){
                    if(this.weekExams[i.toString()] !== undefined){
                        data.push(this.weekExams[i.toString()].length)
                    }
                    else{
                        data.push(0);
                    }
                }
                console.log(data);
                return data;
            }
        },
        getScore(scoresJson){
            let scores = JSON.parse(scoresJson);
            return scores.score+'/'+scores.maxScore;
        },

    },
    data: function () {
        return {
            options2: {
                colors: ['#003f5c','#ffa600'],
                labels: ['Niezaliczone', 'Zaliczone'],
            },
            series2: [this.examFailed, this.examPassed],
            series: [{
                name: 'Egzaminy',
                data: this.getDataForWeeklyChart()
            }],
            chartOptions: {
                chart: {
                    type: 'bar',
                    height: 350
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '55%',
                        endingShape: 'rounded'
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                xaxis: {
                    categories: [ 'Poniedziałek', 'Wtorek', 'Środa', 'Czwartek', 'Piątek', 'Sobota','Niedziela'],
                },
                yaxis: {
                    title: {
                        text: 'Egzaminów'
                    }
                },
                fill: {
                    opacity: 1,
                    colors: ['#ffa600   ']
                },
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return val;
                        }
                    }
                }
            },


        }

    }
}
</script>

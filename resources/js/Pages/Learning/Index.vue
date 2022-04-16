<template>
    <Breadcrumbs :crumbs="crumbs"/>

    <div class="flex justify-between mt-5 flex-col md:flex-row">
        <span class="text-5xl text-gray-400 font-extralight md:ml-10 flex justify-center md:justify-start">Nauka</span>
        <ProgressResetButton v-if="this.categories.length !== 0" :route="route('learning.destroy', {id: this.$page.props.auth.user.id})">Resetuj postępy</ProgressResetButton>
    </div>
    <div class="flex flex-col lg:flex-row justify-between items-center md:mb-24" v-if="this.categories.length !== 0">
        <div class="text-2xl font-extralight mt-3">
            <span class="mr-5">Twój postęp w nauce </span>
            <div class="radial-progress" :style="totalProgressBar()">{{totalProgress(this.NumberAnsweredQuestion, this.NumberQuestions)}}%</div>
        </div>
    </div>
    <div v-if="this.categories.length === 0" class="flex justify-center items-center text-3xl mt-8 text-gray-400 font-bold">
        Brak pytań w bazie danych
    </div>

    <div class="mt-12">

        <div v-if="this.categories.length !== 0" v-for="category in this.categories" class="mt-3 mb-4 block flex flex-col gap-2 md:flex-row md:justify-center items-center">
            <Link :href="route('learning.show',category.id)" class="btn btn-wide">{{ category.name }}</Link>
            <progress class="progress w-56 md:ml-5" :value="this.progress ? this.progress[category.id] : 0" :max="this.questionCount ? this.questionCount[category.id] : 0"></progress>
            <span class="text-lg ml-4"> {{ isNaN(this.totalProgress()) ? 0 : this.totalProgress() }}%</span>
        </div>

    </div>
</template>

<script>
import Breadcrumbs from "@/Components/Breadcrumbs";
import {Link} from "@inertiajs/inertia-vue3";
import ProgressResetButton from "@/Components/ProgressResetButton";

export default {
    name: "Index",
    components: {
        Breadcrumbs,
        Link,
        ProgressResetButton
    },
    props: {
        categories:{
            type: Object,
            required: true
        },
        NumberQuestions: {
            type: Number,
        },
        NumberAnsweredQuestion: {
            type: Number,
        },
        questionCount: {
            type: Array,
        },
        progress: {
            type: Array
        }
    },
    data(){
        return {
            crumbs: [
                {
                    name: 'Nauka',
                    route: 'learning.index'
                }
            ]
        }
    },
    methods:{
        totalProgress(answered, numberQuestions){
            return Math.round(answered / numberQuestions * 100);
        },
        totalProgressBar(){
            return "--value:" + this.totalProgress(this.NumberAnsweredQuestion, this.NumberQuestions);
        }
    }
}
</script>

<style scoped lang="scss">

</style>

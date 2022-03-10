<template>
    <Breadcrumbs :crumbs="crumbs"/>

    <div class="flex justify-between mt-5 flex-col md:flex-row">
        <span class="text-5xl text-gray-400 font-extralight md:ml-10 flex justify-center md:justify-start">Nauka</span>
        <button class="btn btn-xs md:mr-10 mt-5 md:mt-0 w-1/2 md:w-2/6 mx-auto">Resetuj postępy</button>
    </div>
    <div class="flex flex-col lg:flex-row justify-between items-center md:mb-24">
        <div class="text-2xl font-extralight mt-3">
            <span class="mr-5">Twój postęp w nauce </span>
            <div class="radial-progress" style="--value:7;">7%</div>
        </div>
    </div>

    <div class="mt-12">

        <div class="mt-3 mb-4 block flex flex-col gap-2 md:flex-row md:justify-center items-center">
            <button class="btn btn-wide">Ustawa o bronii i amunicji</button>
            <progress class="progress w-56 md:ml-5" value="10" max="100"></progress>
            <span class="text-lg ml-4"> 10%</span>
        </div>

        <div class="mt-3 mb-4 flex flex-col gap-2 md:flex-row justify-center items-center">
            <button class="btn btn-wide">Obrona konieczna</button>
            <progress class="progress w-56 ml-5" value="0" max="100"></progress>
            <span class="text-lg ml-4"> 0%</span>
        </div>

        <div class="mt-3 mb-4 flex flex-col gap-2 md:flex-row justify-center items-center">
            <button class="btn btn-wide">Bezpieczeństwo w strzelectwie</button>
            <progress class="progress w-56 md:ml-5" value="0" max="100"></progress>
            <span class="text-lg ml-4"> 0%</span>
        </div>

        <div class="mt-3 mb-4 flex flex-col gap-2 md:flex-row justify-center items-center">
            <button class="btn btn-wide">Zachowanie na strzelnicy</button>
            <progress class="progress w-56 md:ml-5" value="0" max="100"></progress>
            <span class="text-lg ml-4"> 0%</span>
        </div>

        <div class="mt-3 mb-4 flex flex-col gap-2 md:flex-row justify-center items-center">
            <button class="btn btn-wide">Budowa broni i amunicji</button>
            <progress class="progress w-56 md:ml-5" value="0" max="100"></progress>
            <span class="text-lg ml-4"> 0%</span>
        </div>

        <div class="mt-3 mb-4 flex flex-col gap-2 md:flex-row justify-center items-center">
            <button class="btn btn-wide">Przepisy sportowe ISSF</button>
            <progress class="progress w-56 md:ml-5" value="0" max="100"></progress>
            <span class="text-lg ml-4"> 0%</span>
        </div>

    </div>
</template>

<script>
import Breadcrumbs from "@/Components/Breadcrumbs";

export default {
    name: "Index",
    components: {
        Breadcrumbs,
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
}
</script>

<style scoped lang="scss">

</style>

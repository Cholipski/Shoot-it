<template>
    <Breadcrumbs :crumbs="crumbs"/>

    <div class="flex justify-end mt-6">
        <delete-confirmation :route="route('categories.questions.destroy', {id: selected_category.id})">
            <button class="btn btn-outline btn-error">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
                <span class="ml-2">Usuń</span>
            </button>
        </delete-confirmation>

    </div>
    <form @submit.prevent="submit">
        <div class="block md:flex">
            <div class="form-control w-full md:pr-5">
                <label class="label">
                    <span class="label-text font-extralight text-gray-700">Nazwa</span>
                </label>
                <input v-model="form.name" type="text" class="input input-bordered w-full focus:ring-indigo-200 focus:border-gray-300">
                <span v-if="errors.name" class="text-red-600 text-sm mt-1 mb-1 ml-3">
                Pole jest wymagane
                </span>

            </div>
            <div class="form-control w-full md:pl-6">
                <label class="label">
                    <span class="label-text font-extralight text-gray-700">Skrócona nazwa</span>
                </label>
                <input v-model="form.short_name" type="text" class="input input-bordered w-full focus:ring-indigo-200 focus:border-gray-300">
                <span v-if="errors.short_name" class="text-red-600 text-sm mt-1 mb-1 ml-3">
                Pole jest wymagane
                </span>
            </div>
        </div>
        <div class="form-control">
            <label class="label">
                <span class="label-text font-extralight text-gray-700">Opis</span>
            </label>
            <textarea v-model="form.description" class="textarea h-24 textarea-bordered focus:ring-indigo-200 focus:border-gray-300"></textarea>
            <span v-if="errors.description" class="text-red-600 text-sm mt-1 mb-1 ml-3">
                Pole jest wymagane
                </span>
        </div>
        <div class="flex justify-center">
            <button class="btn gap-2 btn-md mt-3 " type="submit">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Zapisz zmiany
            </button>
        </div>
    </form>
    <div class="stat md:hidden mt-12 bg-gray-100 rounded-lg">
        <div class="stat-figure text-secondary">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="black" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" />
            </svg>            </div>
        <div class="stat-title">Ilość pytań w bazie</div>
        <div class="stat-value">31K</div>
    </div>
    <div class="stat md:hidden mt-6 bg-gray-100 rounded-lg">
        <div class="stat-figure text-secondary">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="black" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>            </div>
        <div class="stat-title">Ilość pytań w danej kategorii</div>
        <div class="stat-value">4,200</div>
    </div>

<!--    <div class="stats shadow hidden md:flex right-5">-->
<!--        <div class="stat">-->
<!--            <div class="stat-figure text-secondary">-->
<!--                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="black" stroke-width="2">-->
<!--                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" />-->
<!--                </svg>            </div>-->
<!--            <div class="stat-title">Ilość pytań w bazie</div>-->
<!--            <div class="stat-value">31K</div>-->
<!--        </div>-->

<!--        <div class="stat">-->
<!--            <div class="stat-figure text-secondary">-->
<!--                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="black" stroke-width="2">-->
<!--                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />-->
<!--                </svg>            </div>-->
<!--            <div class="stat-title">Ilość pytań w danej kategorii</div>-->
<!--            <div class="stat-value">4,200</div>-->
<!--        </div>-->

<!--        <div class="stat">-->
<!--            <div class="stat-figure text-secondary">-->
<!--                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="black" stroke-width="2">-->
<!--                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />-->
<!--                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />-->
<!--                </svg>            </div>-->
<!--            <div class="stat-title">Procent pytań w danej kategorii</div>-->
<!--            <div class="stat-value">1,200</div>-->
<!--        </div>-->

<!--    </div>-->
</template>

<script>
import Breadcrumbs from "@/Components/Breadcrumbs";
import DeleteConfirmation from "@/Components/DeleteConfirmation";

export default {
    name: "Edit",
    components:{
        Breadcrumbs,
        DeleteConfirmation
    },
    props:{
        selected_category: {
          type: Object,
      },
        errors: Object,

    },
    data(){
        return {
            crumbs: [
                {
                    name: 'Pytania egzaminacyjne',
                    route: 'question.index'
                },
                {
                    name: 'Kategorie',
                    route: 'categories.questions.index'
                },
                {
                    name: this.selected_category.id,
                    route: ""
                }
            ],
            form: this.$inertia.form({
                name: this.selected_category.name,
                short_name: this.selected_category.short_name,
                description: this.selected_category.description,
            }),
        }
    },
    methods:{
        submit() {
            this.form.put(this.route('categories.questions.update', this.selected_category.id));
        },
    }
}
</script>

<style scoped lang="scss">
    .stats{
        margin-top: 200px;
    }
</style>

<template>
    <Breadcrumbs :crumbs="crumbs"/>

    <div class="w-full h-2/5 mt-8">
        <form @submit.prevent="submit" v-if="hasAnyPermission(['create categories'])">
            <div class="flex">
                <div class="form-control w-full pr-5">
                    <label class="label">
                        <span class="label-text font-extralight text-gray-700">Nazwa</span>
                    </label>
                    <input v-model="form.name" type="text" class="input input-bordered w-full focus:ring-indigo-200 focus:border-gray-300">
                </div>
                <div class="form-control w-full pl-6">
                    <label class="label">
                        <span class="label-text font-extralight text-gray-700">Skrócona nazwa</span>
                    </label>
                    <input v-model="form.short_name" type="text" class="input input-bordered w-full focus:ring-indigo-200 focus:border-gray-300">
                </div>
            </div>
            <div class="form-control">
                <label class="label">
                    <span class="label-text font-extralight text-gray-700">Opis</span>
                </label>
                <textarea v-model="form.description" class="textarea h-24 textarea-bordered focus:ring-indigo-200 focus:border-gray-300"></textarea>
            </div>
            <div class="flex justify-center">
                <button class="btn gap-2 btn-md mt-3 " type="submit">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    Dodaj kategorię
                </button>
            </div>
        </form>

        <div class="py-5">
            <div v-for="(category,index) in categories" :tabindex="index" class="mt-4 lg:hidden collapse collapse-plus border border-base-300 bg-base-100 rounded-box">
                <div class="collapse-title text-xl font-extralight">
                    <span class="mr-2">
                        {{ category.id }}.
                    </span>
                    <span>
                        {{ category.name }}
                    </span>
                    <span class="ml-2">
                        ({{category.short_name}})
                    </span>
                </div>
                <div class="collapse-content">
                    <p> {{category.description}} </p>
                </div>
            </div>
            <div class='overflow-x-auto w-full hidden lg:block'>
                <table class='mx-auto mt-12 w-full rounded-lg bg-white divide-y divide-gray-300 overflow-hidden'>
                    <thead class="bg-gray-600">
                    <tr class="text-white text-left">
                        <th class="font-semibold text-sm uppercase px-6 py-4"> # </th>
                        <th class="font-semibold text-sm uppercase px-6 py-4"> Nazwa </th>
                        <th class="font-semibold text-sm uppercase px-6 py-4 text-center"> Opis </th>
                        <th class="font-semibold text-sm uppercase px-6 py-4 text-center"> Skrócona nazwa </th>
                        <th class="font-semibold text-sm uppercase px-6 py-4 text-center" v-if="hasAnyPermission(['edit category'])">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                            </svg>
                        </th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr v-for="category in categories">
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-3">
                                    <div class="inline-flex w-10 h-10"> {{ category.id}}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p> {{ category.name }} </p>
                            </td>
                            <td class="px-6 py-4 ">
                                <p class=""> {{ category.description }} </p>
                            </td>
                            <td class="px-6 py-4 text-center"> <span class="text-white whitespace-nowrap text-sm bg-orange-500 p-2 font-semibold px-2 rounded-full"> {{ category.short_name }} </span> </td>
                            <td class="text-center" v-if="hasAnyPermission(['edit category'])">
                                <div data-tip="Wyświetl" class="tooltip">
                                    <Link :href="route('categories.questions.edit', {id: category.id})">
                                        <i class="fas fa-eye text-lg hover:text-gray-500"></i>
                                    </Link>
                                </div>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>

    </div>
</template>

<script>
import Breadcrumbs from "@/Components/Breadcrumbs";
import DeleteConfirmation from "@/Components/DeleteConfirmation";
import {Link} from "@inertiajs/inertia-vue3";

export default {
    name: "Categories",
    components:{
        Breadcrumbs,
        DeleteConfirmation,
        Link
    },
    props: {
      categories: {
          type: Object,
      }
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
            ],
            form: this.$inertia.form({
                name: null,
                short_name: null,
                description: null,
            }),
        }
    },
    methods:{
        submit() {
            this.form.post(this.route('categories.questions.store'))
        },
    }
}
</script>

<style scoped>

</style>

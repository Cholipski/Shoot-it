<template>
    <Breadcrumbs :crumbs="crumbs"/>
    <div class="container mx-auto mt-4 flex justify-start">
        <span class="text-xl bg-white rounded-lg shadow p-5">Liczba pytań: {{questions.meta.total}} </span>
    </div>
    <div class="flex justify-end w-full" v-if="hasAnyPermission(['create questions'])">
        <Link
            :href="route('question.create')"
            class="btn btn-outline rounded hover:bg-gray-neural hover:text-gray-200"> Dodaj pytanie </Link>
    </div>
    <div class="flex w-2/6 h-14 bg-white rounded">
        <input class="relative px-6 h-10 py-2 w-full rounded focus:ring-0 focus:border-gray-800" autocomplete="off" type="text" v-model="params.search" name="search" placeholder="Szukaj..." />
    </div>
    <table class="table-auto text-center min-w-full ">
        <thead class="border-b bg-neutral">
        <tr>
            <th scope="col" class="text-sm font-medium text-white px-6 py-4 w-screen">
                <span class="flex gap-4 justify-center items-center" @click="sort('value')">
                    <span>Pytanie</span>
                    <i v-if="params.field === 'value' && params.direction ==='desc'" class="fas fa-sort-amount-down"></i>
                    <i v-if="params.field === 'value' && params.direction ==='asc'" class="fas fa-sort-amount-up"></i>
                    <svg v-if="params.field !== 'value'" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
</svg>
                </span>
            </th>
            <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                <span>Kategoria</span>
            </th>
            <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                Operacje
            </th>
        </tr>
        </thead>
        <tbody>
        <tr class="bg-white border-b cursor-pointer hover:bg-gray-200" v-for="question in questions.data">
            <td class="text-sm text-gray-900 font-light px-6 py-4">
                {{ question.value }}
            </td>
            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                {{ question.category }}
            </td>
            <td class="text-sm text-gray-900 font-light py-4 whitespace-nowrap flex justify-center gap-2">
                <div data-tip="Wyświetl" class="tooltip">
                    <Link :href="route('question.show', {id: question.id})">
                        <i class="fas fa-eye text-lg hover:text-gray-500"></i>
                    </Link>
                </div>
                <div data-tip="Edytuj" class="tooltip" v-if="hasAnyPermission(['edit question'])">
                    <Link :href="route('question.edit', {id: question.id})">
                        <i class="fas fa-edit text-lg hover:text-gray-500"></i>
                    </Link>
                </div>
                <delete-confirmation :route="route('question.destroy', {id: question.id})" v-if="hasAnyPermission(['delete question'])">
                    <div data-tip="Usuń " class="tooltip">
                        <i class="fas fa-trash-alt text-lg hover:text-red-300 text-red-700"></i>
                    </div>
                </delete-confirmation>

            </td>
        </tr>
        </tbody>

    </table>

    <PaginationBar :data="{...questions}" />
</template>

<script>
import PaginationBar from "@/Components/PaginationBar";
import SearchFilter from "@/Components/SearchFilter";
import {pickBy, throttle} from "lodash";
import Input from "@/Components/Input";
import Button from "@/Components/Button";
import {Link} from "@inertiajs/inertia-vue3";
import Breadcrumbs from "@/Components/Breadcrumbs";
import DeleteConfirmation from "@/Components/DeleteConfirmation";

export default {
    name: "List",
    components:{
        Input,
        PaginationBar,
        SearchFilter,
        Button,
        Link,
        Breadcrumbs,
        DeleteConfirmation
    },
    props: {
        questions: Object,
        filters: Object
    },

    data(){
        return {
            crumbs: [
                {
                    name: 'Pytania egzaminacyjne',
                    route: 'question.index'
                }
            ],
            params: {
                search: this.filters.search,
                field: this.filters.field,
                direction: this.filters.direction

            }
        }
    },
    methods: {
      sort(field){
          this.params.field = field;
          this.params.direction = this.params.direction === 'asc' ? 'desc' : 'asc';
      }
    },
    watch:{
        params: {
            handler: throttle(function() {
                let params = pickBy(this.params);
                this.$inertia.get(this.route('question.index'), params, {replace: true, preserveState: true});
            }, 150),
            deep: true,
        }
    }
}
</script>

<style scoped>

</style>

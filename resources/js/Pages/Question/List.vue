<template>
    <div class="flex flex-col">
        <div class="overflow-x-auto">
            <div class="py-4 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="relative w-full">
                    <div class="container mx-auto flex justify-start">
                        <span class="text-xl bg-gray-50 shadow-md rounded p-5">Liczba pytań: {{questions.meta.total}} </span>
                    </div>
                    <div class="flex justify-end w-full">
                        <Link
                            :href="route('question.create')"
                            class="primary-btn rounded-full pt-3 pb-3 pl-5 pr-5 mb-2 shadow-md text-white"
                        > Dodaj pytanie </Link>
                    </div>
                    <div class="flex w-2/6 h-14 bg-white rounded">
                        <input class="relative px-6 h-10 py-2 w-full rounded focus:ring-0 focus:border-gray-800" autocomplete="off" type="text" v-model="params.search" name="search" placeholder="Szukaj..." />
                    </div>
                    <table class="table-auto text-center min-w-full">
                        <thead class="border-b bg-gray-800">
                        <tr>
                            <th scope="col" class="text-sm font-medium text-white px-6 py-4 w-screen">
                                <span class="flex gap-4 justify-center items-baseline" @click="sort('value')">
                                    <span>Pytanie</span>
                                    <i v-if="params.field === 'value' && params.direction ==='desc'" class="fas fa-sort-amount-down"></i>
                                    <i v-if="params.field === 'value' && params.direction ==='asc'" class="fas fa-sort-amount-up"></i>
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
                                Otto
                            </td>
                            <td class="text-sm text-gray-900 font-light py-4 whitespace-nowrap flex justify-center gap-2">
                                <i class="fas fa-eye text-lg hover:text-gray-500"></i>
                                <i class="fas fa-edit text-lg hover:text-gray-500"></i>
                                <i class="fas fa-trash-alt text-lg hover:text-gray-500"></i>
                            </td>
                        </tr>
                        </tbody>
                    </table>
<!--                    <PaginationBar :data="{...questions.meta}" />-->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import PaginationBar from "@/Components/PaginationBar";
import SearchFilter from "@/Components/SearchFilter";
import {pickBy, throttle} from "lodash";
import Input from "@/Components/Input";
import Button from "@/Components/Button";
import {Link} from "@inertiajs/inertia-vue3";

export default {
    name: "List",
    components:{
        Input,
        PaginationBar,
        SearchFilter,
        Button,
        Link
    },
    props: {
        questions: Object,
        filters: Object
    },

    data(){
        return {
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

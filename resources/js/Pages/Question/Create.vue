<template>
    <div class="flex flex-col">
        <div class="overflow-x-auto">
            <div class="py-4 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="relative w-full">
                    <Breadcrumbs/>
                    <span class="text-3xl items-center justify-center text-gray-400 font-bold flex mt-7 mb-2">
                        Utwórz nowe pytanie
                    </span>
                    <form @submit.prevent="submit" class="w-full mt-6">
                        <div class="flex justify-end items-baseline mt-4 mb-8">
                            <label :for="this.ids.select" class="block mb-2 mr-3 text-sm font-medium text-gray-400">Wybierz
                                kategorię</label>
                            <select :id="this.ids.select"
                                    class="w-1/2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    v-model="form.category">
                                <option :value="category.id" :key="category.id"
                                        v-for="(category,index) in this.categories" :selected="index === 0">
                                    {{ category.name }}
                                </option>
                            </select>
                        </div>
                        <textarea :id="ids.textarea" rows="4" v-model="form.value"
                                  class="block p-2 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                  placeholder="Wprowadź treść pytania"></textarea>

                        <div class="w-full flex">
                            <div class="flex justify-center w-1/2 text-gray-400 mt-2 mb-2 items-center">
                                Odpowiedzi:
                            </div>
                            <div class="w-1/4 flex justify-start ml-14 text-gray-400 mt-2 mb-2 items-center">
                                Poprawna
                            </div>
                            <div class="w-1/4 mt-2 mb-2">
                                <button type="button" @click="add(form.answers.length-1)"
                                        class="
                                        text-gray-900
                                        hover:text-white
                                        border
                                        border-gray-800
                                        hover:bg-gray-900
                                        focus:ring-4
                                        focus:ring-gray-300
                                        font-medium
                                        rounded-lg
                                        text-sm
                                        px-5
                                        py-2.5
                                        text-center
                                        mr-2
                                        mb-2
                                        dark:border-gray-600
                                        dark:text-gray-400
                                        dark:hover:text-white
                                        dark:hover:bg-gray-600
                                        dark:focus:ring-gray-800"
                                        v-if="this.form.answers.length <= 10"
                                >Dodaj odpowiedź
                                </button>
                            </div>
                        </div>
                        <div class="group flex items-center gap-3" v-for="(input,k) in form.answers" :key="k">
                            <div class="flex items-center mt-2" @click="remove(k)"
                                 v-show="k || ( !k && form.answers.length > 1)">
                                <i class="fas fa-trash text-sm text-red-900 hover:text-red-600 cursor-pointer"></i>
                            </div>
                            <div class="flex mt-2 w-1/2">
                                <span
                                    class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 rounded-l-md border border-r-0 border-gray-300 dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                {{ String.fromCharCode(65 + k) }}
                                </span>
                                <input type="text" id="website-admin"
                                       class="rounded-none rounded-r-lg bg-gray-50 w-1/2 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                       placeholder=""
                                       v-model="input.answer"/>
                            </div>
                            <CheckboxToggle v-model="input.is_correct"/>
                        </div>
                        <div class="flex items-center justify-end mt-4 flex-col-reverse gap-2 sm:flex-row">
                            <Button
                                class="text-white w-full bg-gray-800 hover:bg-gray-900 focus:ring-4 mt-12 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-800 dark:border-gray-700"
                                :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Dodaj pytanie
                            </Button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import Breadcrumbs from "@/Components/Breadcrumbs";
import CheckboxToggle from "@/Components/CheckboxToggle";
import {uuid} from 'vue-uuid';

export default {
    name: "Create",
    components: {
        Breadcrumbs,
        CheckboxToggle,
    },
    props: {
        categories: {
            type: Object,
            required: true,
        }
    },
    data() {
        return {
            ids: {
                textarea: uuid.v1(),
                select: uuid.v1(),
            },
            form: this.$inertia.form({
                value: '',
                category: this.categories[0].id ? this.category[0].id : 0,
                answers: [
                    {
                        answer: '',
                        is_correct: false,
                    },
                    {
                        answer: '',
                        is_correct: false,
                    },
                    {
                        answer: '',
                        is_correct: false,
                    }
                ]
            }),

        }
    },
    methods: {
        submit() {

            this.form.post(this.route('question.store'))
        },
        add(index) {
            this.form.answers.push(
                {
                    answer: '',
                    is_correct: false,
                }
            )
        },
        remove(index) {
            this.form.answers.splice(index, 1);
        }
    }
}
</script>

<style scoped>

</style>

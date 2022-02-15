<template>
    <div class="flex flex-col">
        <div class="overflow-x-auto">
            <div class="py-4 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="relative w-full">
                    <Breadcrumbs />

                    <div v-for="(question,key) in Questions" >
                        <h1>{{question.value}}</h1>
                        <div v-for="answer in question.answers" class="form-control">
                            <label class="cursor-pointer label">
                                <span class="label-text w-full break-all">{{answer.value}}</span>
                                <input type="radio" :name="question.id" class="radio checked:bg-red-500">
                            </label>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Breadcrumbs from "@/Components/Breadcrumbs";

export default {
    name: "Exam",
    components: {
        Breadcrumbs,
    },
    props:{
        Questions:{
            type: Array
        }
    },
}
</script>

<style scoped>

</style>

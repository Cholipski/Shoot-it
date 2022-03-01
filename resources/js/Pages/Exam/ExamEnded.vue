<template>
    <div class="flex flex-col">
        <div class="overflow-x-auto">
            <div class="py-4 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="relative w-full">
                    <Breadcrumbs :crumbs="crumbs"/>
                    <div v-for="(question,key) in Questions"  class="p-4">
                        <div class="flex mt-2 mb-2 items-baseline">
                            <span class="mr-4 text-2xl font-extralight">{{key + 1 }}.</span>
                            <span class="text-xl font-extralight">{{question.value}}</span>
                        </div>

                        <div v-for="(answer,k) in question.answers" class="form-control answers">
                            <label class="label">
                                <span class="mr-3 bg-gray-100 p-3 rounded-full"> {{ String.fromCharCode(65 + k) }}</span>
                                <span class="label-text w-full  ">{{answer.value}}</span>
<!--                                <input v-on:click="selectAnswer(question.id,answer.id)" type="radio" :name="question.id" :checked="answer.id === question.selectedAnswer" class="radio checked:bg-red-500">-->
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
    name: "ExamEnded",
    components: {
        Breadcrumbs,
    },
    props:{
        Questions:{
            type: Array
        },
        Exam_id:{
            type: String
        }
    },
    data(){
      return {
          crumbs: [
              {
                  name: 'Egzaminy',
                  route: 'exam.index'
              },
              {
                  name: window.location.pathname.split('/')[2],
                  route: ''
              }
          ],
      }
    },
}
</script>

<style scoped lang="scss">
.answers{
    label{
        border-top: 1px solid #1a202c;
        border-left: 1px solid #1a202c;
        border-right: 1px solid #1a202c;

    }
    &:last-child{
        label {
            border-bottom: 1px solid #1a202c;
        }
        margin-bottom: 10px;
    }
}

</style>

<template>
    <form @submit.prevent="submit" class="w-4/5 sm:w-3/5 md:w-3/5 2xl:w-2/5 mt-24">
        <div>
            <textarea id="question" class="mt-1 block w-full" v-model="form.value" />
        </div>

        <div class="group" v-for="(input,k) in form.answers" :key="k">
            <input type="text" v-model="input.answer" />
            <input type="checkbox" v-model="input.is_correct" />
            <span>
                <i class="fas fa-minus-circle" @click="remove(k)" v-show="k || ( !k && form.answers.length > 1)" />
                <i class="fas fa-plus-circle" @click="add(k)" v-show="k === form.answers.length-1" />
            </span>
        </div>

        <div class="flex items-center justify-end mt-4 flex-col-reverse gap-2 sm:flex-row">
            <Button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Dodaj pytanie
            </Button>
        </div>
    </form>
</template>

<script>

export default {
    name: "Create",
    data() {
        return {
            form: this.$inertia.form({
                value: '',
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
        add(index){
          this.form.answers.push(
              {
                  answer: '',
                  is_correct: false,
              }
          )
        },
        remove(index){
            this.form.answers.splice(index,1);
        }
    }
}
</script>

<style scoped>

</style>

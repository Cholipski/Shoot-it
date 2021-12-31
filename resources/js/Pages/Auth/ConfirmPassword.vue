<template>
    <Head title="Confirm Password" />

    <div class="container mx-auto flex flex-col justify-center w-full h-full items-center bg-gray-100">
        <form @submit.prevent="submit">
            <div>
                <Label for="password" value="Password" />
                <Input id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="current-password" autofocus />
            </div>

            <div class="flex justify-end mt-4">
                <Button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Confirm
                </Button>
            </div>
        </form>
    </div>
</template>

<script>
import Button from '@/Components/Shared/Button.vue'
import GuestLayout from '@/Layouts/Guest.vue'
import Input from '@/Components/Shared/Input.vue'
import Label from '@/Components/Label.vue'
import ValidationErrors from '@/Components/ValidationErrors.vue'

export default {
    layout: GuestLayout,

    components: {
        Button,
        Input,
        Label,
        ValidationErrors,
    },

    data() {
        return {
            form: this.$inertia.form({
                password: '',
            })
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('password.confirm'), {
                onFinish: () => this.form.reset(),
            })
        }
    }
}
</script>

<template>
    <Head title="Forgot Password" />
    <div class="container mx-auto flex flex-col justify-center  w-full h-full items-center bg-gray-100">

        <div class="w-4/5 sm:w-3/5 md:w-3/5 2xl:w-2/5 eb-garamond mb-4 text-lg text-gray-600">
            Zapomniałeś hasła? Nie ma problemu. Wprowadź poniżej swój adres e-mail, a zostanie wysłana do ciebie widomość z linkiem do ustawienia nowego hasła.        </div>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <ValidationErrors class="mb-4" />

        <form class="w-4/5 sm:w-3/5 md:w-3/5 2xl:w-2/5" @submit.prevent="submit">
            <div>
                <Label for="email" value="Email" />
                <Input id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus autocomplete="username" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <Button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Wyślij link do resetowania hasła
                </Button>
            </div>
        </form>
    </div>

</template>

<script>
import Button from '@/Components/Button.vue'
import GuestLayout from '@/Layouts/Guest.vue'
import Input from '@/Components/Input.vue'
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

    props: {
        status: String,
    },

    data() {
        return {
            form: this.$inertia.form({
                email: ''
            })
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('password.email'))
        }
    }
}
</script>

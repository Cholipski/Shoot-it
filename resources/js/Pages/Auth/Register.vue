<template>
    <Head title="Register" />

    <div class="container mx-auto flex flex-col justify-center  w-full h-full items-center bg-gray-100">
        <Logo class="logo mt-2 sm:mb-8"/>
        <div class="mt-2 mb-2">
            <span class="eb-garamond text-2xl uppercase"> </span>
        </div>
        <form @submit.prevent="submit" class="w-4/5 sm:w-3/5 md:w-3/5 2xl:w-2/5">
            <div>
                <Label for="name" value="Nazwa" />

                <Input id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <Label for="email" value="Email" />
                <Input id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autocomplete="username" />
            </div>

            <div class="mt-4">
                <Label for="password" value="Hasło" />
                <Input id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <Label for="password_confirmation" value="Powtórz hasło" />
                <Input id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-4 flex-col-reverse gap-2 sm:flex-row">
                <Link :href="route('login')" class="underline text-sm text-gray-600 hover:text-gray-900">
                    Posiadasz już konto?
                </Link>

                <Button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Zarejestruj się
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
import { Link } from '@inertiajs/inertia-vue3';
import Logo from '@/Components/Shared/ApplicationLogo';

export default {
    layout: GuestLayout,

    components: {
        Button,
        Input,
        Label,
        ValidationErrors,
        Link,
        Logo
    },

    data() {
        return {
            form: this.$inertia.form({
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
                terms: false,
            })
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('register'), {
                onFinish: () => this.form.reset('password', 'password_confirmation'),
            })
        }
    }
}
</script>

<template>
    <Head title="Log in" />

    <div class="container mx-auto flex flex-col justify-center  w-full h-full items-center bg-gray-100">
        <Logo class="logo mt-2 sm:mb-8"/>
        <Transition name="fade">
            <div v-if="errors.email" class="alert mb-5 mt-5 md:mb-10 md:mt-0 alert-error text-sm shadow-lg w-5/6 md:w-2/3">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <span>Email lub hasło jest niepoprawne</span>
                </div>
            </div>
        </Transition>

        <div class="form-header mt-8 mb-4 sm:mt-0 sm:mb-2 sm:text-xl">
            Nie masz konta? <Link :href="route('register')" class="border-2 rounded-md p-2 hover:bg-gray-200">Utwórz konto</Link>
        </div>
        <form class="w-4/5 sm:w-3/5 md:w-3/5 2xl:w-2/5"  @submit.prevent="submit">
            <div>
                <Label for="email" value="Email" />
                <Input id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <Label for="password" value="Hasło" />
                <Input id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4 ">
                <label class="flex items-center">
                    <Checkbox name="remember" v-model:checked="form.remember" />
                    <span class="ml-2 text-sm text-gray-600 text-center">Zapamiętaj mnie</span>
                </label>
            </div>

            <div class="flex items-baseline justify-end mt-4 flex-col-reverse sm:flex-row">
<!--                <div>-->
<!--                    <span class="text-lg eb-garamond">-->
<!--                        Zapomniałeś hasła?-->
<!--                    </span>-->
<!--                    <Link :href="route('password.request')" class="eb-garamond underline text-lg text-gray-600 hover:text-gray-900 mt-2">-->
<!--                        Przypomnij hasło-->
<!--                    </Link>-->
<!--                </div>-->

                <AppButton class="sm:ml-4 w-full sm:w-auto text-center justify-center items-center mb-2 mt-2" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Zaloguj się
                </AppButton>

            </div>
        </form>
        <div class="seperator"><b>lub</b></div>
        <p>Zaloguj się za pomocą konta społecznościowego</p>

        <div class="justify-center items-center gap-11 mt-5 social-login flex mb-5">
            <a :href="route('facebook.login')"><i class="fab fa-facebook"></i></a>
            <a :href="route('google.login')"><i class="fab fa-google"></i></a>
<!--            <i class="fab fa-twitter"></i>-->
        </div>
    </div>

</template>

<script>

import GuestLayout from '@/Layouts/Guest.vue'
import Logo from '@/Components/ApplicationLogo';
import { Link } from '@inertiajs/inertia-vue3';
import AppButton from "@/Components/Button";
import Checkbox from "@/Components/Checkbox";
import Input from "@/Components/Input";
import Label from "@/Components/Label";

export default {
    layout: GuestLayout,

    components: {
        AppButton,
        Checkbox,
        Input,
        Label,
        Link,
        Logo,
    },
    data() {
        return {
            form: this.$inertia.form({
                email: '',
                password: '',
                remember: false
            }),
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('login'), {
                onFinish: () => this.form.reset('password'),
            })
        }
    },

    props: {
        status: String,
        errors: Object,
    },
}
</script>
<style scoped lang="scss">
    @import '../../../sass/variables';

    .fade-enter-active,
    .fade-leave-active {
        transition: opacity 0.5s ease;
    }

    .fade-enter-from,
    .fade-leave-to {
        opacity: 0;
    }
    .form-header{
        font-family: 'EB Garamond',serif;
    }
    .social-login{
        i{
            font-size: 2.2em;
            &:hover{
                color: $gray;
                cursor: pointer;
            }
        }
    }

    .seperator {
        float: left;
        width: 100%;
        border-top: 1px solid #ccc;
        text-align: center;
        margin: 50px 0 0;
        b {
            width: 40px;
            height: 40px;
            font-size: 16px;
            text-align: center;
            line-height: 40px;
            background: #fff;
            display: inline-block;
            border: 1px solid #e0e0e0;
            border-radius: 50%;
            position: relative;
            top: -22px;
            z-index: 1;
        }
    }
    p {
        float: left;
        width: 100%;
        text-align: center;
        font-size: 16px;
        margin: 0 0 10px;
        font-family: 'EB Garamond',serif;

    }
</style>

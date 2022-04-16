<template>
    <Breadcrumbs :crumbs="crumbs"/>
    <div class="flex w-full mt-8 flex-col-reverse md:flex-row justify-center items-center">
        <div class="w-full md:w-1/2">
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text font-extralight text-gray-700">Imię</span>
                </label>
                <input type="text" v-model="this.form.firstName" class="input input-bordered w-full focus:ring-indigo-200 focus:border-gray-300">
            </div>
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text font-extralight text-gray-700">Nazwisko</span>
                </label>
                <input type="text" v-model="this.form.lastName" class="input input-bordered w-full focus:ring-indigo-200 focus:border-gray-300">
            </div>
            <div class="form-control">
                <label class="label">
                    <span class="label-text font-extralight text-gray-700">O mnie</span>
                </label>
                <textarea v-model="this.form.aboutMe" class="textarea h-24 textarea-bordered focus:ring-indigo-200 focus:border-gray-300"></textarea>
            </div>
        </div>
        <div class="w-1/2 flex justify-center flex-col items-center">
            <input type="file" ref="photo" @change="previewImage" style="display: none">
            <div v-if="getAvatar() !== ''" class="avatar">
                <div  class="w-48 rounded-full">
                    <img  :src="getAvatar()" />
                </div>
            </div>
            <div v-else class="bg-neutral rounded-full z-50 w-48 h-48 flex justify-center font-bold items-center text-gray-50 text-3xl uppercase">
                {{ getInitials() }}
            </div>
            <button class="btn md:gap-2 btn-md md:btn-sm mt-3" @click="$refs.photo.click()">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z"></path></svg>
                <span>Wybierz zdjęcie</span>
            </button>
        </div>
    </div>
    <div class="divider"></div>
    <div class="flex flex-col-reverse xl:flex-row">
        <div class="w-full xl:w-1/3">
            <div class="form-control">
                <label v-if="!this.passwordIsSet()" class="label cursor-pointer bg-none">
                    <span class="label-text font-extralight text-xl">Włącz logowanie hasłem</span>
                    <input type="checkbox" v-model="this.form.setPassword" class="checkbox">
                </label>
            </div>
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text font-extralight text-gray-700">Stare hasło</span>
                </label>
                <input v-model="this.form.oldPassword" type="password" :disabled="disableOldPasswordField()" class="input input-bordered w-full focus:ring-indigo-200 focus:border-gray-300">
            </div>
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text font-extralight text-gray-700">Nowe hasło</span>
                </label>
                <input v-model="this.form.newPassword" type="password" :disabled="!this.form.setPassword" class="input input-bordered w-full focus:ring-indigo-200 focus:border-gray-300">
            </div>
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text font-extralight text-gray-700">Powtórz hasło</span>
                </label>
                <input v-model="this.form.confirmNewPassword" type="password" :disabled="!this.form.setPassword" class="input input-bordered w-full focus:ring-indigo-200 focus:border-gray-300">
            </div>
        </div>
        <div class="mb-7 xl:mb-0 xl:ml-10">
            <div v-if="socialLogin() && !passwordIsSet()" class="alert alert-warning shadow-lg">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                    <span>Logujesz się za pomocą Google lub Facebook, ustal hasło aby logować się również za pomoca maila</span>
                </div>
            </div>
        </div>
    </div>
    <div class="w-full flex justify-end">
        <button class="btn gap-2 btn-md mt-3 w-full  md:w-1/6" @click="submit()">Zapisz</button>

    </div>

</template>

<script>
import Breadcrumbs from "@/Components/Breadcrumbs";
import {Inertia} from "@inertiajs/inertia";

export default {
    name: "Profile",
    components: {
        Breadcrumbs,
    },
    data(){
        return {
            photo: this.$page.props.auth.user.avatar,
            crumbs: [
                {
                    name: 'Profil',
                    route: 'profile.index'
                }
            ],
            form: this.$inertia.form({
                _method: 'put',
                setPassword: this.passwordIsSet(),
                firstName: this.$page.props.auth.user.first_name,
                lastName: this.$page.props.auth.user.last_name,
                aboutMe: this.$page.props.auth.user.about_me,
                oldPassword: null,
                newPassword: null,
                confirmNewPassword: null,
                photo: null,
            }),
        }
    },
    methods: {
        submit() {
            this.form.post(this.route('profile.update',this.$page.props.auth.user.id))
        },
        getAvatar: function (){
            return this.photo;
        },
        socialLogin() {
          return this.$page.props.auth.user.google_id != null || this.$page.props.auth.user.facebook_id != null;
        },
        passwordIsSet()
        {
            return this.$page.props.auth.user.password_set === 1;
        },
        disableOldPasswordField()
        {
          return this.$page.props.auth.user.password_set === 0 ;
        },
        previewImage(e) {
            const file = e.target.files[0];
            this.photo = URL.createObjectURL(file);
            this.form.photo = this.$refs.photo.files[0];
        },
        getInitials: function (){
            return this.$page.props.auth.user.first_name[0] + this.$page.props.auth.user.last_name[0];
        }
    }
}
</script>

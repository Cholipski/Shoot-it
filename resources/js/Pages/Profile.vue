<template>
    <Breadcrumbs :crumbs="crumbs"/>
    <div class="flex w-full mt-8 flex-col-reverse md:flex-row justify-center items-center">
        <div class="w-full md:w-1/2">
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text font-extralight text-gray-700">Imię</span>
                </label>
                <input type="text" class="input input-bordered w-full focus:ring-indigo-200 focus:border-gray-300">
            </div>
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text font-extralight text-gray-700">Nazwisko</span>
                </label>
                <input type="text" class="input input-bordered w-full focus:ring-indigo-200 focus:border-gray-300">
            </div>
            <div class="form-control">
                <label class="label">
                    <span class="label-text font-extralight text-gray-700">O mnie</span>
                </label>
                <textarea class="textarea h-24 textarea-bordered focus:ring-indigo-200 focus:border-gray-300"></textarea>
            </div>
        </div>
        <div class="w-1/2 flex justify-center flex-col items-center">
            <input type="file" ref="file" style="display: none">
            <div class="avatar">
                <div class="w-48 rounded-full">
                    <img :src="getAvatar()">
                </div>
            </div>
            <button class="btn md:gap-2 btn-md md:btn-sm mt-3" @click="$refs.file.click()">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z"></path></svg>
                <span>Wybierz zdjęcie</span>
            </button>
        </div>
    </div>
    <div class="divider"></div>
    <div class="flex flex-col-reverse xl:flex-row">
        <div class="w-full xl:w-1/3">
            <div class="form-control">
                <label class="label cursor-pointer bg-none">
                    <span class="label-text font-extralight text-xl">Włącz logowanie hasłem</span>
                    <input type="checkbox" class="toggle" checked>
                </label>
            </div>
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text font-extralight text-gray-700">Stare hasło</span>
                </label>
                <input type="text" class="input input-bordered w-full focus:ring-indigo-200 focus:border-gray-300">
            </div>
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text font-extralight text-gray-700">Nowe hasło</span>
                </label>
                <input type="text" class="input input-bordered w-full focus:ring-indigo-200 focus:border-gray-300">
            </div>
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text font-extralight text-gray-700">Powtórz hasło</span>
                </label>
                <input type="text" class="input input-bordered w-full focus:ring-indigo-200 focus:border-gray-300">
            </div>
        </div>
        <div class="mb-7 xl:mb-0 xl:ml-10">
            <div class="alert alert-warning shadow-lg">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                    <span>Logujesz się za pomocą Google lub Facebook, przesuń suwak i ustal hasło aby logować się również za pomoca maila</span>
                </div>
            </div>
        </div>
    </div>
    <div class="w-full flex justify-end">
        <button class="btn gap-2 btn-md mt-3 w-full  md:w-1/6">Zapisz</button>

    </div>

</template>

<script>
import Breadcrumbs from "@/Components/Breadcrumbs";

export default {
    name: "Profile",
    components: {
        Breadcrumbs,
    },
    data(){
        return {
            crumbs: [
                {
                    name: 'Profil',
                    route: 'profile.index'
                }
            ]
        }
    },
    methods: {
        getAvatar: function (){
            return this.$page.props.auth.user.avatar;
        },
    }
}
</script>

<style scoped>
[type='checkbox']:checked
{
    background-image: none;
    background: black;
}
</style>

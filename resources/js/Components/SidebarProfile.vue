<template>
    <div class="flex-col justify-items-center pb-3 bottom-0 pt-3">
        <img v-if="getAvatar() !== ''" class="rounded-full z-50 mx-auto w-14 h-14" :src="getAvatar()" />
        <div v-else class="generate-image rounded-full z-50 w-14 absolute h-14 flex justify-center font-bold items-center text-gray-50">
            KD
        </div>
        <transition name="fade">
            <div v-if="!collapsed" class="flex flex-col justify-items-center items-center ml-5 mt-1">
                <span class="text-lg whitespace-nowrap">{{getFullName()}}</span>
                <span class="text-sm text-gray-500 hover:text-white cursor-pointer whitespace-nowrap">Wyświetl profil</span>
            </div>
        </transition>
    </div>
</template>

<script>

export default {
    name: "SidebarProfile",
    methods:{
        getFullName: function (){
            return this.$page.props.auth.user.first_name + " " + this.$page.props.auth.user.last_name;
        },
        getAvatar: function (){
            return this.$page.props.auth.user.avatar;
        }
    }
}
</script>

<style scoped lang="scss">

    .fade-enter-active,
    .fade-leave-active {
        transition: opacity 0.1s;
    }

    .fade-enter,
    .fade-leave-to {
        opacity: 0;
    }
    .profile{

        .generate-image{
            background: #161925;
        }
    }



</style>

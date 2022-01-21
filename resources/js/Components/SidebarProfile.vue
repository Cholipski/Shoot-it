<template>
    <div class="profile flex w-full h-12 absolute bottom-0 mb-4 pl-3">
        <img class="rounded-full" src="http://karboklinika.pl/wp-content/uploads/2020/04/elegancki-mezczyzna-682x1024.jpg" />
        <transition name="fade">
            <div v-if="!collapsed" class="flex flex-col w-full justify-items-center items-center">
                <span class="text-lg whitespace-nowrap">{{getFullName()}}</span>
                <span class="text-sm text-gray-500 hover:text-white cursor-pointer whitespace-nowrap">Wyświetl profil</span>
            </div>
        </transition>
    </div>
</template>

<script>
import {collapsed} from "@/Store/Sidebar/state";

export default {
    name: "SidebarProfile",

    setup(props){
        return {collapsed};
    },

    methods:{
        getFullName: function (){
            return this.$page.props.auth.user.first_name + " " + this.$page.props.auth.user.last_name;
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

</style>

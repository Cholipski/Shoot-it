<template>
    <div class="pb-3 pt-3 flex flex-col justify-center">
        <img v-if="getAvatar() !== ''" class="rounded-full z-50 mx-auto w-14 h-14" :src="getAvatar()" />
        <div v-else class="bg-neutral rounded-full z-50 w-14 h-14 flex justify-center mx-auto font-bold items-center text-gray-50 uppercase">
            {{ getInitials() }}
        </div>
        <transition name="fade">
            <div v-if="!collapsed" class="flex flex-col justify-items-center items-center ml-5 mt-1">
                <span class="text-lg whitespace-nowrap">{{getFullName()}}</span>
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
        },
        getInitials: function (){
            return this.$page.props.auth.user.first_name[0] + this.$page.props.auth.user.last_name[0];
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

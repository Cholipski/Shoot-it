<template>
    <Link :href="to" class="link flex justify-items-center items-center relative cursor-pointer h-12 mt-2 p-2.5 pl-5 text-white no-underline"
        :class="{'active': $page.component === componentName}">
        <div class="w-8 absolute flex justify-center mr-4 align-baseline">
            <i class="icon text-3xl" :class="icon"></i>
        </div>

        <transition name="fade">
            <span v-if="!collapsed" class="whitespace-nowrap pl-12">
                <slot />
            </span>
        </transition>
    </Link>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
import { collapsed } from "@/Components/AuthenticatedLayout/sidebar/state";

export default {
    name: "SidebarLink",
    components: {
        Link
    },
    props: {
        to: { type: String, required: true},
        icon: { type: String, required: true},
        componentName: { type: String, required: true}
    },

    setup(props){
        return {collapsed}
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

    .link{
        &:hover{
            background-color: var(--sidebar-item-hover);
        }

    }
    .active{
        background: var(--sidebar-item-active) !important;
    }
</style>

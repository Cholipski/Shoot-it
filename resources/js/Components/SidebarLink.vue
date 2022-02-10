<template>
    <Link class="link flex justify-items-center items-center relative cursor-pointer h-12 mt-2 p-2.5 pl-5 text-white no-underline"
        :class="{'active': $page.component === componentName}">
        <div class="w-8 absolute flex justify-center mr-4 align-baseline">
            <i class="icon text-3xl" :class="icon"></i>
        </div>

        <transition name="fade">
            <span class="whitespace-nowrap" :class="icon ? 'pl-12' : 'pl-5'">
                <slot />
            </span>
        </transition>
    </Link>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";

export default {
    name: "SidebarLink",
    components: {
        Link
    },
    props: {
        icon: { type: String, required: false},
        componentName: { type: String, required: true}
    },

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

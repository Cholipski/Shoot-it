<template>
    <div class="flex min-h-screen">
        <Sidebar class="hidden sm:block"></Sidebar>
        <div class="container main-container" :style="{ 'margin-left': sidebarWidth}">
            <div class="overflow-hidden bg-gray-100 shadow-lg w-full fixed">
                <div class="h-16 border-gray-200">
                    {{$page.props.auth.user.id}}
                </div>
                <button @click="sideMenuOpen = !sideMenuOpen"> click me </button>
            </div>
            <main>
                <slot />
            </main>
        </div>

    </div>
</template>

<script>
import Logo from '../Components/Shared/ApplicationLogo'
import Sidebar from "@/Components/AuthenticatedLayout/sidebar/Sidebar";
import { sidebarWidth } from '@/Components/AuthenticatedLayout/sidebar/state'

export default {
    components: {
        Logo,
        Sidebar
    },

    data() {
        return {
            showingNavigationDropdown: false,
            search: '',
        }
    },

    setup() {
        return { sidebarWidth }
    }
}
</script>
<style scoped lang='scss'>
    .main-container{
        transition: 0.3s ease;

        @media (max-width: 639px){
            margin-left: 0 !important;
        }
    }
</style>

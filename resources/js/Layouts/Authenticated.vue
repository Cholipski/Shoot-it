<template>
    <div class="flex">
        <Sidebar class="hidden sm:block"></Sidebar>
        <div class="main-container relative w-full" :style="{ 'margin-left': sidebarWidth}">
            <div class="overflow-hidden z-10 bg-gray-100 shadow-lg w-full fixed">
                <div class="h-12 border-gray-200">
                    {{$page.props.auth.user.id}}
                </div>
            </div>
            <main class="pt-12" >
                <slot />
            </main>
        </div>

    </div>
</template>

<script>
import Logo from '../Components/ApplicationLogo'
import Sidebar from "@/Components/Sidebar";
import { sidebarWidth } from '@/Store/Sidebar/state'

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

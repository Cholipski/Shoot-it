<template>
    <div class="flex">
        <Sidebar class="hidden sm:block"></Sidebar>
        <div class="main-container relative" :style="{ width: mainContainerWidth(), 'margin-left': sidebarWidth }">
            <div class="overflow-hidden z-10 bg-gray-100 shadow-lg fixed navbar">
                <div class="h-12 border-gray-200 grid grid-flow-col auto-cols-auto">
                    <div>
                    </div>
                    <div class="flex justify-end items-center pr-8">
                        <Link :href="route('logout')" method="post" as="button" type="button" class="logout flex items-center gap-2">
                            <i class="logout-icon fas fa-sign-out-alt text-gray-600 text-3xl cursor-pointer" />
                            <span>Wyloguj</span>
                        </Link>
                    </div>
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
import {collapsed, sidebarWidth, SIDEBAR_WIDTH, SIDEBAR_WIDTH_COLLAPSED, sidebarWidthNumber} from '@/Store/Sidebar/state'
import { Link } from '@inertiajs/inertia-vue3'

export default {
    components: {
        Logo,
        Sidebar,
        Link
    },

    mounted() {
        this.$nextTick(() => {
            window.addEventListener('resize', this.onResize);
        })
    },

    beforeDestroy() {
        window.removeEventListener('resize', this.onResize);
    },

    data() {
        return {
            showingNavigationDropdown: false,
            windowWidth: window.innerWidth,
            search: '',
        }
    },
    setup() {
        return { sidebarWidthNumber, sidebarWidth  }
    },

    methods: {
        onResize() {
            this.windowWidth= window.innerWidth
        },

        mainContainerWidth(){
            if(this.windowWidth > 639){
                let width = this.windowWidth - this.sidebarWidthNumber;
                return `${width}px !important`;
            }
            else{
                return `${this.windowWidth}px`;

            }
        }


    }
}
</script>
<style scoped lang='scss'>
    .main-container{
        transition: 0.3s ease;

        @media (max-width: 639px){
            margin-left: 0 !important;
        }
        .navbar{
            width: inherit;
        }

        .logout{
            &:hover{
                .logout-icon{
                    color: black;
                }
            }
        }
    }
</style>

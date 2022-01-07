<template>
    <div class="sidebar float-left fixed z-10 top-0 left-0 bottom-0 flex flex-col" :style="{ width: sidebarWidth}">
        <div class="h-28 pt-5">
            <Logo />

        </div>

        <SidebarLink to="/" icon="fas fa-home" component-name="Dashboard"> Strona główna </SidebarLink>
        <SidebarLink to="/" icon="fas fa-book-reader" component-name="Learning"> Szkolenia </SidebarLink>
        <SidebarLink to="/" icon="fas fa-graduation-cap" component-name="Exams">Egzaminy</SidebarLink>
        <SidebarLink to="/" icon="fas fa-trophy" component-name="Ranking">Ranking</SidebarLink>
        <SidebarLink to="/" icon="fas fa-trophy" component-name="Score">Moje wyniki</SidebarLink>

        <span
            class="absolute bottom-16 p-3 ml-2.5 text-white text-3xl transition ease-linear delay-200"
            @click="toggleSidebar"
            :class="{'rotate-180': collapsed}">
            <i class="fas fa-angle-double-left" />
        </span>

        <SidebarProfile />
    </div>
</template>

<script>
import { collapsed, toggleSidebar, sidebarWidth } from './state'
import Logo from '@/Components/Shared/ApplicationLogo';
import SidebarLink from "@/Components/AuthenticatedLayout/sidebar/SidebarLink";
import SidebarProfile from "@/Components/AuthenticatedLayout/sidebar/SidebarProfile";

export default {
    components:{
        Logo,
        SidebarLink,
        SidebarProfile
    },
    props:{},
    setup(){
      return { collapsed, toggleSidebar, sidebarWidth }
    },
    name: "Sidebar"
}
</script>

<style >
    :root{
        --sidebar-bg-color: #1b1f2f;
        --sidebar-item-hover: #262d43;
        --sidebar-item-active: #262d43;
    }
</style>

<style scoped lang="scss">

    .application-logo{
        filter: invert(92%) sepia(32%) saturate(5945%) hue-rotate(177deg) brightness(109%) contrast(103%);
        height: 55px;
        margin: auto;
    }

    .sidebar{
        color: white;
        background-color: var(--sidebar-bg-color);
        transition: 0.3s ease;
    }

    .rotate-180{
        transform: rotate(180deg);
        transition:  0.2s linear;
    }
</style>

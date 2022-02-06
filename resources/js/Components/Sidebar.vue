<template>
    <div class="sidebar fixed min-h-screen float-left z-50 top-0 left-0 bottom-0 sm:flex flex-col justify-between" :style="{ width: sidebarWidth}">
        <div>
            <div class="h-20 pt-5 flex justify-between mb-10">
                <Logo v-if="!collapsed" class="ml-4"/>
                <span
                    class="top-5 right-0 p-3 ml-2.5 text-white text-3xl transition ease-linear delay-200 mr-4"
                    @click="toggleSidebar"
                    :class="{'rotate-180': collapsed}">
                     <i class="fas fa-angle-double-left" />
                </span>
            </div>
            <div class="nav" :style="{ width: sidebarWidth}">
                <SidebarLink :href="route('dashboard')" icon="fas fa-home" component-name="Dashboard"> Strona główna </SidebarLink>
                <SidebarLink v-if="hasAnyPermission(['view users'])" to="/" icon="fas fa-user" component-name="Users"> Użytkownicy </SidebarLink>
                <SidebarLink to="/" icon="fas fa-book-reader" component-name="Learning"> Baza wiedzy </SidebarLink>
                <SidebarLink :href="route('question.index')" icon="fas fa-question" component-name="Questions">Baza pytań</SidebarLink>
                <SidebarLink :href="route('exam.index')" icon="fas fa-graduation-cap" component-name="Exams">Egzaminy</SidebarLink>
                <SidebarLink to="/" icon="fas fa-poll" component-name="Score">Moje wyniki</SidebarLink>
                <SidebarLink to="/" icon="fas fa-trophy" component-name="Ranking">Ranking</SidebarLink>
            </div>
        </div>
        <SidebarProfile />
    </div>
</template>

<script>
import { collapsed, toggleSidebar, sidebarWidth } from '../Store/Sidebar/state'
import Logo from '@/Components/ApplicationLogo';
import SidebarLink from "@/Components/SidebarLink";
import SidebarProfile from "@/Components/SidebarProfile";

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
        --sidebar-bg-color: #292b35;
        --sidebar-item-hover: #262d43;
        --sidebar-item-active: #262d43;
    }
</style>

<style scoped lang="scss">

    .application-logo{
        filter: invert(92%) sepia(32%) saturate(5945%) hue-rotate(177deg) brightness(109%) contrast(103%);
        height: 55px;
    }

    .sidebar{
        height: 100% !important;
        color: white;
        transition: 0.3s ease;
        background-color: var(--sidebar-bg-color);
    }

    .rotate-180{
        transform: rotate(180deg);
        transition:  0.2s linear;
    }
    .nav{
        transition: 0.3s ease;

        @media only screen and (max-height: 300px) {
            max-height: 32vh;
            overflow: scroll;

        }

        @media (min-height: 301px) and (max-height: 400px) {
            max-height: 38vh !important;
            overflow: scroll;


        }

        @media (min-height: 401px) and (max-height: 500px) {
            max-height: 48vh !important;
            overflow: scroll;


        }
        @media (min-height: 501px) and (max-height: 600px) {
            max-height: 58vh !important;
            overflow: scroll;


        }


    }
</style>

<template>
    <div class="sidebar w-full min-h-screen float-left z-50 top-0 left-0 bottom-0 sm:flex flex-col justify-between">
        <div class="w-full">
            <div class="h-12 pt-5 flex items-center">
                <Logo class="ml-4"/>
                <span class="ml-3 text-gray-400">Shoot it</span>
            </div>
            <SidebarProfile  class="mt-4"/>

            <div class="nav mt-10">
                <SidebarLink :href="route('dashboard')" icon="fas fa-home" component-name="Dashboard"> Strona główna </SidebarLink>
                <SidebarLink v-if="hasAnyPermission(['view users'])" to="/" icon="fas fa-user" component-name="Users"> Użytkownicy </SidebarLink>

                <SidebarLink :href="route('learning.index')" icon="fas fa-book-reader" component-name="Learning"> Baza wiedzy </SidebarLink>
                <SidebarDropdown icon="fas fa-question">
                    <template v-slot:name>
                        Baza pytań
                    </template>
                    <template v-slot:links>
                        <SidebarLink v-if="hasAnyPermission(['create questions'])" :href="route('question.create')" component-name="Score">Utwórz nowe pytanie</SidebarLink>
                        <SidebarLink :href="route('question.index')" component-name="Score">Wyswietl listę pytań</SidebarLink>
                        <SidebarLink :href="route('categories.questions.index')" component-name="Score">Wyświetl kategorie</SidebarLink>
                    </template>
                </SidebarDropdown>
                <SidebarLink :href="route('exam.index')" icon="fas fa-graduation-cap" component-name="Exams">Egzaminy</SidebarLink>
<!--                <SidebarLink to="/" icon="fas fa-poll" component-name="Score">Moje wyniki</SidebarLink>-->

            </div>
        </div>
    </div>
</template>

<script>
import Logo from '@/Components/ApplicationLogo';
import SidebarLink from "@/Components/SidebarLink";
import SidebarProfile from "@/Components/SidebarProfile";
import SidebarDropdown from "@/Components/SidebarDropdown";

export default {
    components:{
        Logo,
        SidebarLink,
        SidebarProfile,
        SidebarDropdown
    },
    props:{},
    name: "Sidebar"
}
</script>

<style >
    :root{
        --sidebar-bg-color: #28304e;
        --sidebar-item-hover: #262d43;
        --sidebar-item-active: #262d43;
    }
</style>

<style scoped lang="scss">

    .application-logo{
        filter: invert(92%) sepia(32%) saturate(5945%) hue-rotate(177deg) brightness(109%) contrast(103%);
        height: 35px;
    }

    .sidebar{
        height: 100% !important;
        color: white;
        transition: 0.3s ease;
        background-color: var(--sidebar-bg-color);
    }

</style>

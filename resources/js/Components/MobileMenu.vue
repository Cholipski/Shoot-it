<template>
    <div class="h-12 pt-5 mb-10 flex items-center">
        <Logo class="ml-4"/>
        <span class="ml-3 text-gray-400">Shoot it</span>
    </div>

    <SidebarLink :href="route('dashboard')" icon="fas fa-home" component-name="Dashboard"> Strona główna </SidebarLink>
<!--    <SidebarLink v-if="hasAnyPermission(['view users'])" to="/" icon="fas fa-user" component-name="Users"> Użytkownicy </SidebarLink>-->

    <SidebarLink :href="route('learning.index')" icon="fas fa-book-reader" component-name="Learning"> Baza wiedzy </SidebarLink>
    <SidebarDropdown class="text-white" icon="fas fa-question">
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
</template>

<script>
import SidebarLink from "@/Components/SidebarLink";
import SidebarDropdown from "@/Components/SidebarDropdown";
import Logo from '@/Components/ApplicationLogo';

export default {
    name: "MobileMenu",
    components: {
        SidebarLink,
        SidebarDropdown,
        Logo
    }
}
</script>

<style scoped lang="scss">
.application-logo{
    filter: invert(92%) sepia(32%) saturate(5945%) hue-rotate(177deg) brightness(109%) contrast(103%);
    height: 55px;
}
</style>

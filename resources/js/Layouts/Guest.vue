<template>
    <div class="flex w-screen h-screen">
        <div class="w-2/5 flex-col hidden md:flex left-side">
            <div class="h-4/5 flex flex-col gap-16 justify-start items-center mt-8">

            </div>
            <div class="h-1/5 md:justify-end lg:justify-around flex flex-col md:flex-col lg:flex-row md:items-start lg:items-end mb-3 gap-2">
                <Copyright />
                <BottomNavbar />
            </div>
        </div>
        <div class="w-screen md:w-3/5 right-side shadow-2xl">
            <slot />
        </div>
    </div>
</template>

<script>
import {Link} from '@inertiajs/inertia-vue3';
import BottomNavbar from '../Components/GuestLayout/BottomNavbar';
import Copyright from "@/Components/Shared/Copyright";

export default {
    components: {
        Link,
        BottomNavbar,
        Copyright,
    }
}
</script>

<style scoped lang="scss">
    .left-side{
        background-image: url('/assets/bg-main.jpg');
        background-size: cover;
        background-position-x: -230px;
    }
</style>

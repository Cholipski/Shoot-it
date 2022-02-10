<template>
    <div class="flex">
        <div class="left-sidebar hidden md:block">
            <Sidebar />
        </div>
        <div class="w-screen md:w-full bg-base-100 min-h-screen" data-theme="light">
            <div class="w-full">

                <div class="navbar mb-2 shadow-lg bg-base-100 text-gray-400">
                    <div class="flex-none">
                        <button class="btn btn-square btn-ghost">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-6 h-6 stroke-current">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="flex-1 px-2 mx-2">
                    </div>
                    <div class="flex-none">
                        <notifications />
                        <div class="dropdown dropdown-end">
                            <div tabindex="0" class="m-1 mr-4">
                                <svg class="w-7 h-7 stroke-cyan-700" fill="none" stroke="black" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            <ul tabindex="0" class="p-2 shadow menu dropdown-content bg-base-100 rounded-box w-52">
                                <li>
                                    <a>Item 1</a>
                                </li>
                                <li>
                                    <a>Item 2</a>
                                </li>
                                <li>
                                    <Link :href="route('logout')" method="post" as="button" type="button" class="logout flex items-center gap-2">-->
                                        <i class="logout-icon fas fa-sign-out-alt text-gray-600 text-3xl cursor-pointer" />
                                        <span>Wyloguj</span>
                                    </Link>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <slot />
        </div>
    </div>
</template>

<script>
import Logo from '../Components/ApplicationLogo'
import Sidebar from "@/Components/Sidebar";
import { Link } from '@inertiajs/inertia-vue3'
import Notifications from "@/Components/Notifications";

export default {
    components: {
        Logo,
        Sidebar,
        Link,
        Notifications
    },

    data() {
        return {
            search: '',
        }
    }
}
</script>
<style scoped lang='scss'>
    .left-sidebar{
        min-width: 250px;
        max-width: 250px;
    }
</style>

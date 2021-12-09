<template>
    <div class="flex h-screen guest">
        <div class="w-full flex-col shadow-md flex items-center">
            <div class="flex justify-center items-center">
                <ApplicationLogo class="mb-10 mt-10 mr-5 w-20 h-20 fill-current text-gray-500"/>
                <span class="font-sans text-4xl subpixel-antialiased tracking-wider">SHOOT IT</span>
            </div>

            <slot />

        </div>
    </div>
</template>

<script>
import ApplicationLogo from '@/Components/ApplicationLogo.vue'
import {Link} from '@inertiajs/inertia-vue3';

export default {
    components: {
        ApplicationLogo,
        Link,
    }
}
</script>

<style scoped>

.guest {
    background-repeat: no-repeat;
    background-position: bottom;
    background-size: 100% 58%;
    background-image: url("/images/bottom_bg.png");
}

/*Hide in Other Small Devices */




/* Portrait phones and smaller */
@media (max-width: 480px) {

    .guest {
        background-image: none;
    }

}

</style>

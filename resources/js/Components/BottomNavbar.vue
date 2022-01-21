<template>
    <div class="grid grid-cols-3 gap-4 text-white">
        <Link class="transparent-white-5" href="/contact" >O aplikacji</Link>
        <Link class="transparent-white-5" href="/contact" >Kontakt</Link>
        <Link class="transparent-white-5" href="/contact" >FAQ</Link>
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';

export default {
    components: {Link},
    name: "BottomNavbar"
}
</script>

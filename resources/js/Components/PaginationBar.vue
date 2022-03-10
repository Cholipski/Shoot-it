<template>
    <div class="flex flex-col items-center mt-5">
        <span class="text-sm text-gray-700 dark:text-gray-400">
            Wyświetla pytania od <span class="font-semibold text-gray-900">{{ this.data.meta.from }}</span> do <span
            class="font-semibold text-gray-900">{{ this.data.meta.to }}</span>
        </span>

        <div class="btn-group hidden xl:block">
            <Link :href="previous().url" class="btn btn-sm" preserve-scroll> Poprzednia</Link>
            <Link v-for="link in links()" :href="link.url" class="btn btn-sm" preserve-scroll>{{ link.label }}</Link>
            <Link :href="next().url" class="btn btn-sm" preserve-scroll> Następna </Link>
        </div>


        <div class="btn-group block xl:hidden">
            <Link :href="previous().url" class="btn btn-outline btn-wide">Poprzednia</Link>
            <Link :href="next().url" class="btn btn-outline btn-wide">Następna</Link>
        </div>

    </div>

</template>

<script>
import {Link} from "@inertiajs/inertia-vue3";

export default {
    name: "PaginationBar",
    components: {
        Link,
    },
    props: {
        data: {
            type: Object,
            default: () => ({}),
        }
    },
    methods: {
        links: function () {
            return this.data.meta.links.slice(1, this.data.meta.links.length - 1);
        },
        previous: function () {
            return this.data.meta.links[0];
        },
        next: function () {
            return this.data.meta.links[this.data.meta.links.length - 1];
        }
    }
}
</script>

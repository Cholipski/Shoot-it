<template>
    <div class="flex flex-col items-center">
        <!-- Help text -->
        <span class="text-sm text-gray-700 dark:text-gray-400">
      Wyświetla pytania od <span class="font-semibold text-gray-900 dark:text-white">{{ this.data.meta.from }}</span> do <span class="font-semibold text-gray-900 dark:text-white">{{ this.data.meta.to }}</span>
  </span>
        <!-- Buttons -->
        <div class="inline-flex mt-2 xs:mt-0">
            <Link :href="this.data.links.prev" preserve-scroll class="py-2 px-4 text-sm font-medium text-white bg-gray-800 rounded-l hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                Poprzednia
            </Link>
            <Link :href="this.data.links.next" preserve-scroll class="py-2 px-4 text-sm font-medium text-white bg-gray-800 rounded-r border-0 border-l border-gray-700 hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                Następna
            </Link>
        </div>
    </div>

</template>

<script>
import {Link} from "@inertiajs/inertia-vue3";

export default {
    name: "PaginationBar",
    components:{
        Link,
    },
    props: {
        data: {
            type: Object,
            default: () => ({}),
        }
    },
    methods: {
       links: function (){
           return this.data.links.slice(1, this.data.links.length - 1);
       }
    }
}
</script>

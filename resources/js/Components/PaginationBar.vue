<template>
    <div class="justify-center">
                    <Link class="page-link whitespace-nowrap text-lg py-3 px-6 relative block border-0 bg-transparent outline-none transition-all duration-300 rounded-md text-gray-800 hover:text-gray-800 hover:bg-gray-200 focus:shadow-none"
                          :href="this.data.links[0].url">
                        Poprzednia
                    </Link>

                <div class="overflow-x-hidden flex w-1/6">
                    <div class="page-item hidden lg:block" v-for="link in links()" :key="link.label">
                        <Link v-html="link.label"
                              class="page-link whitespace-nowrap text-lg py-3 px-6 relative block border-0 bg-transparent outline-none transition-all duration-300 rounded-md text-gray-800 hover:text-gray-800 hover:bg-gray-200 focus:shadow-none"
                              :href="link.url">
                        </Link>
                    </div>
                </div>

                    <Link class="page-link whitespace-nowrap text-lg py-3 px-6 relative block border-0 bg-transparent outline-none transition-all duration-300 rounded-md text-gray-800 hover:text-gray-800 hover:bg-gray-200 focus:shadow-none"
                          :href="this.data.links[this.data.links.length-1].url">
                        Następna
                    </Link>

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

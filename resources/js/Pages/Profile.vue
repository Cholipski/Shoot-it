<template>
    <div class="flex flex-col">
        <div class="overflow-x-auto">
            <div class="py-4 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="relative w-full">
                    <Breadcrumbs :crumbs="crumbs"/>

                    <div class="avatar">
                        <div class="w-72 rounded-xl">
                            <img src="https://api.lorem.space/image/face?hash=64318">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import Breadcrumbs from "@/Components/Breadcrumbs";

export default {
    name: "Profile",
    components: {
        Breadcrumbs,
    }
}
</script>

<style scoped>

</style>

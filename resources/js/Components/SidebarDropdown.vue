<template>
    <div class="collapse w-full border-base-300 collapse-arrow">
        <input type="checkbox">
        <div class="collapse-title text-xl font-medium">
            <div class="w-8 absolute flex justify-center mr-4 align-baseline">
                <i :class="icon" class="icon text-3xl"></i>
            </div>
            <span class="whitespace-nowrap text-lg font-light pl-12">
                 <slot name="name"/>
            </span>
        </div>
        <div class="collapse-content">
            <slot name="links"/>
        </div>
    </div>
</template>

<script>
export default {
    name: "SidebarDropdown",
    props: {
        icon: {type: String, required: true},
    },
}
</script>

<style scoped>

</style>

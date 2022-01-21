<template>
    <div class="flex items-center">
        <div class="flex w-full bg-white rounded shadow">
            <input class="relative px-6 h-10 py-3 w-full rounded focus:shadow-outline" autocomplete="off" type="text" name="search" placeholder="Szukaj..." />
        </div>
        <button class="ml-3 text-gray-500 hover:text-gray-700 focus:text-indigo-500 text-sm" type="button">Reset</button>
    </div>
</template>

<script>
export default {
    props: {
        modelValue: String,
        maxWidth: {
            type: Number,
            default: 300,
        },
    },
}
</script>

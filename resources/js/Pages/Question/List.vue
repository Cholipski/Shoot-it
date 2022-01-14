<template>
        <span v-for="question in questions"> {{question.value}} </span>
</template>

<script>
export default {
    name: "List",
    props: {
        questions: null,
    }
}
</script>

<style scoped>

</style>

<template>\
    <div class="mt-24">
        {{data.question}}
        <ul>
            <li v-for="answer in data.answers">{{answer.value}}</li>
        </ul>

    </div>
</template>

<script>
export default {
    name: "Show",
    props: ['data'],
    data() {

    }
}
</script>

<style scoped>

</style>

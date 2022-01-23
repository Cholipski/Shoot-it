<template>
    <div class="tooltip">
        <slot />
        <span class="tooltip-text">{{ this.value }}</span>
    </div>
</template>

<script>
export default {
    name: "Tooltip",
    props: {
        value: {
            type: String,
        }
    }
}
</script>

<style scoped lang="scss">
.tooltip {
    position: relative;
    display: inline-block;
    .tooltip-text{
        visibility: hidden;
        width: 100px;
        background-color: black;
        color: #fff;
        text-align: center;
        border-radius: 6px;
        padding: 5px 0;
        position: absolute;
        z-index: 100;
        top: 150%;
        left: 50%;
        margin-left: -60px;
        &:after{
            content: "";
            position: absolute;
            bottom: 100%;
            left: 50%;
            margin-left: -5px;
            border-width: 5px;
            border-style: solid;
            border-color: transparent transparent black transparent;
        }
    }
    &:hover{
        .tooltip-text{
            visibility: visible;

        }
    }
}

</style>

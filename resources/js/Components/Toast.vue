<template>
    <teleport to="body">
        <transition name="slide-fade">
            <div v-if="toast && visible && !popstate"  class="toast w-full md:w-1/3 ">
                <div class="alert bg-neutral flex">
                    <div class="flex-1 items-center">
                        <svg class="w-6 h-6" fill="none" stroke="green" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <label class="ml-3">
                            <p class="text-sm text-base-content text-opacity-60">
                                {{ toast }}
                            </p>
                        </label>
                    </div>
                    <div class="flex-none btn-close">
                        <button class="btn btn-sm btn-ghost btn-square" v-on:click="this.visible = false">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                </div>
            </div>

        </transition>

    </teleport>
</template>

<script>

export default {
    name: "Toast",
    props: {
        toast: Object,
        popstate: Boolean,
    },
    data(){
        return{
            visible: false,
            timeout: null,
        }
    },
    watch: {
        toast: {
            deep: true,
            handler() {
                this.visible = true;

                if(this.timeout){
                    clearTimeout(this.timeout);
                }
                this.timeout = setTimeout(()=> this.visible = false,6000)
            }
        }
    }
}
</script>

<style scoped lang="scss">
    .btn-close{
        margin: 0 !important;
    }
    .slide-fade-enter-active {
        transition: all 0.3s ease-out;
    }

    .slide-fade-leave-active {
        transition: all 0.4s cubic-bezier(1, 0.5, 0.8, 1);
    }

    .slide-fade-enter-from,
    .slide-fade-leave-to {
        transform: translateX(20px);
        opacity: 0;
    }
    .toast{
        position: fixed;
        right: 20px;
        bottom: 10px;
        background: white;
        .icon{
            width: 30px;
            height: 30px;
            color: green;
        }
    }
    @media screen and (max-width: 768px) {
        .alert{
            flex-direction: row;
        }
        .toast{
            position: fixed;
            bottom: 10px;
            right: 0;
            background: none;
            .icon{
                width: 30px;
                height: 30px;
                color: green;
            }
        }
    }
</style>

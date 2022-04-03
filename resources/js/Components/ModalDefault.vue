<template>
    <div v-on:click="this.isOpen=true">
        <slot name="ButtonOpen" />
    </div>
    <teleport to="body">
        <div v-if="this.isOpen" id="defaultModal" aria-hidden="true" class="overflow-y-auto overflow-x-hidden flex fixed right-0 left-0 top-4 z-50 justify-items-center items-center h-modal h-full md:inset-0">
            <div class="relative px-4 w-full h-auto flex justify-center">
                <div class="relative w-5/6 md:w-1/3 bg-white rounded-lg shadow dark:bg-gray-700">
                    <div class="flex justify-between items-start p-5 rounded-t border-b dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 lg:text-2xl dark:text-white">
                            <slot name="header" />
                        </h3>
                        <button type="button" v-on:click="this.isOpen = false" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="defaultModal">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </button>
                    </div>
                    <div class="p-6 space-y-6">
                        <slot name="main" />
                    </div>
                </div>
            </div>
        </div>
    </teleport>
</template>

<script>
export default {
    name: "ModalDefault",
    data(){
        return {
            isOpen: false,
        }
    }
}
</script>

<style scoped lang="scss">
    #defaultModal{
        background: rgba(0,0,0,0.4);
    }
</style>

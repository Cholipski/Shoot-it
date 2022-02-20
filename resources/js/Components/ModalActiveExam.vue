<template>
    <teleport to="body" >
        <a href="#active-exam" id="active-exam-button" class="btn hidden">open modal</a>

        <div class="modal" id="active-exam" data-theme="light">
            <div class="modal-box">
                <h3 class="font-bold text-black text-lg">Egzamin w trakcie</h3>
                <p class="py-4 text-black">Wygląda na to że jeden egzamin jest jeszcze aktywny, chciałbyś do niego powrócić ?</p>
                <div class="modal-action">
                    <a href="#" class="btn">TAK</a>
                    <a href="#" class="btn">NIE</a>

                </div>
            </div>
        </div>
    </teleport>
</template>

<script>
export default {
    name: "ModalActiveExam"
}
</script>

<style scoped>

</style>

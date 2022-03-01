<template>
    <teleport to="body" >
        <a href="#active-exam" id="active-exam-button" class="btn hidden">open modal</a>

        <div class="modal" id="active-exam" data-theme="light">
            <div class="modal-box">
                <h3 class="font-bold text-black text-lg">Egzamin w trakcie</h3>
                <p class="py-4 text-black">Wygląda na to że jeden egzamin jest jeszcze aktywny, chciałbyś do niego powrócić ?</p>
                <div class="flex flex-col justify-center gap-2">
                    <a href="#" class="btn">Powróć do egzaminu</a>
                    <a href="#" class="btn">Zakończ egzamin i rozpocznij nowy</a>
                    <a href="#" class="btn">Anuluj</a>

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

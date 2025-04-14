<template>
    <div class="deletecontainer" v-if="deleteVisible">
        <div class="deletepadding">
            <div class="d-flex justify-content-end">
                <div class="bg-circle" @click="closeModal" >
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><!-- Icon from Solar by 480 Design - https://creativecommons.org/licenses/by/4.0/ --><path fill="currentColor" fill-rule="evenodd" d="M12 22c-4.714 0-7.071 0-8.536-1.465C2 19.072 2 16.714 2 12s0-7.071 1.464-8.536C4.93 2 7.286 2 12 2s7.071 0 8.535 1.464C22 4.93 22 7.286 22 12s0 7.071-1.465 8.535C19.072 22 16.714 22 12 22M8.97 8.97a.75.75 0 0 1 1.06 0L12 10.94l1.97-1.97a.75.75 0 0 1 1.06 1.06L13.06 12l1.97 1.97a.75.75 0 1 1-1.06 1.06L12 13.06l-1.97 1.97a.75.75 0 1 1-1.06-1.06L10.94 12l-1.97-1.97a.75.75 0 0 1 0-1.06" clip-rule="evenodd"/></svg>                </div>
            </div>
          <div class="text-center">
            <div class="text-center d-flex justify-content-center mb-5">
                <svg xmlns="http://www.w3.org/2000/svg" class="fs-1"  width="100" height="100" viewBox="0 0 24 24"><!-- Icon from Solar by 480 Design - https://creativecommons.org/licenses/by/4.0/ --><path fill="currentColor" d="M3 6.524c0-.395.327-.714.73-.714h4.788c.006-.842.098-1.995.932-2.793A3.68 3.68 0 0 1 12 2a3.68 3.68 0 0 1 2.55 1.017c.834.798.926 1.951.932 2.793h4.788c.403 0 .73.32.73.714a.72.72 0 0 1-.73.714H3.73A.72.72 0 0 1 3 6.524"/><path fill="currentColor" fill-rule="evenodd" d="M11.596 22h.808c2.783 0 4.174 0 5.08-.886c.904-.886.996-2.34 1.181-5.246l.267-4.187c.1-1.577.15-2.366-.303-2.866c-.454-.5-1.22-.5-2.753-.5H8.124c-1.533 0-2.3 0-2.753.5s-.404 1.289-.303 2.866l.267 4.188c.185 2.906.277 4.36 1.182 5.245c.905.886 2.296.886 5.079.886m-1.35-9.811c-.04-.434-.408-.75-.82-.707c-.413.043-.713.43-.672.864l.5 5.263c.04.434.408.75.82.707c.413-.044.713-.43.672-.864zm4.329-.707c.412.043.713.43.671.864l-.5 5.263c-.04.434-.409.75-.82.707c-.413-.044-.713-.43-.672-.864l.5-5.264c.04-.433.409-.75.82-.707" clip-rule="evenodd"/></svg>
              </div>

            <input type="text" v-model="identifier.targetitem" class="d-none">
            <h1>Are you sure ?</h1>
            <h6 class="mb-4">Deleting this product is permanent</h6>

            <button 
              :class="[deleteloading ? 'loading btn btn bg-button-submit cursor-not-allowed' : 'btn bg-button-submit ']"
              @click="deleteState" >
              <span v-if="deleteloading" class="flex items-center">
                <svg class="animate-spin h-5 w-5 mr-2 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor"
                    d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z">
                  </path>
                </svg>
                Loading...
              </span>
              <span v-else>Delete Now</span>
            </button>
          </div>
        </div>
    </div>
</template>

<script>
 export default {
    setup(_, { emit }) {
        const deleteState = () => {
            emit('deletesubmit');
        };
        const closeModal = () => {
            emit('close');
        }
        return {
            deleteState,
            closeModal,
        };
    },
    props: {
        deleteVisible: Boolean,
        deleteloading: Boolean,
        identifier: Object,
    },
 }
</script>

<style scoped>
/* Add a 'loading' class to apply spinner or other loading styles */
.loading {
    background: #f0f0f0;
    cursor: not-allowed;
}
</style>

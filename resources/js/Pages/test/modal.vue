<template>
<p>Vue + Bootstrap + Typescript + FontAwesome (and Console.js)</p>
  <p>Bootstrap message: {{message}}</p>
  <button type="button" class="btn btn-primary" @click="showModal=true">
    Launch demo modal
  </button>
  <transition name="modal-fade">
    <div v-if="showModal">
      <div class="modal-mask">
        <div class="modal-wrapper">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"  @click="showModal = false">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <input type="text" class="form-control-plaintext" placeholder="Type text here...">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" @click="showModal = false">Close</button>
                <button type="button" class="btn btn-primary" @click="showModal = false">Save changes</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </transition>
</template>

<script>
export default {
    data() {
        return {
            message: "Vue is working",
            showModal: false,
        };
    },
};
</script>

<style scoped>
modal-enter-active,
  .modal-fade-enter,
  .modal-fade-leave-to {
    opacity: 0;
  }

  .modal-fade-enter-active,
  .modal-fade-leave-active {
    transition: opacity .5s all ease;
  }
</style>

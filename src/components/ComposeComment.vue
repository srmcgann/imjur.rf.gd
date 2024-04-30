<template>
  <button
    v-if="!this.state.uploadInProgress"
    @click="state.closePrompts()"
    class="cancelButton"
    title="close this view [ESC]"
  >
    close/cancel
  </button>
  <div class="composeComment" ref="composeComment" tabindex="1000">
    <input
      v-modal="state.newComment"
      type="text"
      maxlength="1024"
      class="commentInput"
      placeholder="enter your comment..."
    >
    <button
      @click.stop.prevent="submit()"
    >
      submit
    </button>
  </div>
</template>

<script>
export default {
  name: 'ComposeComment',
  props: [ 'state' ],
  methods: {
    submit(){
      console.log('faux submitting...', this.state.newComment)
    }
  },
  mounted(){
    this.$refs.modal.focus()
  }
}
</script>

<style scoped>
  .composeComment{
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1000;
    width: 100vw;
    height: 100vh;
    font-size: 14px;
  }
  .commentInput{
  }
</style>

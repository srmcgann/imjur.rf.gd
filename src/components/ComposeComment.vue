<template>
  <div class="modalInner">
    <button
      v-if="!this.state.uploadInProgress"
      @click="state.closePrompts()"
      class="cancelButton"
      title="close this view [ESC]"
    >
      close/cancel
    </button>
    <div class="composeComment" ref="composeComment" tabindex="1000">
      <Link
        :state="state"
        :link="state.composeCommentLink"
        :omitAssetData="true"
      /><br>
      <input
        v-model="state.newComment"
        type="text"
        ref="commentInput"
        maxlength="1024"
        class="commentInput"
        placeholder="enter your comment..."
      ><br><br>
      <button
        @click.stop.prevent="submit()"
      >
        post comment
      </button>
    </div>
  </div>
</template>

<script>
import Link from './Link'

export default {
  name: 'ComposeComment',
  props: [ 'state' ],
  components:{
    Link
  },
  methods: {
    submit(){
      console.log('faux submitting...', this.state.newComment)
    }
  },
  mounted(){
    this.$refs.commentInput.focus()
  }
}
</script>

<style scoped>
  .composeComment{
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 1000;
    font-size: 14px;
  }
  .commentInput{
    border: 1px solid #40f;
  }
</style>

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
        @keydown.enter="submit()"
        v-model="state.newComment"
        type="text"
        ref="commentInput"
        maxlength="1024"
        class="commentInput"
        placeholder="enter your comment..."
      ><br><br>
      <button
        @click.stop.prevent="submit()"
        class="submitCommentButton"
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
      this.state.newComment = ''
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
    width: 600px;
    background: #102;
    font-size: 16px;
  }
  .submitCommentButton{
    background: #0f8;
    border-radius: 25px;
  }
</style>

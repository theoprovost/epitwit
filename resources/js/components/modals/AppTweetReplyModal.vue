<template>
  <div>
    <component
      v-if="tweet"
      :is="`app-tweet-variant-${tweet.type}`"
      :tweet="tweet"
      class="mb-4"
    />

    <app-tweet-reply-compose
      v-if="tweet"
      :tweet="tweet"
      @success="$emit('close')"
    />
  </div>
</template>

<script>
import AppTweet from "../tweets/AppTweet.vue";
export default {
  components: { AppTweet },
  props: {
    tweet: {
      required: true,
      type: Object,
    },
  },
};
</script>
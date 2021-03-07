<template>
  <div>
    <app-tweet-retweet-compose :tweet="tweet" @success="$emit('close')" />

    <component
      v-if="tweet"
      class="border border-gray-700 rounded-lg mt-4 p-4 hover:bg-gray-800"
      :is="`app-tweet-variant-${tweet.type}`"
      :tweet="tweet"
      :inReply="true"
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

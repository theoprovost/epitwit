<template>
  <div class="flex w-full cursor-pointer" @click.stop.prevent="trigger">
    <div class="mr-3">
      <img :src="tweet.user.avatar" alt=" " class="w-12 rounded-full" />
    </div>

    <div class="flex-grow">
      <app-tweet-username :user="tweet.user" :created_at="tweet.creation_date"/>

      <p class="text-gray-300 whitespace-pre-wrap">{{ tweet.body }}</p>

      <app-tweet-variant-tweet
        :tweet="tweet.original_tweet"
        class="border border-gray-700 rounded-lg mt-4 p-4"
      />

      <app-tweet-action-group :tweet="tweet" />
    </div>
  </div>
</template>

<script>
import AppTweetVariantTweet from "./AppTweetVariantTweet.vue";
export default {
  components: { AppTweetVariantTweet },
  props: {
    tweet: {
      required: true,
      type: Object,
    },
  },

    methods: {
  trigger () {
        window.location.pathname = "./tweets/" + this.tweet.id;
    },
    }
};
</script>

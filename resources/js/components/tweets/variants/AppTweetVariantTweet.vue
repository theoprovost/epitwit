<template>
  <div class="flex w-full">
    <img :src="tweet.user.avatar" alt=" " class="w-12 h-12 mr-3 rounded-full" />
    <div class="flex-grow">
      <app-tweet-username :user="tweet.user" />

      <p class="text-gray-300 whitespace-pre-wrap">{{ tweet.body }}</p>

      <div class="flex flex-wrap mb-4 mt-4" v-if="images.length">
        <div
          class="w-6/12 flex-grow"
          v-for="(image, index) in images"
          :key="index"
        >
          <img :src="image.url" alt=" " class="rounded-lg bg-gray-600" />
        </div>
      </div>

      <app-tweet-action-group :tweet="tweet" />
    </div>
  </div>
</template>

<script>
import AppTweet from "../AppTweet.vue";
export default {
  components: { AppTweet },
  props: {
    tweet: {
      required: true,
      type: Object,
    },
  },

  computed: {
    images() {
      return this.tweet.media.data.filter((m) => m.type === "image");
    },
  },
};
</script>

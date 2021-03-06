<template>
  <div class="flex w-full cursor-pointer" @click.prevent="trigger">
    <img :src="tweet.user.avatar" alt=" " class="w-12 h-12 mr-3 rounded-full" />
    <div class="flex-grow">
      <app-tweet-username :user="tweet.user" />

      <div v-if="tweet.replying_to" class="text-gray-600 mb-2">
        Replying to <a href="">@{{ tweet.replying_to }}</a>
      </div>

      <app-tweet-body v-if="tweet.body" :tweet="tweet" />

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

   methods: {
  	trigger () {
        window.location.pathname = "./tweets/" + this.tweet.id;
    }
  }
};
</script>

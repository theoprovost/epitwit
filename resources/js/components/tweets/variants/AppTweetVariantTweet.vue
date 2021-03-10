<template>
  <div class="flex w-full cursor-pointer" @click.stop.prevent="triggerTweet">
    <img :src="tweet.user.avatar" alt=" " class="w-12 h-12 mr-3 rounded-full" />
    <div class="flex-grow">
      <app-tweet-username :user="tweet.user" :tweet="tweet" :created_at="tweet.creation_date" :inReply="inReply"/>

      <div v-if="tweet.replying_to" class="text-gray-600 mb-2">
        Replying to <a href="" class="hover:underline cursor-pointer" @click.stop.prevent="triggerUser">@{{ tweet.replying_to }}</a>
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

      <app-tweet-action-group :tweet="tweet" :inReply="inReply" v-if="!inReply"/>
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
    inReply: {
      required: false,
      type: Boolean,
    },
  },

  computed: {
    images() {
      return this.tweet.media.data.filter((m) => m.type === "image");
    },
  },

   methods: {
  	triggerTweet () {
        window.location.pathname = "./tweets/" + this.tweet.id;
    },
    triggerUser () {
        window.location.pathname = "./" + this.tweet.replying_to;
    },
  }
};
</script>

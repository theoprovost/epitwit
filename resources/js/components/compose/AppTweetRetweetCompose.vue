<template>
  <form class="flex" @submit.stop.prevent="submit">
    <img :src="$user.avatar" alt=" " class="mr-2 w-12 h-12 rounded-full" />

    <div class="flex-grow">
      <app-tweet-compose-textarea
        v-model="form.body"
        placeholder="Add a comment"
      />

      <!-- <app-tweet-image-preview
        :images="media.images"
        v-if="media.images.length"
        @removed="removeImage"
      />

      <app-tweet-video-preview
        :video="media.video"
        v-if="media.video"
        @removed="removeVideo"
      /> -->

      <div class="flex justify-end">
        <!-- <ul class="flex items-center">
          <li class="mr-4">
            <app-tweet-compose-media-button
              id="media-compose"
              @selected="handleMediaSlected"
            />
          </li>
        </ul> -->

        <!-- <app-tweet-media-progress
          :progress="media.progress"
          v-if="media.progress"
        /> -->

        <div class="flex items-center justify-end">
          <app-tweet-compose-limit :body="form.body" />

          <button
            type="submit"
            class="bg-blue-500 rounded-full text-gray-300 text-center px-4 py-3 font-bold leading-none"
          >
            Retweet
          </button>
        </div>
      </div>
    </div>
  </form>
</template>

<script>
import compose from "../../mixins/compose";
import { mapActions } from "vuex";

export default {
  mixins: [compose],
  props: {
    tweet: {
      required: true,
      type: Object,
    },
  },
  methods: {
    ...mapActions({
      quoteTweet: "timeline/quoteTweet",
    }),

    async post() {
      await this.quoteTweet({
        tweet: this.tweet,
        data: this.form,
      });

      this.$emit('success');
    },
  },
};
</script>

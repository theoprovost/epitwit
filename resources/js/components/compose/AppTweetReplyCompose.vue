<template>
  <form class="flex" @submit.prevent="submit">
    <img :src="$user.avatar" alt=" " class="mr-2 w-12 h-12 rounded-full" />

    <div class="flex-grow">
      <app-tweet-compose-textarea
        v-model="form.body"
        placeholder="Tweet your reply"
      />

      <app-tweet-image-preview
        :images="media.images"
        v-if="media.images.length"
        @removed="removeImage"
      />

      <app-tweet-video-preview
        :video="media.video"
        v-if="media.video"
        @removed="removeVideo"
      />

      <div class="flex justify-between items-center">
        <ul class="flex items-center">
          <li class="mr-4">
            <app-tweet-compose-media-button
              id="media-compose-reply"
              @selected="handleMediaSlected"
            />
          </li>
        </ul>

        <app-tweet-media-progress
          :progress="media.progress"
          v-if="media.progress"
        />

        <div class="flex items-center justify-end">
          <app-tweet-compose-limit :body="form.body" />

          <button
            type="submit"
            class="bg-blue-500 rounded-full text-gray-300 text-center px-4 py-3 font-bold leading-none"
          >
            Reply
          </button>
        </div>
      </div>
    </div>
  </form>
</template>

<script>
import compose from "../../mixins/compose";
import { mapActions } from "vuex";
import axios from "axios";

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
      replyTweet: "timeline/replyTweet",
    }),

    async post() {
      await this.replyTweet({
        tweet: this.tweet,
        data: this.form,
      });

      this.$emit("success");
    },
  },
};
</script>

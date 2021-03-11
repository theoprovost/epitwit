<template>
  <div class="flex">
    <div
      class="flex items-center text-base text-gray-600 hover:text-red-600 pr-2"
      @click.stop.prevent="likeOrUnlike"
    >
      <div class="pr-1">
        <div class="p-2 rounded-full hover:bg-gray-700">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24"
            width="24"
            height="24"
            class="fill-current w-5"
            :class="{
              'text-red-600': liked,
              'fill-current': liked,
            }"
          >
            <path
              v-if="!liked"
              d="M12.76 3.76a6 6 0 0 1 8.48 8.48l-8.53 8.54a1 1 0 0 1-1.42 0l-8.53-8.54a6 6 0 0 1 8.48-8.48l.76.75.76-.75zm7.07 7.07a4 4 0 1 0-5.66-5.66l-1.46 1.47a1 1 0 0 1-1.42 0L9.83 5.17a4 4 0 1 0-5.66 5.66L12 18.66l7.83-7.83z"
            />
            <path
              v-else
              d="M12 21.638h-.014C9.403 21.59 1.95 14.856 1.95
            8.478c0-3.064 2.525-5.754 5.403-5.754 2.29 0 3.83 1.58 4.646
            2.73.814-1.148 2.354-2.73 4.645-2.73 2.88 0 5.404 2.69 5.404 5.755 0
            6.376-7.454 13.11-10.037 13.157H12z"
            />
          </svg>
        </div>
      </div>
      <span
        :class="{
          'text-red-600': liked,
        }"
      >
        {{ tweet.likes_count }}
      </span>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
  props: {
    tweet: {
      required: true,
      type: Object,
    },
  },
  data() {
    return {
      color: "red",
    };
  },

  computed: {
    ...mapGetters({
      likes: "likes/likes",
    }),

    liked() {
      return this.likes.includes(this.tweet.id);
    },
  },

  methods: {
    ...mapActions({
      likeTweet: "likes/likeTweet",
      unlikeTweet: "likes/unlikeTweet",
    }),

    likeOrUnlike() {
      if (this.liked) {
        this.unlikeTweet(this.tweet);
        return;
      }

      this.likeTweet(this.tweet);
    },
  },
};
</script>

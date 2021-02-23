<template>
  <div class="p-4 flex-grow">
    <app-tweet v-if="resolvedTweet" :tweet="resolvedTweet" class="!border-0" />
  </div>
</template>

<script>
import AppTimeline from "../../timeline/AppTimeline.vue";
import { mapGetters, mapActions } from "vuex";

export default {
  components: { AppTimeline },

  props: {
    notification: {
      required: true,
      type: Object,
    },
  },

  computed: {
    ...mapGetters({
      tweet: "notifications/tweet",
    }),

    resolvedTweet() {
      return this.tweet(this.notification.data.tweet.id);
    },
  },
};
</script>
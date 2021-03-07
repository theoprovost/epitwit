<template>
  <div class="p-4 flex-grow hover:bg-gray-800 cursor-pointer" @click.stop.prevent="trigger">
    <div class="text-gray-300 mb-4">
      <app-tweet-username :user="notification.data.user" :created_at="notification.creation_date" /> liked your tweet.
    </div>

    <p class="text-gray-600">
      {{ notification.data.tweet.body }}
    </p>
  </div>
</template>

<script>
import AppTimeline from "../../timeline/AppTimeline.vue";
export default {
  components: { AppTimeline },
  props: {
    notification: {
      required: true,
      type: Object,
    },
  },
  methods: {
      trigger () {
          window.location.pathname = "tweets/" + this.notification.data.tweet.id;
      }
  }
};
</script>

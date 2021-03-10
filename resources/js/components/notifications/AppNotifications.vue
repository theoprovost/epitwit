<template>
  <div>
    <app-notification
      v-for="notification in notifications"
      :key="notification.id"
      :notification="notification"
    />

    <div
      v-if="notifications.length"
      v-observe-visibility="{
        callback: handleScrolledToBottomNotifications,
      }"
    ></div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import AppTweet from "../tweets/AppTweet.vue";

export default {
  components: { AppTweet },
  data() {
    return {
      page: 1,
      lastPage: 1,
    };
  },

  computed: {
    ...mapGetters({
      notifications: "notifications/notifications",
    }),

    urlWithPage() {
      return `/api/notifications?page=${this.page}`;
    },
  },

  methods: {
    ...mapActions({
      getNotifications: "notifications/getNotifications",
    }),

    loadNotifications() {
      this.getNotifications(this.urlWithPage).then((res) => {
        this.lastPage = res.data.meta.last_page; // coming from laravel pagination
      });
    },

    handleScrolledToBottomNotifications(isVisible) {
      if (!isVisible) {
        return;
      }

      if (this.lastPage === this.page) {
        return;
      }

      this.page++;
      this.loadNotifications();
    },
  },

  mounted() {
    this.loadNotifications();
  },
};
</script>

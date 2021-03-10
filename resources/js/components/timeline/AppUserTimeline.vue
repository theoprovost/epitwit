<template>
  <div>
    <app-tweet v-for="tweet in tweets" :key="tweet.id" :tweet="tweet" />

    <div
      v-if="tweets.length"
      v-observe-visibility="{
        callback: handleScrolledToBottomOfTimeline,
      }"
    ></div>
  </div>
</template>

<script>
import { mapActions, mapGetters, mapMutations } from "vuex";
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
      tweets: "timeline/tweets",
    }),

    urlWithPage() {
        let username=window.location.pathname.split('/');
      return `/api/timeline/${username[1]}?page=${this.page}`;
    },
  },

  methods: {
    ...mapActions({
      getTweets: "timeline/getTweets",
    }),

    ...mapMutations({
      PUSH_TWEETS: "timeline/PUSH_TWEETS",
    }),

    loadTweets() {
      this.getTweets(this.urlWithPage).then((res) => {
        this.lastPage = res.data.meta.last_page; // coming from laravel pagination
      });
    },

    handleScrolledToBottomOfTimeline(isVisible) {
      if (!isVisible) {
        return;
      }

      if (this.lastPage === this.page) {
        return;
      }

      this.page++;
      this.loadTweets();
    },
  },

  mounted() {
    this.loadTweets();

    Echo.private(`timeline.${this.$user.id}`).listen(
      ".TweetWasCreated",
      (e) => {
        this.PUSH_TWEETS([e]);
      }
    );
  },
};
</script>

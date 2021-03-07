<template>
  <div>
    <app-dropdown>
      <template slot="trigger">
        <app-tweet-retweet-action-button :tweet="tweet" />
      </template>

      <app-dropdown-item v-if="!retweeted" @click.stop.prevent="retweetOrUnretweet">
        Retweet
      </app-dropdown-item>
      <app-dropdown-item v-else @click.stop.prevent="retweetOrUnretweet">
        Undo retweet
      </app-dropdown-item>
      <app-dropdown-item
        @click.stop.prevent="
          $modal.show(AppTweetRetweetModal, {
            tweet,
          })
        "
      >
        Retweet with comment
      </app-dropdown-item>
    </app-dropdown>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import AppTweetRetweetModal from "../../modals/AppTweetRetweetModal";

export default {
  props: {
    tweet: {
      required: true,
      type: Object,
    },
  },

  data() {
    return {
      AppTweetRetweetModal,
    };
  },

  computed: {
    ...mapGetters({
      retweets: "retweets/retweets",
    }),

    retweeted() {
      return this.retweets.includes(this.tweet.id);
    },
  },

  methods: {
    ...mapActions({
      retweetTweet: "retweets/retweetTweet",
      unretweetTweet: "retweets/unretweetTweet",
    }),

    retweetOrUnretweet() {
      if (this.retweeted) {
        this.unretweetTweet(this.tweet);
        return;
      }

      this.retweetTweet(this.tweet);
    },
  },
};
</script>

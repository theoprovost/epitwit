<template>
  <div>
    <div>
    </div>
    <div class="text-lg border-b-8 border-t-8 border-gray-800">
      <app-tweet v-if="tweets(id)" :tweet="tweets(id)" />
    </div>

    <div>
      <app-tweet v-for="t in replies(id)" :tweet="t" :key="t.id" />
    </div>
  </div>
</template>

<script>
import { mapActions, mapGetters, mapMutations } from "vuex";

export default {
  props: {
    id: {
      required: true,
      type: String,
    },
  },

  computed: {
    ...mapGetters({
      tweets: "conversation/tweets",
      parents: "conversation/parents",
      replies: "conversation/replies",
    }),
  },


  methods: {
    ...mapActions({
      getTweets: "conversation/getTweets",
    }),
    ...mapMutations({
      PUSH_TWEETS: "timeline/PUSH_TWEETS",
    }),
  },

  mounted() {
    this.getTweets(`/api/tweets/${this.id}`);
    this.getTweets(`/api/tweets/${this.id}/replies`);

    Echo.channel(`tweets.${this.id}`)
        .listen('.ReplyWasCreated', (e) => {
            this.getTweets(`/api/tweets/${this.id}/replies`);
        })
  },
};
</script>

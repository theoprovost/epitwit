<template>
     <div>
    <app-dropdown>
      <template slot="trigger">
        <app-tweet-option-action-button />
      </template>

      <app-dropdown-item @click.stop.prevent="deleteTweet">
        Delete tweet
      </app-dropdown-item>
    </app-dropdown>
  </div>
</template>

<script>
import {mapActions} from 'vuex'
export default {
    props: {
        tweet: {
            required: true,
            type: Object,
        }
    },
    methods: {
        ...mapActions({
            deleteTweet: "timeline/deleteTweet",
        }),

        async deleteTweet() {
            await axios.delete(`/api/tweets/${this.tweet.id}`);
            if (window.location.pathname == `/tweets/${this.tweet.id}`)
                window.location.pathname = this.tweet.user.username;
        }
    },
}
</script>

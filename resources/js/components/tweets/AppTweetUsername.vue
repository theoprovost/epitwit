<template>
  <div class="flex justify-between">
    <div>
      <span
        class="text-gray-200 font-bold hover:underline cursor-pointer"
        @click.stop.prevent="trigger"
        >{{ user.name }}</span
      >
      <span class="text-gray-500 font-normal ml-2">@{{ user.username }}</span>
    </div>
    <div class="flex items-center justify-around -mt-1">
      <div>
        <span class="text-gray-500 font-normal ml-2">{{ created_at }}</span>
      </div>
      <app-tweet-option-action
        :tweet="tweet"
        v-if="tweet.user.id == auth && !inReply"
      />
    </div>
  </div>
</template>

<script>
export default {
  props: {
    user: {
      required: true,
      type: Object,
    },
    tweet: {
      required: true,
      type: Object,
    },
    inReply: {
      required: false,
      type: Boolean,
    },
    created_at: {
      required: false,
    },
  },

  data() {
    return {
      auth: "",
    };
  },

  methods: {
    trigger() {
      window.location.pathname = "./" + this.user.username;
    },
  },
  mounted() {
    Vue.set(this, "auth", window.User.id);
  },
};
</script>

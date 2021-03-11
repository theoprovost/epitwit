<template>
  <a
    href="#"
    @click.stop.prevent="trigger"
    class="hover:underline cursor-pointer"
    >{{ body }}</a
  >
</template>

<script>
export default {
  props: {
    body: {
      required: true,
      type: String,
    },
  },

  methods: {
    trigger() {
      window.location.pathname = `/hashtags/${this.body.replace("#", "")}`;
    },
  },
};
</script>
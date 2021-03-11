<template>
  <a href="" class="hover:underline" @click.stop.prevent="trigger">
    {{ body }}</a
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
      window.location.pathname = this.body.replace("@", "");
    },
  },
};
</script>

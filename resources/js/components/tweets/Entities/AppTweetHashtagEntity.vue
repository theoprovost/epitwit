<template>
  <a :href="`/hashtags/${body.replace('#', '')}}`">{{ body }}</a>
</template>

<script>
export default {
  props: {
    body: {
      required: true,
      type: String,
    },
  },
};
</script>
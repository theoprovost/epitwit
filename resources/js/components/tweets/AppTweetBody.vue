<template>
  <p class="text-gray-300 whitespace-pre-wrap c-break">
    <component :is="body" />
  </p>
</template>

<script>
export default {
  props: {
    tweet: {
      required: true,
      type: Object,
    },
  },

  computed: {
    body() {
      return {
        template: `<div>${this.replaceEntities(this.tweet.body)}</div>`,
      };
    },

    entities() {
      return this.tweet.entities.data.sort((a, b) => b.start - b.start);
    },
  },

  methods: {
    replaceEntities(body) {
      this.entities.forEach((entity) => {
        body =
          body.substring(0, entity.start) +
          this.entityComponent(entity) +
          body.substring(entity.end); // <=> body.substring(e.end, body.lenght)
      });

      return body;
    },

    entityComponent(entity) {
      return `<app-tweet-${entity.type}-entity body=${entity.body} />`;
    },
  },
};
</script>

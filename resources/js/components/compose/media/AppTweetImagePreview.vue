<template>
  <div class="flex flex-wrap mb-4">
    <div v-for="image in images" class="w-6/12 flex-grow relative">
      <img
        :src="generateImagePreview(image)"
        :alt="image.name"
        class="bg-gray-300 rounded-lg"
      />
    </div>
  </div>
</template>

<script>
export default {
  props: {
    images: {
      required: false,
      type: Array,
    },
  },

  methods: {
    generateImagePreview(image) {
      return URL.createObjectURL(image);
    },
  },
};
</script>
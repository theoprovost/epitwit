<template>
  <div class="w-full mr-10 ml-10 h-1 bg-gray-800">
    <div class="h-1 bg-blue-500" :style="`width: ${progress}%`"></div>
  </div>
</template>

<script>
export default {
  props: {
    progress: {
      required: true,
      type: Number,
    },
  },
};
</script>
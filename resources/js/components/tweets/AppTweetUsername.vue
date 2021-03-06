<template>
<div>
    <span class="text-gray-300 font-bold hover:underline cursor-pointer">{{ user.name }}</span>
    <span class="text-gray-600 font-normal ml-2">@{{ user.username }}</span>
</div>
</template>

<script>
export default {
  props: {
    user: {
      required: true,
      type: Object,
    },
  },
};
</script>

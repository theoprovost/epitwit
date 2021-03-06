<template>
    <button type="buton"
        @click.prevent="$modal.show(AppEditProfileModal, {user})"
        class="bg-blue-500 rounded-full text-gray-300 text-center px-4 py-3 font-bold leading-none"
    >
        Edit profile
    </button>
</template>

<script>
import AppEditProfileModal from "../modals/AppEditProfileModal";
export default {
    data() {
    return {
      AppEditProfileModal,
    };
  },
  props: {
    user: {
      required: true,
      type: Object,
    },
  }

}
</script>

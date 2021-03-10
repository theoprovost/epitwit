<template>
    <button type="buton"
        @click.prevent="$modal.show(AppEditProfileModal, {user})"
       class="border border-blue-500 text-blue-500 hover:bg-blue-500 hover:text-gray-300 rounded-full text-center px-4 py-3 font-bold leading-none focus:outline-none"
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

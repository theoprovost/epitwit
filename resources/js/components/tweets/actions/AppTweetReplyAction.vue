<template>
<div class="flex">
    <div
        class="flex items-center text-base text-gray-600 hover:text-blue-600 pr-2 cursor-pointer"
        @click.prevent="$modal.show(AppTweetReplyModal, { tweet })"
    >
        <div class="pr-1">
            <div class="p-2 rounded-full hover:bg-gray-700">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 24 24"
                  width="24"
                  height="24"
                  class="fill-current w-5"
                >
                  <path d="M2 15V5c0-1.1.9-2 2-2h16a2 2 0 0 1 2 2v15a1 1 0 0 1-1.7.7L16.58 17H4a2 2 0 0 1-2-2zM20 5H4v10h13a1 1 0 0 1 .7.3l2.3 2.29V5z"/>
                </svg>
            </div>
        </div>
    <span>{{ tweet.replies_count }}</span>
    </div>
</div>
</template>

<script>
import AppTweetReplyModal from "../../modals/AppTweetReplyModal";

export default {
  props: {
    tweet: {
      require: true,
      type: Object,
    },
  },

  data() {
    return {
      AppTweetReplyModal,
    };
  },
};
</script>

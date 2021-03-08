<template>
    <div class="flex w-full cursor-pointer justify-between">
        <div class="flex">
            <img :src="follower.avatar" alt=" " class="w-12 h-12 mr-3 rounded-full" />
            <div class="flex-grow">
                <span class="text-gray-200 font-bold hover:underline cursor-pointer block">{{ follower.name }}</span>
                <span class="text-gray-500 font-normal block">@{{ follower.username }}</span>
                <span class="text-gray-500 font-normal block">{{ follower.biography }}</span>

            </div>
        </div>
        <div>
            <button type="buton"
                    v-if="follower.id != auth"
                    @click.stop.prevent="followOrUnfollow"
                    class="border-blue-500 rounded-full text-center px-4 py-3 font-bold leading-none focus:outline-none"
                    v-bind:class="{
                        'hover:bg-red-700': follow,
                        'bg-blue-500': follow,
                        'text-gray-300': follow,
                        'border-0' : follow,
                        'border' : !follow,
                        'text-blue-500': !follow,
                        'hover:bg-blue-500': !follow,
                        'hover:text-gray-300': !follow
                    }"
                    >
                        {{ button }}
            </button>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
export default {
    props: {
        follower: {
            required: true,
            type: Object,
        },
        auth: {
            required: true,
        }
    },
      data() {
        return {
           button: null,
           follow: false,
        };
    },

  methods: {
    followOrUnfollow: function() {
          if (this.follow) {
                axios.delete(`/api/tweets/${this.follower.id}/follow`);
                this.button = (this.button == "Follow") ? "Unfollow" : "Follow";
                this.follow = this.follow ? false : true;
                return;
          }
          axios.post(`/api/tweets/${this.follower.id}/follow`);
                this.button = (this.button == "Follow") ? "Unfollow" : "Follow";
                this.follow = this.follow ? false : true;
      },

    followed() {
            if (this.follower.followers.filter(x => x.id === this.auth).length > 0)
                return true;
             return false;
        },

        followOrNot() {
            if (this.follower.followers.filter(x => x.id === this.auth).length > 0)
               return "Unfollow";
            return "Follow";
        },

        trigger() {
            window.location = "http://" + this.follower.website;
        }
  },

  mounted() {
      Vue.set(this, 'button', this.followOrNot());
      Vue.set(this, 'follow', this.followed());
  }
}
</script>

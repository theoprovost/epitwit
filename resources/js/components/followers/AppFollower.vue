<template>
    <div class="flex w-full cursor-pointer justify-between">
        <div class="flex">
            <img :src="user.avatar" alt=" " class="w-12 h-12 mr-3 rounded-full" />
            <div class="flex-grow">
                <span class="text-gray-200 font-bold hover:underline cursor-pointer block" @click.stop.prevent="trigger">{{ user.name }}</span>
                <span class="text-gray-500 font-normal ml-2 block">@{{ user.username }}</span>
                <span class="text-gray-500 font-normal ml-2 block">{{ user.biography }}</span>

            </div>
        </div>
        <div>
            <button type="buton"
                    @click.prevent="followOrUnfollow"
                    class="bg-blue-500 rounded-full text-gray-300 text-center px-4 py-3 font-bold leading-none"
                    v-bind:class="{
                        'hover:bg-red-700': follow
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
        user: {
            required: true,
            type: Object,
        },
        auth: {
            required: true,
        }
    },
    methods: {
    trigger () {
        window.location.pathname = "./" + this.user.username;
    },
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
                axios.delete(`/api/tweets/${this.user.id}/follow`);
                this.button = (this.button == "Follow") ? "Unfollow" : "Follow";
                this.follow = this.follow ? false : true;
                return;
          }
          axios.post(`/api/tweets/${this.user.id}/follow`);
                this.button = (this.button == "Follow") ? "Unfollow" : "Follow";
                this.follow = this.follow ? false : true;
      },

    followed() {
            if (this.user.followers.filter(x => x.id === this.auth).length > 0)
                return true;
             return false;
        },

        followOrNot() {
            if (this.user.followers.filter(x => x.id === this.auth).length > 0)
               return "Unfollow";
            return "Follow";
        },

        trigger() {
            window.location = "http://" + this.user.website;
        }
  },

  mounted() {
      Vue.set(this, 'button', this.followOrNot());
      Vue.set(this, 'follow', this.followed());
  }
}
</script>

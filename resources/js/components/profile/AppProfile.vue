<template>
     <div class="flex w-full p-4">
        <div class="p-4">
           <img :src="avatar" alt=" " class="mr-3 rounded-full" />
        </div>
        <div class="flex-grow pl-2">
            <div class="flex justify-between">
                <div>
                    <p class="text-gray-100 text-xl"><b>{{user.name}}</b></p>
                    <p>@<span>{{ user.username }}</span></p>
                </div>
                <div class="text-gray-400">
                    Joined {{ date }}
                </div>
            </div>
            <div class="mt-2">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis dignissim leo finibus eros condimentum vehicula.<br>
                Duis consectetur nisi dapibus, hendrerit dui nec, dapibus arcu. Maecenas in sodales lacus, ut maximus.
            </div>
            <div class="flex justify-between mt-1">
                <div class="flex">
                    <div class="pr-2">
                        <a :href="user.username + '/following'" class="hover:underline"><span>{{ user.following.length }}</span> Following</a>
                    </div><div class="pl-2">
                        <a :href="user.username + '/followers'" class="hover:underline"><span>{{ followers }}</span> Follower</a>
                    </div>
                </div>
                <div>
                    <button type="buton"
                    v-if="user.id != auth"
                    @click.prevent="followOrUnfollow"
                    class="bg-blue-500 rounded-full text-gray-300 text-center px-4 py-3 font-bold leading-none"
                    v-bind:class="{
                        'hover:bg-red-700': follow
                    }"
                    >
                        {{ button }}
                    </button>
                     <button type="buton"
                    v-if="user.id == auth"
                    class="bg-blue-500 rounded-full text-gray-300 text-center px-4 py-3 font-bold leading-none"
                    >
                    Edit profile
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
import axios from 'axios';
export default {
   props: {
    user: {
      required: true,
      type: Object,
    },
    date: {
      required: true,
      type: String,
    },
    avatar: {
      required: true,
    },
    auth: {
        required: true,
    }
  },

    data() {
        return {
           button: null,
           follow: false,
           followers: 6,
        };
    },

  methods: {
    followOrUnfollow: function() {
          if (this.follow) {
                axios.delete(`/api/tweets/${this.user.id}/follow`);
                this.button = (this.button == "Follow") ? "Unfollow" : "Follow";
                this.follow = this.follow ? false : true;
                this.followers--;
                return;
          }
          axios.post(`/api/tweets/${this.user.id}/follow`);
                this.button = (this.button == "Follow") ? "Unfollow" : "Follow";
                this.follow = this.follow ? false : true;
                this.followers++;
      },

     followed() {
            if (this.user.followers.filter(x => x.id === this.auth).length > 0)
                return true;
             return false;
        },

        followOrNot() {
            if (this.followed)
               return "Unfollow";
            return "Follow";
        },

        followersCount() {
            return this.user.followers.length;
        }

  },

  mounted() {
      this.button = this.followOrNot();
      this.follow = this.followed();
      this.followers = this.followersCount();
  }
}
</script>

<template>
     <div class="flex w-full p-4">
        <div class="p-4 pt-8">
           <img :src="avatar" alt=" " class="mr-3 rounded-full w-28" />
        </div>
        <div class="flex-grow pl-2">
            <div class="flex justify-between">
                <div class="flex items-center">
                    <div class="pr-2">
                    <p class="text-gray-100 text-xl"><b>{{ user.name }}</b></p>
                    </div>
                    <p class="text-gray-400">@<span>{{ user.username }}</span></p>
                </div>
                <div class="text-gray-300">
                    <p>Joined {{ date }}</p>
                </div>
            </div>
            <div class="flex justify-between pt-1">
                <div>
                    <p class="text-gray-300"><span>Born <span class="text-sm">{{ bdate }}</span></span></p>
                </div>
                <div>
                    <a href="" class="text-gray-300 hover:underline" @click.prevent="trigger">{{user.website}}</a>
                </div>
            </div>
            <div class="mt-2 h-16 text-gray-300">
                {{ user.biography }}
            </div>
            <div class="flex justify-between">
                <div class="flex pt-4">
                    <div class="pr-2">
                        <a :href="user.username + '/following'" class="hover:underline text-gray-400"><span class="text-gray-200 font-bold">{{ user.following.length - 1}}</span> Following</a>
                    </div><div class="pl-2">
                        <a :href="user.username + '/followers'" class="hover:underline text-gray-400"><span class="text-gray-200 font-bold">{{ followers - 1}}</span> Follower</a>
                    </div>
                </div>
                <div class="m-2">
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
                     <app-profile-action
                        :user = user
                       v-if="user.id == auth"
                     />
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
    bdate: {
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
            if (this.user.followers.filter(x => x.id === this.auth).length > 0)
               return "Unfollow";
            return "Follow";
        },

        followersCount() {
            return this.user.followers.length;
        },

        trigger() {
            window.location = "http://" + this.user.website;
        }
  },

  mounted() {
      Vue.set(this, 'button', this.followOrNot());
      Vue.set(this, 'follow', this.followed());
      Vue.set(this, 'followers', this.followersCount())
  }
}
</script>

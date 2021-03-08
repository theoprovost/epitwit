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
                <div class="flex items-center text-gray-300">
                   <p class="pr-2">Born</p>
                       <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5">>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    <span class="text-sm">{{ bdate }}</span>
                </div>
                <div class="hover:underline" v-if="user.website">
                    <a href="" class="flex text-gray-300 items-center" @click.prevent="trigger">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-6 pt-1">
                            <path fill-rule="evenodd" d="M3 5a2 2 0 012-2h10a2 2 0 012 2v8a2 2 0 01-2 2h-2.22l.123.489.804.804A1 1 0 0113 18H7a1 1 0 01-.707-1.707l.804-.804L7.22 15H5a2 2 0 01-2-2V5zm5.771 7H5V5h10v7H8.771z" clip-rule="evenodd" />
                        </svg>
                        {{user.website}}</a>
                </div>
            </div>
            <div class="mt-2 h-16 text-gray-400">
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
                    }">
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
      Vue.set(this, 'followers', this.followersCount());
      Vue.set(this.user, 'avatar', this.avatar);
  }
}
</script>

<template>
     <div class="flex w-full p-4">
         <div>
            <img :src="avatar" alt=" " class="mr-3 rounded-full" />
         </div>
         <div class="flex-grow">
        <div>
                Bouton modifier profil si user = moi || bouton de follow + boutton envoyer un message
        </div>
        <div>
            <p>{{user.name}}</p>
            <p>@<span>{{ user.username }}</span></p>
        </div>
        <div>
            Joined {{ date }}
        </div>
        <div class="flex justify-between">
            <div>
            <a><span>{{ user.following.length }}</span> Following</a>
            <a><span>{{ user.followers.length }}</span> Follower</a>
            </div>
            <div>
                <a href="#" @click.prevent="followOrUnfollow" class="bg-blue-500 rounded-full text-gray-300 text-center px-4 py-3 font-bold leading-none">{{ followOrNot }}</a>
            </div>
        </div>
        </div>
    </div>
</template>


<script>
import axios from 'axios';
import { mapGetters, mapActions } from "vuex";
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

    computed: {
        followed() {
            if (this.user.followers.filter(x => x.id === this.auth).length > 0)
                return true;
             return false;
        },
        followOrNot() {
            if (this.followed)
               return 'Unfollow';
            return 'Follow';
        }
    },
   /*actions: {
        async follow(_, user) {
            await axios.post(`/tweets/${user.username}/follow`);
        },

        async unfollow(_, user) {
            await axios.delete(`/tweets/${user}/follow'`);
        },
   },*/

  methods: {
    followOrUnfollow: function() {
          if (this.followed) {
                axios.delete(`/api/tweets/${this.user.id}/follow`);
                return;
          }
          axios.post(`/api/tweets/${this.user.id}/follow`);
      }
  }
}
</script>

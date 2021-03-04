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
                <a href="#" class="bg-blue-500 rounded-full text-gray-300 text-center px-4 py-3 font-bold leading-none">#Follow</a>
            </div>
        </div>
        </div>
    </div>
</template>


<script>
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

  },
}
</script>

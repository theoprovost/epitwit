<template>
    <div>
        <div class="items-center cursor-pointer border-b-2 border-gray-800">
            <div class="flex items-center">
                <div class="p-2">
                    <div class="p-2 hover:bg-gray-800 rounded-full cursor-pointer" @click.prevent="triggerUser">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="text-blue-500 h-8">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                    </div>
                </div>
                <div>
                    <p class="text-gray-200 text-xl font-bold block">{{user.name}}</p>
                    <p class="text-gray-600 block">@{{user.username}}</p>
                </div>
            </div>
            <div class="flex justify-around text-center">
                <div
                    class="border-b-4 border-gray-900 box-border hover:bg-gray-800 cursor-pointer text-xl w-6/12 h-full p-4 hover:text-blue-500" @click.prevent="triggerFollowers"
                    :class="{
                        'text-blue-500' : inFollowers,
                        'text-gray-400 hover:border-gray-800' : !inFollowers,
                        'border-b-4 border-blue-500' : inFollowers,
                    }"

                > followers </div>
                <div class="border-b-4 border-gray-900 hover:bg-gray-800 cursor-pointer text-xl w-6/12 h-full p-4 hover:text-blue-500" @click.prevent="triggerFollowing"
                    :class="{
                        'text-blue-500' : !inFollowers,
                        'text-gray-400 hover:border-gray-800' : inFollowers,
                        'border-b-4 border-blue-500' : !inFollowers,
                    }"> following </div>
            </div>
        </div>
        <app-follower v-for="follower in followers" :key="follower.id" :follower="follower" :auth="auth" class="w-full inline-block p-4 border-b border-gray-800 hover:bg-gray-800 cursor-pointer"/>
    </div>
</template>

<script>
export default {
    props: {
        user: {
            required: true,
            type: Object,
        },
        followers: {
            required: true,
            type: Object,
        },
        auth: {
            required: true,
            type: Number,
        }
    },
    methods: {
        isInFollowers() {
            return this.route == "followers" ? true : false;
        },
        triggerFollowing() {
            window.location.pathname = this.user.username + "/following"
        },
        triggerFollowers() {
            window.location.pathname = this.user.username + "/followers"
        },
        triggerUser() {
            window.location.pathname = this.user.username
        }
    },
    data() {
        return {
            route: '',
            inFollowers: false,
        };
    },
    mounted() {
        Vue.set(this, 'route', window.location.pathname.split("/").pop());
        Vue.set(this, 'inFollowers', this.isInFollowers());
    }
}
</script>

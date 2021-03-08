<template>
    <div>
        <div class="flex items-center cursor-pointer border-b-2 border-gray-800">
            <div class="p-2">
            <div class="p-2 hover:bg-gray-800 rounded-full">
                <a href="">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="text-blue-500 h-12">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
            </div>
            </div>
            <div>
                <p class="text-gray-200 text-xl font-bold block">{{user.name}}</p>
                <p class="text-gray-600 block">@{{user.username}}</p>
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
}
</script>

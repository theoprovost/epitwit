<template>
    <div class="w-full inline-block p-4 border border-0 border-gray-800 hover:bg-gray-800 cursor-pointer">
        <app-follower v-for="user in users" :key="user.id" :user="user" :auth="auth"/>
    </div>
</template>

<script>
export default {
    props: {
        users: {
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

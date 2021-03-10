<template>
    <div class="flex min-h-full w-full cursor-pointer justify-between"
            @click.stop.prevent="trigger">
        <div class="flex flex-grow justify-between">
            <div class=flex>
            <img :src="user.avatar" alt=" " class="w-12 h-12 mr-3 rounded-full" />
            <div class="flex-grow">
                <div class="flex">
                <span class="text-gray-200 font-bold hover:underline cursor-pointer block pr-1">{{ user.name }}</span>
                <span class="text-gray-500 font-normal block">@{{ user.username }}</span>
                </div>
                <span class="text-gray-500 font-normal block c-break pb-2 pt-2">{{ user.last.body }}</span>
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
        }
    },
     methods: {
        trigger() {
            window.location.pathname = "messages/" + window.User.id + "-" + this.user.id
        }
    },
}
</script>

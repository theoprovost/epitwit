<template>
<div>
    <div class="flex justify-end"  v-if="leftOrRight()">
       <div class="justify-start min-h-full cursor-pointer justify-between pl-4 pr-4 p-1">
            <div class="flex">
                <div class="flex-grow rounded-lg rounded-br-none bg-blue-700 pl-2 pr-2">
                    <span class="text-gray-300 font-normal block c-break pt-2">{{ message.body }}</span>
                </div>
                <img :src="message.user.avatar" alt=" " class="w-12 h-12 ml-3 rounded-full" />
            </div>
            <div class="text-center text-sm">
                <span>{{message.created_since}}</span>
            </div>
        </div>
    </div>
    <div class="flex justify-start"  v-else>
       <div class="justify-start min-h-full cursor-pointer justify-between pl-4 pr-4 p-1">
            <div class="flex">
                <img :src="message.user.avatar" alt=" " class="w-12 h-12 mr-3 rounded-full" />
                <div class="flex-grow rounded-lg rounded-bl-none bg-gray-700 pl-2 pr-2">
                    <span class="text-gray-300 font-normal block c-break pt-2">{{ message.body }}</span>
                </div>
            </div>
            <div class="text-center text-sm">
                <span>{{message.created_since}}</span>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props: {
        message: {
            required: true,
            type: Object,
        }
    },
    methods: {
        leftOrRight(id) {
            if (this.message.user.id == window.User.id)
                return true;
            return false;
        }
    }
}
</script>

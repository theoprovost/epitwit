<template>
        <div>
            <app-conversation v-for="conversation in conversations" :key="conversation.created_at" :user="conversation"
            class="w-full inline-block p-4 border-b border-gray-800 hover:bg-gray-800 cursor-pointer"
            />
        </div>
</template>

<script>
import axios from 'axios'
export default {
    data () {
        return {
            conversations: [],
        };
    },
    methods: {
        async getConversation() {
            let response = await axios.get('/api/messages');
            this.conversations = response.data;
            this.conversations = this.conversations.sort((a, b) => b.created_at - a.created_at)
        },
        trigger(conversation) {
            window.location.pathname = window.User.id + "-" + conversation.id
        }
    },
    mounted() {
        this.getConversation();
        this.conversations = this.conversations.sort((a, b) => b.created_at - a.created_at)
    }
}
</script>

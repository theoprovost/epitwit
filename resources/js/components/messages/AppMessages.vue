<template>
    <div class="w-full">
        <div class="absolute block w-7/12 border-2 border-t-0 border-gray-800 z-10 bg-gray-900">
            <div class="p-4 h-20 border-b-2 border-gray-800">
                lalal
            </div>
        </div>
        <div class="h-full fixed w-7/12 border-2 border-gray-800 border-b-0 overflow-scroll flex flex-col pb-20" id="scroll">
            <div class="flex p-4 pb-12 pt-32 border-b-2 border-t-2 border-gray-800 mb-2">
                <div>
                    <img :src="user.avatar" alt=" " class="mr-3 rounded-full w-28" />
                </div>
                <div class="flex w-full text-gray-600">
                   <span class="w-full text-center text-gray-200 text-xl">{{user.name}} <span class="text-gray-600 text-md">@{{user.username}}</span></span>
                </div>
            </div>
                <app-message v-for="message in messages" :key="message.id" :message="message"/>
        </div>
        <div class="bg-gray-900 fixed bottom-0 w-7/12 border-2 border-b-0 border-gray-800 z-10 overflow-hidden">
            <form  @submit.prevent="submit">
                <div class="flex p-4 items-center pl-20">
                    <input type="text" v-model="form.body" placeholder="Send a message" class="text-gray-200 rounded-full bg-gray-900 border border-blue-500 text-left p-1 pl-2 focus:outline-none w-10/12">
                    <div class="pr-4 pl-4">
                        <label>
                            <input type="submit" class="hidden">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-6 text-blue-500 cursor-pointer">
                                <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                            </svg>
                        </label>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
export default {
    data () {
        return {
            messages: [],
            user: {},
            form: {
                body: "",
            },
        };
    },
    props: {
        userid: {
            required: true,
            type: Number,
        }
    },
    methods: {
        async getMessages() {
            let response = await axios.get('/api/messages/' + window.User.id + "-" + this.userid);
            this.messages = response.data.data;
            this.messages = this.messages.sort((a, b) => a.created_at - b.created_at)
        },
         async getUser() {
            let response = await axios.get('/api/get/' + this.userid);
            this.user = response.data.data;
        },
        async submit() {
            await axios.post('/api/messages/' + this.userid + '/submit', this.form);
            this.form.body = "";
        }
    },
    getters: {
        PUSH_MESSAGES(state, data) {
            console.log('a');
        state.messages.push(
            ...data.filter(message => {
                return !state.messages.map(t => t.id).includes(message.id);
            }) // removes duplicate when reloading on scroll down : to read as : spread that but only return tweets not present (verification via ids)
        );
    },
    },
    updated: function () {
        var elem = document.getElementById('scroll');
            elem.scrollTo(0,elem.scrollHeight);
    },
    mounted() {
        this.getMessages();
        this.getUser();
        Echo.channel(`messages.${this.$user.id}.${this.userid}`).listen(
            ".MessageWasCreated",
             (e) => {
                console.log('e');
                this.getMessages();
            })
    }
}
</script>

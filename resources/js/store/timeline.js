import axios from 'axios';

export default {
    namespaced: true,

    state: {
        tweets: [],
    },

    getters: {
        tweets(state) {
            return state.tweets.sort((a, b) => {
                return b.created_at - a.created_at
            });
        }
    },

    mutations: {
        PUSH_TWEETS(state, data) {
            state.tweets.push(
                ...data.filter(tweet => {
                    return !state.tweets.map(t => t.id).includes(tweet.id);
                }) // removes duplicate when reloading on scroll down : to read as : spread that but only return tweets not present (verification via ids)
            );
        }
    },

    actions: {
        async getTweets({ commit }, url) {
            let res = await axios.get(url);

            commit('PUSH_TWEETS', res.data.data);

            return res;
        }
    }
}
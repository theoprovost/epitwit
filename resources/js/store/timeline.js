import axios from 'axios';
import { get } from 'lodash';

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
        },

        SET_LIKES(state, { id, count }) {
            state.tweets = state.tweets.map(t => {
                if (t.id === id) {
                    t.likes_count = count;
                }

                if (t.original_tweet?.id === id) {
                    t.original_tweet.likes_count = count;
                }

                return t;
            });
        },

        SET_RETWEETS(state, { id, count }) {
            state.tweets = state.tweets.map(t => {
                if (t.id === id) {
                    t.retweets_count = count;
                }

                if (t.original_tweet?.id === id) {
                    t.original_tweet.retweets_count = count;
                }

                return t;
            });
        },

        POP_TWEET(state, id) {
            state.tweets = state.tweets.filter(t => {
                return t.id !== id;
            })
        }
    },

    actions: {
        async getTweets({ commit }, url) {
            let res = await axios.get(url);

            commit('PUSH_TWEETS', res.data.data);

            commit('likes/PUSH_LIKES', res.data.meta.likes, { root: true });
            commit('retweets/PUSH_RETWEETS', res.data.meta.retweets, { root: true });

            return res;
        }
    }
}
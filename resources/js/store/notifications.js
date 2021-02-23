import axios from 'axios';

import actions from './tweet/actions';
import mutations from './tweet/mutations';
import getters from './tweet/getters';

export default {
    namespaced: true,

    state: {
        notifications: [],
        tweets: []
    },

    getters: {
        ...getters,

        notifications(state) {
            return state.notifications;
        },

        tweetIdsFromNotifications(state) {
            return state.notifications.map(n => n.data.tweet.id);
        }
    },

    mutations: {
        ...mutations,

        PUSH_NOTIFICATIONS(state, data) {
            state.notifications.push(...data);
        }
    },

    actions: {
        ...actions,

        async getNotifications({ commit, dispatch, getters }, url) {
            let res = await axios.get(url);

            commit('PUSH_NOTIFICATIONS', res.data.data);
            dispatch('getTweets', `api/tweets?ids=${getters.tweetIdsFromNotifications.join(',')}`);

            return res;
        }
    }
}
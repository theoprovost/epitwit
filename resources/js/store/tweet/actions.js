import axios from 'axios';

export default {
    async getTweets({ commit }, url) {
        let res = await axios.get(url);

        commit('PUSH_TWEETS', res.data.data);

        commit('likes/PUSH_LIKES', res.data.meta.likes, { root: true });
        commit('retweets/PUSH_RETWEETS', res.data.meta.retweets, { root: true });

        return res;
    },

    async quoteTweet(_, { tweet, data }) {
        await axios.post(`/api/tweets/${tweet.id}/quotes`, data);
    },

    async replyTweet(_, { tweet, data }) {
        await axios.post(`/api/tweets/${tweet.id}/replies`, data);
    }
}
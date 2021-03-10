<template>
  <div class="v-full h-full">
    <div class="v-full h-12">
      <form action="">
        <label for="search" class="hidden">Search hashtags:</label>
        <input
          type="search"
          name="search"
          id="search"
          class="bg-gray-800 outline-none text-gray-300"
          v-on:keyup="handleSearch"
        />
      </form>
    </div>

    <div v-if="tweets.length" class="w-full h-full">
      <app-tweet v-for="tweet in tweets" :key="tweet.id" :tweet="tweet" />
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      tweets: [],
    };
  },

  methods: {
    async handleSearch(e) {
      e.preventDefault();

      let search = e.target.value;

      if (search.length >= 2) {
        if (!axios.isCancel(e)) {
          cancel;
        }

        let axiosToken = axios.CancelToken.source();

        const fetchData = async () => {
          try {
            this.tweets = await axios
              .post(
                "/api/explore/search",
                {
                  data: search,
                },
                {
                  cancelToken: axiosToken.token,
                }
              )
              .then((res) => {
                return res.data.data;
              });
          } catch (e) {
            console.log(e);
          }
        };

        const cancel = async () => {
          axiosReq.cancel();
        };

        fetchData();
      } else return;
    },
  },
};
</script>
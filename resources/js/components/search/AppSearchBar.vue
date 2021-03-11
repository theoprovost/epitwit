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

    <div v-if="results.length" class="w-full h-full">
      <component
        :is="component"
        v-for="result in results"
        :key="result.id"
        :follower="result"
        :auth="whoami"
        :tweet="result"
      />
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  props: {
    url: {
      type: String,
      required: true,
    },

    component: {
      type: String,
      required: true,
    },
  },

  data() {
    return {
      results: [],
    };
  },

  methods: {
    whoami() {
      return this.$user;
    },

    async handleSearch(e) {
      e.preventDefault();

      let search = e.target.value;

      if (search.length >= 2) {
        // const CancelToken = axios.CancelToken;
        // let source = CancelToken.source();

        const fetchData = async () => {
          try {
            this.results = await axios
              .post(
                this.url,
                {
                  data: search,
                }
                // {
                //   cancelToken: source.token,
                // }
              )
              .then((res) => {
                return res.data.data || res.data;
              });
          } catch (e) {
            console.log(e);
          }
        };

        //source && source.cancel("Operation canceled due to new request.");

        fetchData();
      } else return;
    },
  },
};
</script>
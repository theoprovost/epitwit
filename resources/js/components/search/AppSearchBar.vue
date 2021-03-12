<template>
  <div class="w-full h-full flex justify-center content-center flex-col">
    <div class="w-full h-12 flex justify-center content-center mb-4">
      <form action="" class="w-full flex justify-center content-center">
        <label for="search" class="hidden">Search hashtags:</label>
        <input
          autocomplete="off"
          :placeholder="placeholder"
          type="search"
          name="search"
          id="search"
          ref="search"
          class="bg-gray-800 outline-none text-gray-300 p-4 rounded-full"
          v-on:keyup="handleSearch"
        />
      </form>
    </div>

    <div v-if="results.length" class="w-full h-full">
      <p v-if="results.length > 1" class="text-gray-600 mb-4">
        {{ results.length }} results
      </p>
      <p v-else class="text-gray-600 mb-4">{{ results.length }} result</p>

      <component
        :is="component"
        v-for="result in results"
        :key="result.id"
        :follower="result"
        :auth="whoami"
        :tweet="result"
        class="mb-4"
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
    placeholder: {
      required: false,
      type: String,
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
  mounted() {
    const param = window.location.search.substring(2);
    if (param) {
      const input = this.$refs.search;
      input.value = param;
      input.dispatchEvent(new KeyboardEvent("keyup"));
    }
  },
};
</script>
<template>
  <div>
    <form action="">
      <label for="search" class="hidden">Search the site:</label>
      <input
        type="search"
        name="search"
        id="search"
        class="bg-gray-800 outline-none text-gray-300"
        v-on:keyup="handleSearch"
      />
    </form>
  </div>
</template>

<script>
import axios from "axios";
export default {
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
            await axios.post(
              "/api/explore/search",
              {
                data: search,
              },
              {
                cancelToken: axiosToken.token,
              }
            );
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
<template>
  <form class="flex" @submit.prevent="submit">
    <img :src="$user.avatar" alt=" " class="mr-2 w-12 h-12 rounded-full" />

    <div class="flex-grow">
      <app-tweet-compose-textarea v-model="form.body" />

      <app-tweet-image-preview
        :images="media.images"
        v-if="media.images.length"
      />

      <app-tweet-video-preview :video="media.video" v-if="media.video" />

      <div class="flex justify-between">
        <ul class="flex items-center">
          <li class="mr-4">
            <app-tweet-compose-media-button
              id="media-compose"
              @selected="handleMediaSlected"
            />
          </li>
        </ul>

        <div class="flex items-center justify-end">
          <app-tweet-compose-limit :body="form.body" />

          <button
            type="submit"
            class="bg-blue-500 rounded-full text-gray-300 text-center px-4 py-3 font-bold leading-none"
          >
            Tweet
          </button>
        </div>
      </div>
    </div>
  </form>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      form: {
        body: "",
        media: [],
      },

      media: {
        images: [],
        video: "",
      },

      mediaTypes: {},
    };
  },

  methods: {
    async submit() {
      await axios.post("/api/tweets", this.form);

      this.form.body = "";
    },

    async getMimeTypes() {
      let res = await axios.get("/api/media/types");

      this.mediaTypes = res.data.data;
    },

    handleMediaSlected(files) {
      Array.from(files)
        .slice(0, 4) // limits to 4 images max
        .forEach((file) => {
          if (this.mediaTypes.images.includes(file.type)) {
            this.media.images.push(file);
          }

          if (this.mediaTypes.video.includes(file.type)) {
            this.media.video = file;
          }
        });

      if (this.media.video) {
        this.media.images = []; // empties the image array if a video si found : mimic the Twitter fucntionality
      }
    },
  },

  mounted() {
    this.getMimeTypes();
  },
};
</script>

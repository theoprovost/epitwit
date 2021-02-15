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
                progress: 0,
            },

            mediaTypes: {},
        };
    },

    methods: {
        async submit() {
            let hasMedia = false;

            if (this.media.images.length || this.media.video) {
                let media = await this.uploadMedia();
                this.form.media = media.data.data.map((m) => m.id);

                hasMedia = true;
            }

            if (hasMedia || this.form.body.trim() !== "") {
                await this.post();
            } else {
                this.form.body = "";
                return;
            }

            this.form.media = [];

            this.form.body = "";
            this.media.images = [];
            this.media.video = null;
            this.media.progress = 0;
        },

        async uploadMedia() {
            return await axios.post("/api/media", this.buildMediaForm(), {
                headers: {
                    "Content-Type": "multipart/form-data",
                },
                onUploadProgress: this.handleUploadProgress,
            });
        },

        handleUploadProgress(e) {
            this.media.progress = parseInt(Math.round((e.loaded / e.total) * 100));
        },

        buildMediaForm() {
            let form = new FormData();

            if (this.media.images.length > 0) {
                this.media.images.forEach((img, index) => {
                    form.append(`media[${index}]`, img);
                });
            }

            if (this.media.video) {
                form.append("media[0]", this.media.video);
            }

            return form;
        },

        async getMimeTypes() {
            let res = await axios.get("/api/media/types");

            this.mediaTypes = res.data.data;
        },

        removeVideo() {
            this.media.video = null;
        },

        removeImage(image) {
            this.media.images = this.media.images.filter((img) => {
                return img !== image;
            });
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
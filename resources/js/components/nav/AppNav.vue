<template>
  <div class="w-3/12 h-screen flex flex-col flex-end text-gray-300 fixed">
    <div class="w-full inline-block h-12 rounded-full mb-2">
      <img src="" alt="" />
    </div>
    <div class="w-full flex h-12 rounded-full mb-2">
      <div
        ref="home"
        class="rounded-full hover:bg-gray-800 p-2 pr-6 pl-4 text-gray-300 hover:text-blue-500 cursor-pointer"
        @click="triggerHome"
      >
        <div class="w-full h-full flex align-center">
          <svg
            viewBox="0 0 24 24"
            width="35"
            height="35"
            class="fill-current self-center"
          >
            <g>
              <path
                d="M22.58 7.35L12.475 1.897c-.297-.16-.654-.16-.95 0L1.425 7.35c-.486.264-.667.87-.405 1.356.18.335.525.525.88.525.16 0 .324-.038.475-.12l.734-.396 1.59 11.25c.216 1.214 1.31 2.062 2.66 2.062h9.282c1.35 0 2.444-.848 2.662-2.088l1.588-11.225.737.398c.485.263 1.092.082 1.354-.404.263-.486.08-1.093-.404-1.355zM12 15.435c-1.795 0-3.25-1.455-3.25-3.25s1.455-3.25 3.25-3.25 3.25 1.455 3.25 3.25-1.455 3.25-3.25 3.25z"
              ></path>
            </g>
          </svg>

          <p class="self-center ml-4 text-lg font-bold">Home</p>
        </div>
      </div>
    </div>

    <div class="w-full flex h-12 rounded-full mb-2">
      <div
        ref="explore"
        class="rounded-full hover:bg-gray-800 p-2 pr-6 pl-4 text-gray-300 hover:text-blue-500 cursor-pointer"
        @click="triggerExplore"
      >
        <div class="w-full h-full flex align-center">
          <div class="self-center">
            <svg
              viewBox="0 0 24 24"
              width="35"
              height="35"
              class="fill-current self-center"
            >
              <g>
                <path
                  d="M21 7.337h-3.93l.372-4.272c.036-.412-.27-.775-.682-.812-.417-.03-.776.27-.812.683l-.383 4.4h-6.32l.37-4.27c.037-.413-.27-.776-.68-.813-.42-.03-.777.27-.813.683l-.382 4.4H3.782c-.414 0-.75.337-.75.75s.336.75.75.75H7.61l-.55 6.327H3c-.414 0-.75.336-.75.75s.336.75.75.75h3.93l-.372 4.272c-.036.412.27.775.682.812l.066.003c.385 0 .712-.295.746-.686l.383-4.4h6.32l-.37 4.27c-.036.413.27.776.682.813l.066.003c.385 0 .712-.295.746-.686l.382-4.4h3.957c.413 0 .75-.337.75-.75s-.337-.75-.75-.75H16.39l.55-6.327H21c.414 0 .75-.336.75-.75s-.336-.75-.75-.75zm-6.115 7.826h-6.32l.55-6.326h6.32l-.55 6.326z"
                ></path>
              </g>
            </svg>
          </div>
          <p class="self-center ml-4 text-lg font-bold">Explore</p>
        </div>
      </div>
    </div>

    <div class="w-full flex h-12 rounded-full mb-2">
      <div
        ref="notifications"
        class="rounded-full hover:bg-gray-800 p-2 pr-6 pl-4 text-gray-300 hover:text-blue-500 cursor-pointer"
        @click="triggerNotifications"
      >
        <div class="w-full h-full flex align-center">
          <div class="self-center">
            <svg
              viewBox="0 0 24 24"
              width="35"
              height="35"
              class="fill-current self-center"
            >
              <g>
                <path
                  d="M21.697 16.468c-.02-.016-2.14-1.64-2.103-6.03.02-2.532-.812-4.782-2.347-6.335C15.872 2.71 14.01 1.94 12.005 1.93h-.013c-2.004.01-3.866.78-5.242 2.174-1.534 1.553-2.368 3.802-2.346 6.334.037 4.33-2.02 5.967-2.102 6.03-.26.193-.366.53-.265.838.102.308.39.515.712.515h4.92c.102 2.31 1.997 4.16 4.33 4.16s4.226-1.85 4.327-4.16h4.922c.322 0 .61-.206.71-.514.103-.307-.003-.645-.263-.838zM12 20.478c-1.505 0-2.73-1.177-2.828-2.658h5.656c-.1 1.48-1.323 2.66-2.828 2.66zM4.38 16.32c.74-1.132 1.548-3.028 1.524-5.896-.018-2.16.644-3.982 1.913-5.267C8.91 4.05 10.397 3.437 12 3.43c1.603.008 3.087.62 4.18 1.728 1.27 1.285 1.933 3.106 1.915 5.267-.024 2.868.785 4.765 1.525 5.896H4.38z"
                ></path>
              </g>
            </svg>
          </div>
          <p class="self-center ml-4 text-lg font-bold">Notifications</p>
        </div>
      </div>
    </div>

    <div class="w-full flex h-12 rounded-full mb-2">
      <div
        ref="messages"
        class="rounded-full hover:bg-gray-800 p-2 pr-6 pl-4 text-gray-300 hover:text-blue-500 cursor-pointer"
        @click="triggerMessages"
      >
        <div class="w-full h-full flex align-center">
          <div class="self-center">
            <svg
              viewBox="0 0 24 24"
              width="35"
              height="35"
              class="fill-current self-center"
            >
              <g>
                <path
                  d="M19.25 3.018H4.75C3.233 3.018 2 4.252 2 5.77v12.495c0 1.518 1.233 2.753 2.75 2.753h14.5c1.517 0 2.75-1.235 2.75-2.753V5.77c0-1.518-1.233-2.752-2.75-2.752zm-14.5 1.5h14.5c.69 0 1.25.56 1.25 1.25v.714l-8.05 5.367c-.273.18-.626.182-.9-.002L3.5 6.482v-.714c0-.69.56-1.25 1.25-1.25zm14.5 14.998H4.75c-.69 0-1.25-.56-1.25-1.25V8.24l7.24 4.83c.383.256.822.384 1.26.384.44 0 .877-.128 1.26-.383l7.24-4.83v10.022c0 .69-.56 1.25-1.25 1.25z"
                ></path>
              </g>
            </svg>
          </div>
          <p class="self-center ml-4 text-lg font-bold">Messages</p>
        </div>
      </div>
    </div>

    <div class="w-full flex h-12 rounded-full mb-2">
      <div
        :ref="user.username"
        class="rounded-full hover:bg-gray-800 p-2 pr-6 pl-4 text-gray-300 hover:text-blue-500 cursor-pointer"
        @click="triggerProfile"
      >
        <div class="w-full h-full flex align-center">
          <div class="self-center">
            <svg
              viewBox="0 0 24 24"
              width="35"
              height="35"
              class="fill-current self-center"
            >
              <g>
                <path
                  d="M12 11.816c1.355 0 2.872-.15 3.84-1.256.814-.93 1.078-2.368.806-4.392-.38-2.825-2.117-4.512-4.646-4.512S7.734 3.343 7.354 6.17c-.272 2.022-.008 3.46.806 4.39.968 1.107 2.485 1.256 3.84 1.256zM8.84 6.368c.162-1.2.787-3.212 3.16-3.212s2.998 2.013 3.16 3.212c.207 1.55.057 2.627-.45 3.205-.455.52-1.266.743-2.71.743s-2.255-.223-2.71-.743c-.507-.578-.657-1.656-.45-3.205zm11.44 12.868c-.877-3.526-4.282-5.99-8.28-5.99s-7.403 2.464-8.28 5.99c-.172.692-.028 1.4.395 1.94.408.52 1.04.82 1.733.82h12.304c.693 0 1.325-.3 1.733-.82.424-.54.567-1.247.394-1.94zm-1.576 1.016c-.126.16-.316.246-.552.246H5.848c-.235 0-.426-.085-.552-.246-.137-.174-.18-.412-.12-.654.71-2.855 3.517-4.85 6.824-4.85s6.114 1.994 6.824 4.85c.06.242.017.48-.12.654z"
                ></path>
              </g>
            </svg>
          </div>
          <p class="self-center ml-4 text-lg font-bold">Profile</p>
        </div>
      </div>
    </div>

    <div class="w-full flex h-12 rounded-full mb-2">
      <div
        ref="search"
        class="rounded-full hover:bg-gray-800 p-2 pr-6 pl-4 text-gray-300 hover:text-blue-500 cursor-pointer"
        @click="triggerSearch"
      >
        <div class="w-full h-full flex align-center">
          <div class="self-center">
            <svg
              viewBox="0 0 24 24"
              width="35"
              height="35"
              class="fill-current self-center"
            >
              <g>
                <path
                  d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"
                ></path>
              </g>
            </svg>
          </div>
          <p class="self-center ml-4 text-lg font-bold">Search</p>
        </div>
      </div>
    </div>

    <div class="flex mb-2 p-4 flex items-center absolute bottom-0 left-0 mb-6">
      <div class="align-middle">
        <img :src="user.avatar" alt=" " class="mr-3 rounded-full w-10" />
      </div>

      <div class="w-full h-full pl-4">
        <p class="font-semibold">{{ user.name }}</p>
        <p class="text-gray-500">@{{ user.username }}</p>
      </div>

      <app-dropdown class="relative right-0">
        <template slot="trigger">
          <div class="items-center pl-2">
            <div
              class="rounded-full hover:border-gray-500 hover:bg-gray-500 text-gray-400 hover:text-gray-200 p-1"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                class="h-6"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"
                />
              </svg>
            </div>
            {{ current() }}
          </div>
        </template>

        <app-dropdown-item @click.stop.prevent="logout" class="text-black">
          Logout
        </app-dropdown-item>
      </app-dropdown>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  computed: {
    user() {
      return this.$user;
    },
  },

  data() {
    return {
      el: {},
    };
  },

  methods: {
    triggerProfile() {
      window.location.pathname = this.$user.username;
    },

    triggerNotifications() {
      window.location = "notifications";
    },

    triggerHome() {
      window.location = "home";
    },

    triggerMessages() {
      window.location = "messages";
    },

    triggerExplore() {
      window.location = "explore";
    },

    triggerSearch() {
      window.location = "search";
    },

    async logout() {
      const isUnlogged = await axios.get("/logout");
      if (isUnlogged) {
        window.location.href = "/";
      }
    },

    current() {},
  },

  mounted() {
    let current = window.location.pathname;
    current = current.substring(1);
    this.el = this.$refs[`${current}`];
    this.el.classList.add("text-blue-500");
  },
};
</script>

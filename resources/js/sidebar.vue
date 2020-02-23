<template>
  <div
    v-show="loggedIn"
    class="bg-gray-900 shadow-lg h-16 fixed bottom-0 mt-12 md:relative md:h-auto z-10 w-full md:w-48"
  >
    <div
      class="md:mt-12 md:w-48 md:fixed md:left-0 md:top-0 content-center md:content-start text-left justify-between"
    >
      <ul
        class="list-reset flex flex-row md:flex-col py-0 md:py-3 px-1 md:px-2 text-center md:text-left"
      >
        <li v-for="(link, index) in links" v-bind:key="index" class="mr-3 flex-1">
          <router-link
            :to="{ name: link.route }"
            class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-pink-500"
          >
            <i class="fas fa-tasks pr-0 md:pr-3"></i>
            <span
              class="pb-1 md:pb-0 text-xs md:text-base text-gray-600 md:text-gray-400 block md:inline-block"
            >{{link.name}}</span>
          </router-link>
        </li>
      </ul>
    </div>
  </div>
</template>
<script>
export default {
  name: "sidebar",
  props: {
    user: {
      invoice: false
    }
  },
  computed: {
    links() {
      return this.$store.state.sidebarlinks;
    },
    loggedIn() {
      return this.$store.getters.loggedIn;
    }
  }
};
</script>

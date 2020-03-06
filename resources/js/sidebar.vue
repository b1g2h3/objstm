<template>
  <div
    v-show="loggedIn"
    class="bg-darkergreen md:bg-ivory shadow-lg h-16 fixed md:top-auto md:mb-0 md:fixed md:h-auto z-10 w-full md:w-48"
  >
    <div
      class="md:w-48  md:left-0 md:top-0 content-center md:content-start text-left justify-between"
    >
      <ul
        class="list-reset flex flex-row md:flex-col py-0 md:py-3 px-1 md:px-2 text-center md:text-left"
      >
        <li v-for="(link, index) in links" v-bind:key="index" class="mr-3 flex-1">
          <router-link
            :to="{ name: link.route }"
            class="block py-1 md:py-3 pl-1 align-middle text-black no-underline hover:text-black border-b-2 border-gray-800 hover:border-pink-500"
          >
            <i class="fas fa-tasks pr-0 md:pr-3"></i>
            <span
              class="pb-1 md:pb-0 text-xs md:text-base text-black md:text-black block md:inline-block"
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

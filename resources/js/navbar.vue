<template>
  <nav class="bg-gray-900 md:pt-1 pb-1 px-1 mt-0 h-auto w-full z-20 top-0">
    <div class="flex flex-wrap items-center">
      <div class="flex flex-shrink md:w-1/3 justify-center md:justify-center text-white">
        <router-link :to="{ name: 'home' }">Šotola Miroslav</router-link>
      </div>

      <div class="flex w-full pt-2 content-center justify-between md:w-1/3 md:justify-end">
        <ul class="list-reset flex justify-between flex-1 md:flex-none items-center">
          <li v-if="loggedIn"  v-for="(link, index) in loogedInlinks" v-bind:key="index" class="flex-1 md:flex-none md:mr-3 text-white">
                <router-link
                  :to="{ name: link.route }"
                  class="inline-block text-gray-600 no-underline hover:text-gray-200 hover:text-underline py-2 px-4"
                > {{link.name}}</router-link>
          </li>  
          </ul>    
        <ul class="list-reset flex justify-between flex-1 md:flex-none items-center">    
          <li v-if="!loggedIn"  v-for="(link, index) in links" v-bind:key="index" class="flex-1 md:flex-none md:mr-3 text-white">
                <router-link
                  :to="{ name: link.route }"
                  class="inline-block text-gray-600 no-underline hover:text-gray-200 hover:text-underline py-2 px-4"
                > {{link.name}}</router-link>
          </li>          
        </ul>
      </div>
    </div>
  </nav>
</template>
<script>
export default {
  name: "navbar",
  computed: {
    links() {
      return this.$store.state.navbarlinks;
    },
    loogedInlinks() {
      return this.$store.state.loogedInlinks;
    },
    loggedIn() {
      return this.$store.getters.loggedIn;
    }
  }
};
</script>

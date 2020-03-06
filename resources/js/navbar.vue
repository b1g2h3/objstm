<template>
  <nav class="bg-junglegreen px-1 mt-0 h-auto w-full z-20 top-0 text-white">
    <div class="flex items-baseline container mx-auto">
       <div class="m-4 pl-3">
          <router-link class="flex items-center" :to="{ name: 'home' }">
          <img class="w-32 h-32 " src="/storage/src/bile.png" alt="Miroslav Šotola">
          <div class="border-l-4 border-white  ml-5 h-32"></div>
          <div class="ml-2 pl-2  text-2xl font-bold">Šotola Miroslav</div>
          </router-link>
       </div>
      <div class="flex md:justify-end -mb-20 ">
        <ul class="list-reset flex justify-between flex-1 md:flex-none ">
          <li v-if="loggedIn"  v-for="(link, index) in loogedInlinks" v-bind:key="index" class="flex-1 md:flex-none font-bold bg-darkergreen hover:bg-junglegreen text-center h-full">
                <router-link
                  :to="{ name: link.route }"
                  class="inline-block no-underline hover:text-underline px-2 py-2"
                > {{link.name}}</router-link>
          </li>  
          </ul>    
        <ul class="list-reset flex justify-between flex-1 md:flex-none items-center">    
          <li v-if="!loggedIn"  v-for="(link, index) in links" v-bind:key="index" class="flex-1 md:flex-none font-bold  hover:bg-darkergreen text-center h-full">
                <router-link
                  :to="{ name: link.route }"
                  class="inline-block no-underline hover:text-underline py-2 px-4"
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

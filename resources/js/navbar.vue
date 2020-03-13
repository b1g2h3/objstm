<template>
  <nav class="content-wrapper bg-junglegreen px-1 mt-0 h-auto w-full z-20 top-0 text-primary" :class="theme">
    <div class="flex items-baseline container mx-auto">
       <div class="m-4 pl-3">
          <router-link class="" :to="{ name: 'home' }">
            <div class="flex justify-center align-middle">
              <svg class="content-wrapper w-20 h-20 stroke-current text-primary inline-block" width="326" height="234" viewBox="0 0 326 234" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M66.0001 227H265V126C306 126 325.143 105 316 65C306.857 25 251 4 205 41.0001L225 30.0001C225 30.0001 200 7 159 7C118 7 90.0001 41.0001 90.0001 41.0001L100 30.0001C100 30.0001 32.0001 -7.00001 11.0001 57C-9.99987 121 66.0001 126 66.0001 126V227Z" stroke-width="14"/>
              </svg>
            </div>
            <!-- <div class="border-l-4 border-white  ml-5 h-32"></div> -->
            <div class=" flex justify-center align-middle text-2xl font-bold">Šotola</div>
            <div class=" flex justify-center align-middle text-2xl font-bold">Miroslav</div>
          </router-link>
       </div>
      <div class="flex md:justify-end">
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
          <li  class="flex-1 md:flex-none font-bold bg-darkergreen   text-center h-full">
            <div class="inline-block cursor-pointer py-2 px-4">{{user.invoice.nazev}}</div>
            <div class="" @click.prevent="toggleTheme" >
                <svg class="content-wrapper w-10 h-10 stroke-current text-primary inline-block" width="345" height="381" viewBox="0 0 345 381" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M44 279C140 451 306 308 306 308C306 308 186.008 286.159 146 209C104 128 146 31 146 31C146 31 -52 107 44 279Z" stroke-width="34"/>
              </svg>
              Dark mode
            </div>

          </li>      
        </ul>
      </div>
    </div>
  </nav>
</template>
<script>
export default {
  name: 'navbar',
  data() {
    return {
      theme: 'theme-light'
    };
  },
  created() {
    this.theme = localStorage.getItem('theme');
    this.$store.commit('getTheme', this.theme);
  },
  computed: {
    links() {
      return this.$store.state.navbarlinks;
    },
    loogedInlinks() {
      return this.$store.state.loogedInlinks;
    },
    loggedIn() {
      return this.$store.getters.loggedIn;
    },
    user() {
      return this.$store.getters.user;
    }
  },
  methods: {
    toggleTheme() {
      this.theme = this.theme == 'theme-light' ? 'theme-dark' : 'theme-light';
      localStorage.setItem('theme', this.theme);
      this.$store.commit('getTheme', this.theme);
    }
  }
};
</script>

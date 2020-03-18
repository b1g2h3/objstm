<template>
 <div :class="theme" class="w-full bg-junglegreen shadow-lg ">
  <nav class="pt-2 px-1 mt-0 container mx-auto w-full z-20 top-0 text-primary">
    <div class="flex flex-wrap ">
      <div class="md:ml-6 flex flex-shrink justify-center content-center text-center font-bold text-2xl">
        <router-link class="p-2" :to="{ name: 'home' }" >
          <svg class="-mt-3 content-wrapper w-16 h-16 stroke-current text-primary inline-block" width="326" height="234" viewBox="0 0 326 234" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M66.0001 227H265V126C306 126 325.143 105 316 65C306.857 25 251 4 205 41.0001L225 30.0001C225 30.0001 200 7 159 7C118 7 90.0001 41.0001 90.0001 41.0001L100 30.0001C100 30.0001 32.0001 -7.00001 11.0001 57C-9.99987 121 66.0001 126 66.0001 126V227Z" stroke-width="20"/>
          </svg>
          <span class="pl-2">
            Šotola Miroslav
          </span>
        </router-link>
      </div>
      <div class="flex flex-1 justify-end px-2 ">
        <ul v-if="loggedIn" class="list-reset flex justify-between flex-1 md:flex-none items-center font-bold">
				  <li class="flex-1 md:flex-none"   v-for="(link, index) in loogedInlinks" v-bind:key="index">
             <router-link
                  :to="{ name: link.route }"
                  class="inline-block py-2 px-4 no-underline bg-junglegreen"
                > {{link.name}}</router-link>
				  </li>
				  <li class="flex-1 md:flex-none md:mr-3 bg-junglegreen">
						<div class="relative inline-block m-2">
							<button v-if="user" onclick="toggleDD('myDropdown')" class="drop-button focus:outline-none font-bold">{{user.invoice ? user.invoice.nazev : user.email}}<svg class="h-3 fill-current inline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg></button>
                <div id="myDropdown" class="dropdownlist absolute bg-button right-0 mt-3 p-3 overflow-auto z-30 invisible">
                  <router-link  class="p-2 hover:bg-gray-800 text-sm no-underline hover:no-underline block" :to="{ name: 'settings'}">Nastavení</router-link>
                  <div @click.prevent="toggleTheme" class="p-2 hover:bg-gray-800 text-sm no-underline hover:no-underline block">DarkMode</div> 
                  <div class="border border-bg-ivory"></div>
                    <router-link  class="p-2 hover:bg-gray-800 text-sm no-underline hover:no-underline block" :to="{ name: 'logout'}">Odhlásit se</router-link>
                </div>
            </div>
          </li>
        </ul>
        <ul v-else class="list-reset flex justify-between flex-1 md:flex-none items-center font-bold">
          <li class="flex-1 md:flex-none"   v-for="(link, index) in links" v-bind:key="index">
             <router-link
                  :to="{ name: link.route }"
                  class="inline-block py-2 px-4 no-underline bg-junglegreen"
                > {{link.name}}</router-link>
				  </li>
        </ul>
		  </div>
    </div>
  </nav>
 </div>
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
    this.theme = localStorage.getItem('theme') || 'theme-light';
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

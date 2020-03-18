<template>
  <div :class="theme">
    <navbar />
    <sidebar />    
    <div v-if="loggedIn" class="hidden md:block w-full bg-button font-bold text-primary p-2">
      <div class="flex justify-center">
      <!-- <router-link :to="{ name: 'objednat'}" class="pl-2">Objednat zboží</router-link>
      <router-link :to="{ name: 'Orders'}" class="pl-2">Přehled objednávek</router-link> -->
      <router-link :to="{ name: 'showUsers'}" class="pl-2">Přehled uživatelů</router-link>
      <router-link :to="{ name: 'showAllOrders'}" class="pl-2">Přehled objednávek</router-link>
      <router-link :to="{ name: 'admin'}" class="pl-2">Úpravy</router-link>
    </div>
    </div>
    <div class="w-full h-full content-wrapper bg-darkergreen">
      <main class="flex justify-center ">
      <router-view />
    </main>
    </div>
    <foot />
  </div>
</template>

<script>
import navbar from './navbar';
import sidebar from './sidebar';
import foot from './foot';
export default {
  components: {
    navbar,
    sidebar,
    foot
  },
  computed: {
    loggedIn() {
      return this.$store.getters.loggedIn;
    },
    theme(){
      return this.$store.getters.theme;
    }
  },
  created() {
    this.loggedIn ? this.$store.dispatch('getUser') : '';
  }
};
</script>

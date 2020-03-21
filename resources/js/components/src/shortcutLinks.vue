<template>
  <div v-if="loggedIn" class="hidden md:block w-full bg-button font-bold text-primary p-2">
      <div v-if="isAdmin" class="flex justify-center">
        <router-link :to="{ name: 'showUsers'}" class="pl-2">Přehled uživatelů</router-link>
        <router-link :to="{ name: 'showAllOrders'}" class="pl-2">Přehled objednávek</router-link>
        <router-link :to="{ name: 'admin'}" class="pl-2">Úpravy</router-link>
      </div>
      <div v-else class="flex justify-center">
        <router-link :to="{ name: 'objednat'}" class="pl-2">Objednat zboží</router-link>
        <router-link :to="{ name: 'Orders'}" class="pl-2">Přehled objednávek</router-link>
      </div>
    </div>
</template>
<script>
export default {
  name: 'shortcuLinks',
  computed: {
    isAdmin() {
      return this.$store.getters.isAdmin;
    },    
    loggedIn() {
      return this.$store.getters.loggedIn;
    }
  }
};
</script>

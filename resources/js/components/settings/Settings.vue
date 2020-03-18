<template>
  <div>
    <div class="flex">
      <aside class="sidebar">
        <div class="name">Nastavení</div>
        <div class="menu">
          <router-link  class="link" :to="{ name: 'ChangeContact'}">Změnit kontaktní údaje</router-link>        
          <!-- <router-link  class="link" :to="{ name: 'ChangeInvoice'} ">Změnit fakturační údaje</router-link>       -->
          <router-link  class="link" :to="{ name: 'ChangePassword'}">Změnit heslo</router-link>
          <router-link  class="link" :to="{ name: 'logout'}">Odhlásit se</router-link>
        </div>
    </aside>
      <transition name="component-fade" mode="out-in">
        <router-view />
      </transition>
  </div>
  </div>
</template>

<script>
export default {
  name: "AllOrders",
  data() {
    return {
      user: []
    };
  },

  created() {},
  methods: {}
};
</script>
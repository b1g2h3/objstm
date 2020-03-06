<template>
  <div>
    <div class="flex mb-4">
      <aside  class="sidebar">
        <div class="name">Administrator</div>
        <div class="menu">
          <router-link class="link" :to="{ name: 'createCategory'}">Vytvořit kategorii</router-link>
          <router-link class="link" :to="{ name: 'createProduct'} ">Vytvořit produkt</router-link>
          <router-link class="link" :to="{ name: 'showUsers'} ">Přehled uživatelů</router-link>
          <router-link class="link" :to="{ name: 'showAllOrders'} ">Přehled objednávek</router-link>
          <router-link class="link" :to="{ name: 'logout'}">Odhlásit se se</router-link>
        </div>
      </aside >
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
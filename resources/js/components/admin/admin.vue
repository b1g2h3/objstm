<template>
  <div>
    <div class="flex mb-4">
      <div class="h-screen w-1/6 bg-blue-800 text-white">
        <div class="text-center p-2 text-2xl">Administrator</div>
        <div class="text-center p-2">
          <router-link :to="{ name: 'createCategory'}">Vytvořit kategorii</router-link>
        </div>
        <div class="text-center p-2">
          <router-link :to="{ name: 'createProduct'} ">Vytvořit produkt</router-link>
        </div>
        <div class="text-center p-2">
          <router-link :to="{ name: 'showUsers'} ">Přehled uživatelů</router-link>
        </div>
        <div class="text-center p-2">
          <router-link :to="{ name: 'showAllOrders'} ">Přehled objednávek</router-link>
        </div>
        <div class="text-center p-2">
          <router-link :to="{ name: 'logout'}">Odhlásit se se</router-link>
        </div>
      </div>
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
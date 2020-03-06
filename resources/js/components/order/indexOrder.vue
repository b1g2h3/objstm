<template>
  <div>
    <div class="flex mb-4">
      <aside class="sidebar">
        <div class="name">Objednávky</div>
        <div class="menu">
        <div v-if="!ordersFilter" class="link">
          Nemáte žádné objednávky
        </div>
          <router-link v-if="orders" class="link" v-for="order in orders" v-bind:key="order.id"
            :to="{ name: 'ShowOrder', params: {id: order.id} }"
          >č. {{order.id}} {{order.status}}</router-link>
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
  created() {
    this.$store.dispatch("retrieveOrders");
  },
  computed: {
    orders() {
      return this.$store.getters.orders;
    },
    ordersFilter() {
      return this.$store.getters.ordersFilter;
    }
  }
};
</script>
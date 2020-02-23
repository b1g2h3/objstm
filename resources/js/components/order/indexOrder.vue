<template>
  <div>
    <div class="flex mb-4">
      <div class="h-screen w-1/6 bg-blue-800 text-white">
        <div class="text-center p-2 text-2xl">Objednávky</div>
        <div v-if="!ordersFilter" class="text-center p-2">
          Nemáte žádné objednávky
        </div>
        <div v-if="orders" class="text-center p-2" v-for="order in orders" v-bind:key="order.id">
          <router-link
            :to="{ name: 'ShowOrder', params: {id: order.id} }"
          >č. {{order.id}} {{order.status}}</router-link>
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
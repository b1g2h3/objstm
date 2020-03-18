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
            :class="order.id == activeOrder.id ? 'font-bold text-junglegreen font-base' : ''"
          >č. {{order.id}} 
            <i :class="order.status == 'Rozpracovaná' ? 'fa-pen' : 'fa-check'" class="fas"></i>
              {{order.created_at | formatDate }}
          </router-link>
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
    },
    activeOrder() {
      return this.$store.getters.order;
    },
  }
};
</script>
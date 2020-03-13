<template>
  <div>
    <navbar />
    <sidebar />
    <div class="w-full h-full content-wrapper bg-darkergreen" :class="theme">
      <main class="container mx-auto">
      <router-view />
    </main>
    </div>
  </div>
</template>

<script>
import navbar from './navbar';
import sidebar from './sidebar';
export default {
  components: {
    navbar,
    sidebar
  },
  computed: {
    loggedIn() {
      return this.$store.getters.loggedIn;
    },
    theme() {
      return this.$store.getters.theme;
    }
  },
  created() {
    this.loggedIn ? this.$store.dispatch('getUser') : '';
  }
};
</script>

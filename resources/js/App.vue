<template>
  <div>
    <navbar />
    <sidebar />
    <main class="container bg-davygrayn mx-auto">
      <router-view />
    </main>
  </div>
</template>

<script>
import navbar from "./navbar";
import sidebar from "./sidebar";
export default {
  components: {
    navbar,
    sidebar
  },
  computed: {
    loggedIn() {
      return this.$store.getters.loggedIn;
    }
  },
  created() {
    this.loggedIn ? this.$store.dispatch("getUser") : "";
  }
};
</script>

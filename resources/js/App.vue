<template>
    <div>
        <navbar />
        <div class="flex flex-col md:flex-row">
            <sidebar />

            <div
                class="main-content flex-1 bg-gray-100 mt-2 md:mt-2 pb-24 md:pb-5"
            >
                <div v-if="!loggedIn" class="container mx-auto">
                    <router-view />
                </div>
                <div v-else>
                    <router-view/>
                </div>
               
            </div>
        </div>
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

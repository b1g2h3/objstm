<template>
  <div>
    <div v-if="loading" class="loader">
      <div class="inner one"></div>
      <div class="inner two"></div>
      <div class="inner three"></div>
    </div>

    <div
      class="bg-blue-800 p-2 shadow text-xl text-white border-l-8 border-green-600 shadow-lg p-5"
    >
      <h3 class="font-bold pl-2">Přehled všech uživatelů</h3>
    </div>

    <div class="flex flex-wrap">
      <div class="w-full">
        <div
          class="bg-green-100 border-t-4 border-b-4 border-green-600 rounded-lg shadow-lg m-1 ml-3"
        >
          {{allUsers}}
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "allUsers",
  props: {
    id: ""
  },
  data() {
    return {
      loading: false
    };
  },
  created() {
    this.$store.dispatch("allUsers");
  },
  computed: {
    allUsers() {
      return this.$store.getters.allUsers;
    }
  }
};
</script>
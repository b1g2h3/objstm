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
      <h3 class="font-bold pl-2">{{category.name}}</h3>
    </div>

    <div class="flex flex-wrap">
      <div class="w-full">
        <!--Metric Card-->
        <div
          class="bg-green-100 border-t-4 border-b-4 border-green-600 rounded-lg shadow-lg m-1 ml-3"
        >
          <div v-if="category">
            <table class="table-fixed">
              <thead>
                <tr>
                  <th class="w-1/4 px-4 py-2">Číslo produktu</th>
                  <th class="w-1/2 px-4 py-2">Název</th>
                  <th class="w-1/4 px-4 py-2">Balení</th>
                  <th class="w-1/4 px-4 py-2">Možnost</th>
                </tr>
              </thead>
              <tbody>
                <tr v-bind:key="product.id" v-for="product in category.products">
                  <td class="border px-4 py-2">{{product.id}}</td>
                  <td class="border px-4 py-2">{{product.name}}</td>
                  <td class="border px-4 py-2">{{product.hmotnost}}</td>
                  <td class="border px-4 py-2">Upravit Odstranit</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <!--/Metric Card-->
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "ShowCategory",
  props: {
    id: ""
  },
  data() {
    return {
      loading: false
    };
  },
  created() {
    this.$store.dispatch("fetchCategory", this.id);
  },
  computed: {
    category() {
      return this.$store.getters.category;
    }
  },
  watch: {
    $route(to, from) {
      if (from.params.id !== to.params.id) {
        this.$store.dispatch("fetchCategory", this.id);
      }
    }
  }
};
</script>
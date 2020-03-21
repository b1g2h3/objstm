<template>
   <div class="">
      <div
      class="header"
    >
      <h3>{{category.name}}</h3>
    </div>

    <div class="flex flex-wrap">
      <div class="w-full">
        <div
          class="table"
        >
          <div v-if="category">            
            <table class="table-fixed">
              <thead>
                <tr>
                  <th class="w-1/4 px-4 py-2">Číslo produktu</th>
                  <th class="w-1/2 px-4 py-2">Název</th>
                  <th class="w-1/4 px-4 py-2">Balení</th>
                  <!-- <th class="w-1/4 px-4 py-2">Možnost</th> -->
                </tr>
              </thead>
              <tbody>
                <tr v-bind:key="product.id" v-for="product in category.products">
                  <td class="border px-4 py-2">{{product.id}}</td>
                  <td class="border px-4 py-2">{{product.name}}</td>
                  <td class="border px-4 py-2">{{product.hmotnost}}</td>
                  <!-- <td class="border px-4 py-2">Upravit Odstranit</td> -->
                </tr>
              </tbody>
            </table>
          </div>
        </div>
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
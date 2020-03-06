<template>
  <div>
    <div v-if="loading" class="loader">
      <div class="inner one"></div>
      <div class="inner two"></div>
      <div class="inner three"></div>
    </div>

    <div
    class="header"
    >
      <h3>Vytvořit produkt</h3>
    </div>

    <div class="flex flex-wrap">
      <div class="w-full">
        <div
              class="table"
        >
             <form @submit.prevent="addProduct" class="w-full max-w-lg p-5">
            <div class="flex flex-wrap -mx-3 mb-6">
              <div class="w-full px-3">
                <label class="ares-label" for="name">Název produktu</label>
                <input
                  class="ares-input"
                  id="name"
                  type="text"
                  v-bind:class="{ 'border-red-500': errors.name }"
                  v-model="product.name"
                />
                <p v-if="errors.name" class="text-red-500 text-xs italname">{{errors.name[0]}}</p>
              </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
              <div class="w-full px-3">
                <label class="ares-label" for="category_id">Kategorie</label>
                  <select  class="ares-input"  v-model="product.category_id" id="category_id">
                    <option selected v-bind:value="Vyberte">Vyberte kategorii</option>
                    <option class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline" v-for="category in categories" v-bind:key="category.id" v-bind:value="category.id" >{{category.name}}</option>
                  </select>
                   <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                  </div>
                <p v-if="errors.category_id" class="text-red-500 text-xs italname">{{errors.category_id[0]}}</p>
              </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
              <div class="w-full px-3">
                <label class="ares-label" for="hmotnost">Gramáž</label>
                <input
                  class="ares-input"
                  id="hmotnost"
                  type="text"
                  v-bind:class="{ 'border-red-500': errors.hmotnost }"
                  v-model="product.hmotnost"
                />
                <p v-if="errors.hmotnost" class="text-red-500 text-xs italhmotnost">{{errors.hmotnost[0]}}</p>
              </div>
            </div>
            <div class="md:flex md:items-center">
              <div class="md:w-2/3">
                <button
                  class="success"
                  type="submit"
                >Vytvořit produkt</button>
              </div>
              <div class="md:w-2/3"></div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "createProduct",
  data() {
    return {
      loading: false,
      product: {},
      errors: ""
    };
  },
  created() {
    this.$store.dispatch("fetchCategories");
  },
  computed: {
    categories() {
      return this.$store.getters.categories;
    }
  },
  methods: {
    addProduct() {
      this.errors = [];
      this.axios
        .post(`product`, this.product, {
          headers: {
            Authorization: "Bearer " + localStorage.getItem("access_token")
          }
        })
        .then(res => {
          console.log("true");
        })
        .catch(error => {
          if (error.response.status == 422) {
            this.errors = error.response.data.errors;
          }
        });
    }
  }
};
</script>
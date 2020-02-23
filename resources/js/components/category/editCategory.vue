<template>
  <div>
    <div v-if="loading" class="loader">
      <div class="inner one"></div>
      <div class="inner two"></div>
      <div class="inner three"></div>
    </div>

    <div
    class="bg-blue-800 p-2 shadow text-xl text-white border-l-8 border-green-600 shadow-lg p-3"
    >
      <h3 class="font-bold pl-2">Upravit kategorii</h3>
    </div>

    <div class="flex flex-wrap">
      <div class="w-full">
        <div
              class="bg-green-100 border-t-4 border-b-4 border-green-600 rounded-lg shadow-lg m-1 ml-3"
        >
             <form @submit.prevent="editCategory" class="w-full max-w-lg p-5">
        <div class="flex flex-wrap -mx-3 mb-6">
              <div class="w-full px-3">
                <label
                  class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                  for="name"
                >Název kategorie</label>
                <input
                  class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                  id="name"
                  type="text"
                  v-bind:class="{ 'border-red-500': errors.name }"
                  v-model="category.name"
                  autocomplete="name"
                />
                <p
                  v-if="errors.name"
                  class="text-red-500 text-xs italic"
                >{{errors.name[0]}}</p>
              </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
              <div class="w-full px-3">
                <label class="ares-label" for="name">Obrázek kategorie</label>
                <input type="file" @change="processFile($event)">
                <p v-if="errors.image" class="text-red-500 text-xs italname">{{errors.image[0]}}</p>
              </div>
            </div>
            <div class="md:flex md:items-center">
              <div class="md:w-2/3">
                <button
                  class="shadow bg-blue-800 hover:bg-blue-600 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"
                  type="submit"
                >Upravit</button>
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
  name: "editCategory",
  props: {
    id: ""
  },
  data() {
    return {
      loading: false,
      errors: ""
    };
  },
  created() {
    this.$store.dispatch("fetchCategories");
    this.$store.dispatch("fetchCategory", this.id);
  },
  computed: {
    categories() {
      return this.$store.getters.categories;
    },
    category() {
      return this.$store.getters.category;
    }
  },
  methods: {
    editCategory() {
      this.errors = [];
      console.log(this.category);
      // this.axios
      //   .post(`category`, this.category, {
      //     headers: {
      //       Authorization: "Bearer " + localStorage.getItem("access_token")
      //     }
      //   })
      //   .then(res => {
      //     console.log("true");
      //   })
      //   .catch(error => {
      //     if (error.response.status == 422) {
      //       this.errors = error.response.data.errors;
      //     }
      //   });
    },
    processFile(event) {
      this.category.image = event.target.files[0];
    }
  }
};
</script>
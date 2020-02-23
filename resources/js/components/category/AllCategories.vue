<template>
  <div class="flex ">
    <div v-if="!['zbozi'].includes($route.name)"  class="flex flex-col bg-blue-800 text-white pt-14 w-1-6 pt-14">
      <div class="text-center p-2 text-2xl">Kategorie</div>
        <router-link  class="text-center p-2" v-for="category in categories" v-bind:key="category.id" :to="{ name: 'category_show', params: {id: category.id} }">{{category.name}}</router-link>

    </div>
    <div v-if="['zbozi'].includes($route.name)" class="flex flex-wrap md:w-6/6 p-5">
        <div v-if="successMessage" class="bg-blue-100 w-full border-t border-b border-blue-500 text-blue-700 px-4 py-3" role="alert">
            <p class="font-bold">{{successMessage}}</p>
          </div>
          <div v-for="category in categories" v-bind:key="category.id" class="w-full sm:w-1/2 md:w-1/5 mb-4 m-2 pt-14">
          <div class="relative w-30 h-30 ">
          <router-link class="" :to="{ name: 'category_show', params: {id: category.id} }">
            <div class="w-full h-full absolute bg-black opacity-25 hover:opacity-0  cursor-pointer"></div>
            <img  src="https://www.mundo.cz/sites/default/files/images/srbsko/srbsko-jidlo-raznjici.jpg">
            <div class="text-xl text-white pl-2   absolute -mt-10">{{category.name}}</div>
          </router-link>
          </div>
            <router-link v-if="isAdmin"  :to="{ name: 'editCategory', params: {id: category.id} }" class="inline-block bg-blue-600 hover:bg-blue-800 text-sm font-semibold  w-full text-white p-2 text-center">Upravit</router-link>
            <a v-if="isAdmin" @click="deleteCategory(category.id)" class="inline-block bg-red-600 hover:bg-red-800 text-sm font-semibold  w-full text-white p-2 text-center">Odstranit</a>
        </div>
       </div>
    <transition name enter-active-class="animated fadeIn" leave-active-class="animated fadeIn">
      <router-view />
    </transition>
  </div>
</template>

<script>
export default {
  name: "AllCategories",
  data() {
    return {
      successMessage: "",
      errors: []
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
    deleteCategory(id) {
      this.errors = [];
      this.successMessage = [];
      this.$store
        .dispatch("deleteCategory", id)
        .then(response => {
          this.successMessage = "Úspěšně jste odstranili kategorii";
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
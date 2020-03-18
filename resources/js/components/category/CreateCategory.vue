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
      <h3>Vytvořit kategorii</h3>
    </div>

    <div class="flex flex-wrap">
      <div class="w-full">
        <div
              class="table"
        >
             <form @submit.prevent="createCategory" class="w-full max-w-lg p-5">
            <div class="flex flex-wrap -mx-3 mb-6">
              <div class="w-full px-3">
                <label class="ares-label" for="name">Název kategorie</label>
                <input
                  class="ares-input"
                  id="name"
                  type="text"
                  v-bind:class="{ 'border-red-500': errors.name }"
                  v-model="category.name"
                />
                <p v-if="errors.name" class="text-red-500 text-xs italname">{{errors.name[0]}}</p>
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
              <div class="w-full">
                <button
                  class="success"
                  type="submit"
                >Vytvořit kategorii</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "createCategory",
  props: {
    id: ""
  },
  data() {
    return {
      loading: false,
      category: {},
      errors: ""
    };
  },
  methods: {
    createCategory() {
      this.errors = [];
      this.axios
        .post(`category`, this.category, {
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
    },
    processFile(event) {
      this.category.image = event.target.files[0];
    }
  }
};
</script>
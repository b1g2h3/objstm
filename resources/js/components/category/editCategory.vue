<template>
    <div>
        <div
            class="header"
        >
            <h3>Upravit kategorii</h3>
        </div>

        <div class="flex flex-wrap">
            <div class="w-full">
                <div
                    class="table"
                >
                    <form
                        @submit.prevent="editCategory"
                        class="w-full max-w-lg p-5"
                        enctype="multipart/form-data"
                    >
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <label
                                    class="ares-label"
                                    for="name"
                                    >Název kategorie</label
                                >
                                <input
                                    class="ares-input"
                                    id="name"
                                    type="text"
                                    v-bind:class="{
                                        'border-red-500': errors.name
                                    }"
                                    v-model="category.name"
                                    autocomplete="name"
                                />
                                <p
                                    v-if="errors.name"
                                    class="text-red-500 text-xs italic"
                                >
                                    {{ errors.name[0] }}
                                </p>
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <label class="ares-label" for="name"
                                    >Obrázek kategorie</label
                                >
                                 <input type="file" v-on:change="onImageChange" class="form-control">
                                <p
                                    v-if="errors.image"
                                    class="text-red-500 text-xs italname"
                                >
                                    {{ errors.image[0] }}
                                </p>
                            </div>
                        </div>
                         <div class="col-md-3" v-if="image">
                              <img :src="image" class="img-responsive" height="70" width="90">
                           </div>
                        <div class="md:flex md:items-center">
                            <div class="md:w-2/3">
                                <button
                                    class="shadow bg-blue-800 hover:bg-blue-600 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded flex"
                                    type="submit"
                                    :disabled="loading"
                                >
                                
                                    <div v-if="loading" class="loader">
                                        <div class="inner one"></div>
                                        <div class="inner two"></div>
                                        <div class="inner three"></div>
                                    </div>
                                    <div>
                                        Upravit
                                    </div>
                                </button>
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
      image: "",
      errors: "",
      successMessage: ""
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
     this.loading = true;
      axios.post( '/category/'+this.id,
       {
         name: this.category.name,
         image: this.image,
         headers: {'Content-Type': 'multipart/form-data' }
        },
        )
        .then(response => {
          this.loading = false;
          this.successMessage = "Úspěšně jste upravili kategorii";
          this.$router.push({
            name: "zbozi",
            params: { dataSuccessMessage: this.successMessage }
          });
        })
        .catch(error => {
          if (error.response.status == 422) {
            this.errors = error.response.data.errors;
          }
        });
    },
    onImageChange(e) {
        let files = e.target.files || e.dataTransfer.files;
        if (!files.length)
            return;
            this.createImage(files[0]);
        },
    createImage(file) {
        let reader = new FileReader();
        let vm = this;
        reader.onload = (e) => {
            vm.image = e.target.result;
        };
        reader.readAsDataURL(file);
        },
 
  }
};
</script>

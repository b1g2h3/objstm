<template>
  <div>
     <div>
     <div class="max-w-3xl flex   flex-wrap  lg:my-0 p-5">
	<div id="login" class="w-full lg:w-3/5 rounded-lg lg:rounded-l-lg lg:rounded-r-none shadow-2xl bg-white opacity-75 mx-6 lg:mx-0">
	

		<div class="p-4 md:p-12  text-center lg:text-left">
				<h1 class="text-3xl font-bold pt-8 lg:pt-0">Přihlásit se</h1>
        	<div class="mx-auto lg:mx-0 w-4/5 pt-3 border-b-2 border-teal-500 opacity-25"></div>
    <form @submit.prevent="login" class="w-full max-w-lg ">
      <div v-if="successMessage" class="bg-blue-100 w-full border-t border-b border-blue-500 text-blue-700 px-4 py-3" role="alert">
        <p class="font-bold">{{successMessage}}</p>
      </div>
      <div class="flex flex-wrap -mx-3 mb-6">
      <div class="w-full px-3">
        <label
           class=" text-base font-bold flex pl-2 justify-start lg:justify-start"
          for="email"
        >E-mail</label>
        <input
          class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
          id="email"
          type="email"
          v-bind:class="{ 'border-red-500': errors.username }"
          v-model="username"
        />
        <p v-if="errors.username" class="text-red-500 text-xs italic">{{errors.username[0]}}</p>
      </div>
    </div>
      <div class="flex flex-wrap -mx-3 mb-6">
      <div class="w-full px-3">
        <label
           class=" text-base font-bold flex pl-2 justify-start lg:justify-start"
          for="current-password"
        >Heslo</label>
        <input
          class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
          id="current-password"
          type="password"
          v-bind:class="{ 'border-red-500': errors.password }"
          v-model="password"
        />
        <p v-if="errors.password" class="text-red-500 text-xs italic">{{errors.password[0]}}</p>
      </div>
    </div>

    <div class="md:flex md:items-center">
      <div class="md:w-2/3">
        <button
          class="shadow bg-blue-800 hover:bg-blue-600 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded flex"
          type="submit" :disabled="loading"
        >
            <div v-if="loading" class="loader">
              <div class="inner one"></div>
              <div class="inner two"></div>
              <div class="inner three"></div>
            </div>
          <div>
            Přihlásit se
          </div>
          </button>

          
      </div>
    </div>
  </form>

		</div>

	</div>
	
	<div class="w-full lg:w-1/5">
		<div class=" bg-white rounded-none lg:rounded-lg shadow-2xl hidden lg:block text-center">
           <router-link
                  :to="{ name: 'register' }"
                  class=" w-full  shadow bg-green-800 hover:bg-blue-600 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded flex"
                > Registrovat se</router-link>
    </div>
	</div>
</div>
  </div>
  </div>
</template>

<script>
export default {
  name: "login",
  props: {
    dataSuccessMessage: {
      type: String
    }
  },
  data() {
    return {
      username: "",
      password: "",
      errors: "",
      successMessage: this.dataSuccessMessage,
      loading: false
    };
  },
  methods: {
    login() {
      this.errors = [];
      this.loading = true;
      this.$store
        .dispatch("retrieveToken", {
          username: this.username,
          password: this.password
        })
        .then(response => {
          this.loading = false;
          this.$store.dispatch("getUser");
          this.$router.push({ name: "objednat" });
        })
        .catch(error => {
          if (error.response.status == 422) {
            this.errors = error.response.data.errors;
          }
          this.password = "";
          this.successMessage = "";
          this.loading = false;
        });
    }
  }
};
</script>

<template>
  <form @submit.prevent="register" class="w-full max-w-lg p-20">
      <div class="flex flex-wrap -mx-3 mb-6">
      <div class="w-full px-3">
        <label
          class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
          for="email"
        >E-mail</label>
        <input
          class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
          id="email"
          type="email"
          v-bind:class="{ 'border-red-500': errors.email }"
          v-model="email"
        />
        <p v-if="errors.email" class="text-red-500 text-xs italic">{{errors.email[0]}}</p>
      </div>
    </div>
      <div class="flex flex-wrap -mx-3 mb-6">
      <div class="w-full px-3">
        <label
          class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
          for="phone"
        >Telefonní číslo</label>
        <input
          class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
          id="phone"
          type="phone"
          v-bind:class="{ 'border-red-500': errors.phone }"
          v-model="phone"
        />
        <p v-if="errors.phone" class="text-red-500 text-xs italic">{{errors.phone[0]}}</p>
      </div>
    </div>
    <div class="flex flex-wrap -mx-3 mb-6">
      <div class="w-full px-3">
        <label
          class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
          for="password"
        >Heslo</label>
        <input
          class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
          id="password"
          type="password"
          v-bind:class="{ 'border-red-500': errors.password }"
          v-model="password"
        />
        <p v-if="errors.password" class="text-red-500 text-xs italic">{{errors.password[0]}}</p>
      </div>
    </div>
       <div class="flex flex-wrap -mx-3 mb-6">
              <div class="w-full px-3">
                <label
                  class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                  for="password-confirm"
                >Potvrďte heslo</label>
                <input
                  class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                  id="password-confirm"
                  type="password"
                  v-bind:class="{ 'border-red-500': errors.confirm_password }"
                  v-model="confirm_password"
                  autocomplete="new-password"
                />
                <p
                  v-if="errors.confirm_password"
                  class="text-red-500 text-xs italic"
                >{{errors.confirm_password[0]}}</p>
              </div>
            </div>   

    <div class="md:flex md:items-center">
      <div class="md:w-2/3">
        <button
          class="shadow bg-blue-800 hover:bg-blue-600 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"
          type="submit"
        >Přihlásit se</button>
      </div>
      <div class="md:w-2/3"></div>
    </div>
  </form>
</template>

<script>
export default {
  data() {
    return {
      phone: "",
      email: "",
      password: "",
      confirm_password: "",
      errors: {}
    };
  },
  methods: {
    register() {
      this.$store
        .dispatch("register", {
          email: this.email,
          phone: this.phone,
          password: this.password,
          confirm_password: this.confirm_password
        })
        .then(response => {
          this.loading = false;
          this.successMessage = "Úspěšně jste byly zaregistrováni";
          this.$router.push({
            name: "login",
            params: { dataSuccessMessage: this.successMessage }
          });
        })
        .catch(error => {
          if (error.response.status == 422) {
            this.errors = error.response.data.errors;
          }
          this.password = "";
        });
    }
  }
};
</script>
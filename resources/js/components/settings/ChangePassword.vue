<template>
  <div class="w-1/2">
    <div
      class="bg-blue-800 p-2 shadow text-xl text-white border-l-8 border-green-600 shadow-lg p-3"
    >
      <h3 class="font-bold pl-2">Změna heslo</h3>
    </div>
    <div class="flex flex-wrap">
      <div v-if="successMessage" class="bg-blue-100 w-full border-t border-b border-blue-500 text-blue-700 px-4 py-3" role="alert">
        <p class="font-bold">{{successMessage}}</p>
      </div>
      <div class="w-full">
        <div
          class="bg-green-100 border-t-4 border-b-4 border-green-600 rounded-lg shadow-lg m-1 ml-3"
        >
          <input
            type="text"
            name="email"
            value="..."
            autocomplete="username email"
            style="display: none;"
          />
          <form @submit.prevent="changePassword" class="w-full max-w-lg p-5">
            <div class="flex flex-wrap -mx-3 mb-6">
              <div class="w-full px-3">
                <label
                  class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                  for="old_password"
                >Staré heslo</label>
                <input
                  class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                  id="old_password"
                  type="password"
                  v-bind:class="{ 'border-red-500': errors.old_password }"
                  v-model="user.old_password"
                  autocomplete="old_password"
                />
                <p
                  v-if="errors.old_password"
                  class="text-red-500 text-xs italic"
                >{{errors.old_password[0]}}</p>
              </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
              <div class="w-full px-3">
                <label
                  class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                  for="new-password"
                >Heslo</label>
                <input
                  class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                  id="new-password"
                  type="password"
                  v-bind:class="{ 'border-red-500': errors.password }"
                  v-model="user.password"
                  autocomplete="new-password"
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
                  v-model="user.confirm_password"
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
                >Změnit údaje</button>
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
  data() {
    return {
      user: {
        password: "",
        confirm_password: "",
        old_password: ""
      },
      successMessage: "",
      errors: []
    };
  },
  methods: {
    changePassword() {
      this.errors = [];
      this.successMessage = [];
      axios
        .patch("/changePassword", this.user, {
          headers: {
            Authorization: "Bearer " + localStorage.getItem("access_token")
          }
        })
        .then(response => {
          this.successMessage = "Úspěšně jste změnili heslo";
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
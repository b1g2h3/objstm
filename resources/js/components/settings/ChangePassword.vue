<template>
  <div class="w-full">
    <div
      class="header"
    >
      <h3>Změna heslo</h3>
    </div>
    <div class="flex flex-wrap">
      <div v-if="successMessage" class="bg-blue-100 w-full border-t border-b border-blue-500 text-blue-700 px-4 py-3" role="alert">
        <p class="font-bold">{{successMessage}}</p>
      </div>
      <div class="w-full">
        <div
          class="table"
        >
          <input
            type="text"
            name="email"
            value="..."
            autocomplete="email"
            style="display: none;"
          />
          <form @submit.prevent="changePassword" class="w-full max-w-lg p-5">
            <div class="flex flex-wrap -mx-3 mb-6">
              <div class="w-full px-3">
                <label
                  class="ares-label"
                  for="old_password"
                >Staré heslo</label>
                <input
                  class="ares-input"
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
                  class="ares-label"
                  for="new-password"
                >Heslo</label>
                <input
                  class="ares-input"
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
                  class="ares-label"
                  for="password-confirm"
                >Potvrďte heslo</label>
                <input
                  class="ares-input"
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
              <div class="w-full">
                <button
                  class="success"
                  type="submit"
                >Změnit údaje</button>
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
<template>
  <div class="w-1/2">
    <div
      class="header"
    >
      <h3>Přidat fakturačních údaje</h3>
    </div>
    <div class="flex flex-wrap" v-if="!aresData">
      <div class="w-full">
        <div
          class="table"
        >
          <form @submit.prevent="addInvoice" class="w-full max-w-lg p-5">
            <div class="flex flex-wrap -mx-3 mb-6">
              <div class="w-full px-3">
                <label class="ares-label" for="ic">IČ</label>
                <input
                  class="ares-input"
                  id="ic"
                  type="value"
                  v-bind:class="{ 'border-red-500': errors.ic }"
                  v-model="user.ic"
                />
                <p v-if="errors.ic" class="text-red-500 text-xs italic">{{errors.ic[0]}}</p>
              </div>
            </div>
            <div class="md:flex md:items-center">
              <div class="md:w-2/3">
                <button
                  class="success"
                  type="submit"
                >Zadejte IČ</button>
              </div>
              <div class="md:w-2/3"></div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="flex flex-wrap" v-else>
      <div class="w-full">
        <div
          class="table"
        >
          <form @submit.prevent="createInvoice" class="w-full max-w-lg p-5">
            <div class="flex flex-wrap -mx-3 mb-6">
              <div class="w-full px-3">
                <label class="ares-label" for="ic">IČ</label>
                <input
                  class="ares-input"
                  id="ic"
                  type="text"
                  v-bind:class="{ 'border-red-500': errors.ic }"
                  v-model="aresData.ic"
                />
                <p v-if="errors.ic" class="text-red-500 text-xs italic">{{errors.ic[0]}}</p>
              </div>
            </div>
            <div v-if="aresData.dic" class="flex flex-wrap -mx-3 mb-6">
              <div class="w-full px-3">
                <label class="ares-label" for="dic">DIČ</label>
                <input
                  class="ares-input"
                  id="dic"
                  type="text"
                  v-bind:class="{ 'border-red-500': errors.dic }"
                  v-model="aresData.dic"
                />
                <p v-if="errors.dic" class="text-red-500 text-xs italic">{{errors.dic[0]}}</p>
              </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
              <div class="w-full px-3">
                <label class="ares-label" for="nazev">Název</label>
                <input
                  class="ares-input"
                  id="nazev"
                  type="text"
                  v-bind:class="{ 'border-red-500': errors.nazev }"
                  v-model="aresData.nazev"
                />
                <p v-if="errors.nazev" class="text-red-500 text-xs italic">{{errors.nazev[0]}}</p>
              </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
              <div class="w-full md:w-2/4 px-3 mb-6 md:mb-0">
                <label class="ares-label" for="Ulice">Ulice</label>
                <input
                  class="ares-input"
                  id="Ulice"
                  type="text"
                  v-bind:class="{ 'border-red-500': errors.ulice }"
                  v-model="aresData.ulice"
                />
                <p v-if="errors.ulice" class="text-red-500 text-xs italic">{{errors.ulice[0]}}</p>
              </div>

              <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                <label class="ares-label" for="mesto">Město</label>
                <input
                  class="ares-input"
                  id="mesto"
                  type="text"
                  v-bind:class="{ 'border-red-500': errors.mesto }"
                  v-model="aresData.mesto"
                />
                <p v-if="errors.mesto" class="text-red-500 text-xs italic">{{errors.mesto[0]}}</p>
              </div>
              <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                <label class="ares-label" for="psc">PSČ</label>
                <input
                  class="ares-input"
                  id="psc"
                  type="text"
                  v-bind:class="{ 'border-red-500': errors.dic }"
                  v-model="aresData.psc"
                />
                <p v-if="errors.dic" class="text-red-500 text-xs italic">{{errors.psc[0]}}</p>
              </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
              <div class="w-full md:w-2/4 px-3 mb-6 md:mb-0">
                <label class="ares-label" for="stat">Stát</label>
                <input
                  class="ares-input"
                  id="stat"
                  type="text"
                  v-bind:class="{ 'border-red-500': errors.stat }"
                  v-model="aresData.zeme"
                />
                <p v-if="errors.zeme" class="text-red-500 text-xs italic">{{errors.zeme[0]}}</p>
              </div>
            </div>
            <div class="md:flex md:items-center">
              <div class="md:w-2/3 flex">
                <button
                  class="success"
                  type="submit"
                >Potvrdit údaje</button>
                <button
                  class="ml-2 shadow bg-red-800 hover:bg-red-600 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"
                  type="menu"
                >Zrušit</button>
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
  name: "AddInvoice",
  data() {
    return {
      user: {
        ic: ""
      },
      aresData: null,
      edit: false,
      errors: ""
    };
  },
  created() {},
  methods: {
    addInvoice() {
      this.errors = [];
      if (!this.edit) {
        this.sendData("/ares", this.user);
      } else {
        //send
        this.axios
          .post(`invoice`, this.aresData, {
            headers: {
              Authorization: "Bearer " + localStorage.getItem("access_token")
            }
          })
          .then(res => {
            this.$router.push({ name: "objednat" });
          })
          .catch(error => {
            if (error.response.status == 422) {
              this.errors = error.response.data.errors;
            }
          });
      }
    },
    createInvoice() {
      this.edit = true;
      this.addInvoice();
      this.aresData.user_id = this.$userId;
    },
    sendData(url, data) {
      this.axios
        .post(url, data, {
          headers: {
            Authorization: "Bearer " + localStorage.getItem("access_token")
          }
        })
        .then(res => {
          this.aresData = res.data.data;
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
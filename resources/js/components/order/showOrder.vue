<template>
    <div>
        <div
            class="header"
        >
            <h3>Objednávka č. <span class="text-junglegreen">{{ order.id }}</span></h3>
        </div>

        <div class="flex flex-wrap">
            <div class="w-full">
                <div
                    class="table"
                >
                  <userDetails/>
                </div>
                <div
                    class="table mt-3"
                >
                  <tableOrderList />
                </div>
                <div
                    class="table mt-3"
                >
                    <div v-if="order.status == 'Rozpracovaná'">
                        <div class="flex flex-wrap">
                            <div class="w-full px-3">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 pt-2"
                                    for="message"
                                    >Podrobnosti</label
                                >
                                <textarea
                                    class="no-resize appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 h-24 resize-none"
                                    id="message"
                                    placeholder="Místo pro vaši poznámku?"
                                    v-model="description"
                                ></textarea>
                            </div>
                        </div>
                        <div class="p-3">
                            <button
                                class="bg-transparent hover:bg-green-700 text-black font-semibold hover:text-white py-2 px-4 border border-green-700 hover:border-transparent rounded"
                                v-on:click="confirmOrder"
                            >
                                Potvrdit objednávku
                            </button>
                            <button
                                class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded"
                                v-on:click="editOrder"
                            >
                                Upravit objednávku
                            </button>
                            <button
                                class="bg-transparent hover:bg-red-700 text-black font-semibold hover:text-white py-2 px-4 border border-red-700 hover:border-transparent rounded"
                                v-on:click="deleteOrder"
                            >
                                Zrušit objednávku
                            </button>
                        </div>
                    </div>
                    <div v-else class="p-4">
                        <div class="text-bold uppercase font-bold">
                            Objednávka je {{ order.status }}
                        </div>
                        <div v-if="order.description">
                            <span class="font-bold">Vaše poznámka:</span> {{ order.description }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import userDetails from "./userDetails";
import tableOrderList from "./tableOrderList";
export default {
  name: "ShowOrder",
  components: {
    tableOrderList,
    userDetails
  },
  props: {
    id: ""
  },
  data() {
    return {
      loading: false,
      description: null,
      successMessage: ""
    };
  },
  created() {
    this.$store.dispatch("fetchOrder", this.id);
  },
  computed: {
    order() {
      return this.$store.getters.order;
    }
  },
  watch: {
    $route(to, from) {
      if (from.params.id !== to.params.id) {
        this.$store.dispatch("fetchOrder", this.id);
      }
    }
  },
  methods: {
    confirmOrder() {
      let data = {"id": this.id, "description": this.description}
      this.$store.dispatch("confirmOrder", data)
    },
    deleteOrder() {
      this.$store.dispatch("deleteOrder", this.id);
      this.$router.push({
        name: "Orders"
      });
    },
    editOrder() {
      this.$router.push({
        name: "EditOrder",
        params: { id: this.id }
      });
    }
  }
};
</script>

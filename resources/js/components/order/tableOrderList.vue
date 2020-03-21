<template>
    <table class="table-fixed">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Produkt</th>
                            <th class="px-4 py-2">Hmotnost</th>
                            <th class="px-4 py-2">Množství</th>
                            <th
                                v-if="order.status == 'rozpracovaná'"
                                class="px-4 py-2"
                            >
                                Možnosti
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-bind:key="amount.id"
                            v-for="amount in order.amounts"
                        >
                            <td class="border px-4 py-2">
                                {{ amount.product.name }}
                            </td>
                            <td class="border px-4 py-2 text-center">
                                {{ amount.product.hmotnost }}
                            </td>
                            <td class="border px-4 py-2">
                                <div
                                    class="text-center w-20"
                                    v-show="amount.edit == false"
                                    v-on:click="editProduct(amount, true)"
                                >
                                    {{ amount.mnozstvi }}
                                </div>
                                <input
                                    class="w-20 p-1 text-center appearance-none block bg-white text-gray-700 border border-blue-700 rounded border-blue-900 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    v-show="amount.edit == true"
                                    :value="amount.mnozstvi"
                                    @input="
                                        _updateProduct($event, amount)
                                    "
                                    v-on:keyup.enter="editProduct(amount, false)"
                                    type="number"
                                />
                            </td>
                            <td
                                v-if="order.status == 'rozpracovaná'"
                                class="border px-4 py-2 flex justify-between"
                            >
                                <button
                                    class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded"
                                    v-if="!amount.edit"
                                    v-on:click="
                                        editProduct(amount, true)
                                    "
                                >
                                    <i
                                        class="fas fa-edit text-blue-800"
                                    ></i>
                                    Upravit
                                </button>
                                <button
                                    v-else
                                    class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded"
                                    v-on:click="
                                        editProduct(amount, false)
                                    "
                                >
                                    Aktualizovat
                                </button>

                                <button
                                    class="bg-transparent hover:bg-red-700 text-black font-semibold hover:text-white py-2 px-4 border border-red-700 hover:border-transparent rounded"
                                    v-on:click="
                                        deleteOrderItem(
                                            amount.pivot.amount_id
                                        )
                                    "
                                >
                                    <i
                                        class="far fa-trash-alt text-blackhover:text-white"
                                    ></i>
                                    Odstranit
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
</template>

<script>
export default {
  name: "orderTable",
  data() {
    return {
      description: {
        desc: ""
      },
      mnozstvi: "",
      amounts: {}
    };
  },
  computed: {
    order() {
      return this.$store.getters.order;
    }
  },
  methods: {
    _updateProduct: function($event, amount) {
      let product = parseInt($event.target.value);
      this.amounts[amount.pivot.amount_id] = product;
    },
    deleteOrderItem(id) {
      this.$store.dispatch("deleteOrderItem", id);
    },
    editProduct(amount, cond) {
      amount.edit = cond;
      this.amounts[amount.pivot.amount_id] === undefined
        ? ""
        : this.updateProduct(this.amounts[amount.pivot.amount_id], amount);
    },
    updateProduct(value, amount) {
      amount.mnozstvi = value;
      this.$store.dispatch("updateOrderItem", amount);
    }
  }
};
</script>

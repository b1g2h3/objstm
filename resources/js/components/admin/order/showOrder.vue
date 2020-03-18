<template>
     <div>
        <div
            class="header"
        >
            <h3>Objednávka č. <span class="text-junglegreen">{{ order.id }}</span> je {{ order.status }}</h3>
        </div>

        <div class="flex flex-wrap">
            <div class="w-full">
                <div
                    class="table mt-3"
                >
                <table class="table-fixed">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Produkt</th>
                            <th class="px-4 py-2">Hmotnost</th>
                            <th class="px-4 py-2">Množství</th>
                            <th
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
                                        v-on:click="
                                        editProduct(amount, true)
                                    "
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
                </div>
                <div
                    class="table mt-3"
                >
                    <div>
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
                                    placeholder="Místo pro poznámku?"
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
                    <div>
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
export default {
    name: "showOrderAdmin",
    props: {
        idc: ""
    },
    data() {
        return {
            loading: false,
            order: null,
        };
    },
    created() {
        this.fetchOrder();
    },
    methods: {
        fetchOrder(){
            this.axios
            .get(`order/${this.idc}`,
            {
                headers: {
                    Authorization:
                    "Bearer " + localStorage.getItem("access_token")
                }
            })
            .then(res => {
                this.order =res.data.data
            })
            .catch(error => {
                console.log(error);
            });
        }
    },
    watch: {
    $route(to, from) {
      if (from.params.idc !== to.params.idc) {
        this.fetchOrder();
      }
    }
  }
};
</script>

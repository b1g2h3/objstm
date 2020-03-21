<template>
    <div class="flex">
           <aside class="sidebar">
            <div class="name">Objednávkový systém</div>
            <div class="menu">
            <input
                class="pt-2 appearance-none text-black block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-grey"
                type="text"
                v-model="search"
                placeholder="Vyhledejte zboží"
            />
             <div
                class="link"
                v-on:click="allProduct"
            >
                Všechny produkty
            </div>
            <div v-for="category in categories" v-bind:key="category.id">
                <div
                    class="link"
                    v-on:click="value(category.id, category.name)"
                >
                    {{ category.name }}
                </div>
            </div>
            </div>
        </aside>
        <div>
            <div
                class="mt-3 p-3"
            >
                <h3>
                    {{ all ? "Všechny produkty" : categoryName }}
                </h3>
            </div>
            <div
                v-if="orders"
                class="bg-ivory border-t-2 border-b-4 border-ivory rounded-lg shadow-lg  ml-3"
            >
                <div class="flex flex-col p-2">
                    <h4 class="text-xl font-semibold cursor-pointer text-junglegreen" v-on:click="collapsed = !collapsed">Zvolené produkty</h4>
                      <div v-show="!collapsed" class="flex  font-bold text-center">
                          <div class="w-3/6 h-6 text-left pl-2">Název produktu</div>
                          <div class="w-2/6 h-6 ">Balení</div>
                          <div class="w-2/6 h-6 ">Množství</div>
                      </div>
                    <div v-show="!collapsed" v-for="product in products" v-bind:key="product.id">
                        <div v-for="(value, index) in orders.order" v-bind:key=(index)>
                            <div
                                v-if="index == product.id"
                                class="flex text-center"
                            >
                                <div class="w-3/6  text-left pl-2">{{ product.name }}</div>
                                <div class="w-2/6 h-6">{{ product.hmotnost }}</div>
                                <div class="w-2/6 h-6 ">{{ value }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <form @submit.prevent="editOrder">
                <button
                    class="success mb-3"
                    type="submit"
                >
                    Upravit objednávku
                </button>
                <div
                    class="table"
                >
                    <div class="flex flex-wrap">
                        <table class="table-fixed">
                            <thead>
                                <tr>
                                    <th class="w-1/2 px-4 py-2">
                                        Název produktu
                                    </th>
                                    <th class="w-1/4 px-4 py-2">Balení</th>
                                    <th class="w-1/4 px-4 py-2">Množství</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="product in filteredList"
                                    v-bind:key="product.id"
                                    v-if="product.category_id == val && !all"
                                >
                                    <td class="border px-4 py-2">
                                        {{ product.name }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        {{ product.hmotnost }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        <input
                                            class="w-20 bg-gray-200 text-gray-700 border border-gray-200 rounded px-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                            type="text"
                                            v-model="orders.order[product.id]"
                                            placeholder="Množství"
                                        />
                                    </td>
                                </tr>
                                <tr v-else-if="all">
                                    <td class="border px-4 py-2">
                                        {{ product.name }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        {{ product.hmotnost }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        <input
                                            class="w-20 bg-gray-200 text-gray-700 border border-gray-200 rounded px-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                            type="text"
                                            v-model="orders.order[product.id]"
                                            placeholder="Množství"
                                        />
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    name: "EditOrder",
    props: {
        id: ""
    },
    data() {
        return {            
            collapsed: false,
            orders: {
                order: null
            },
            search: "",
            val: 1,
            all: true,
            data: {},
            categoryName: "",
            ordeDetail: {}
        };
    },
    computed: {
        grnItemsArr() {
            return Object.keys(this.orders.order).reduce((acc, itemKey) => {
                let row = [itemKey, this.order[itemKey]];
                acc.push(row);
                return acc;
            }, []);
        },

        filteredList() {
            return this.products.filter(product => {
                return product.name
                    .toLowerCase()
                    .includes(this.search.toLowerCase());
            });
        },
        filterOrders() {
            return this.products.filter(product => {
                return product.name
                    .toLowerCase()
                    .includes(this.search.toLowerCase());
            });
        },
        user() {
            return this.$store.getters.user;
        },
        categories() {
      return this.$store.getters.categories;
        },
        products() {
        return this.$store.getters.products;
        }
    },
    created() {
        this.$store.dispatch("fetchCategories");
        this.$store.dispatch("fetchProducts");
        const order = {};
        this.products.forEach(item => {
            order[item[1]] = null;
        });
        this.orders.order = order;
        this.fetchOrderDetails();
    },
    methods: {
        allProduct() {
            this.all = true;
        },
        value(id, name) {
            this.val = id;
            this.categoryName = name;
            this.search = "";
            this.all = false;
        },
        fetchOrderDetails() {
            this.axios
            .get(`/order/${this.id}`, {
                    headers: {
                        Authorization:
                            "Bearer " + localStorage.getItem("access_token")
                    }
                })
                .then(res => {
                    this.ordeDetail = res.data.data;
                    this.addDetailOrder(this.ordeDetail.amounts);
                });
        },
        addDetailOrder(order) {
            for (let ord in order) {
                let prodId = order[ord].product_id;
                let amount = order[ord].mnozstvi;
                this.$set(this.orders.order, prodId, amount); // This is the vuejs-way of setting array values
            }
        },
        editOrder() {
            delete this.orders.order[undefined]
            this.axios
                .put(`/order/${this.idc}`, this.orders,
                 {
                    headers: {
                        Authorization:
                            "Bearer " + localStorage.getItem("access_token")
                    }
                })
                .then(res => {
                    this.$router.push({
                        name: "ShowOrder",
                        params: { id: this.id }
                    });
                })
                .catch(error => console.log(error));
        },
    }
};
</script>

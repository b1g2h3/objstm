<template>
    <div class="flex">
        <div class="h-screen bg-blue-800 text-white">
            <div class="text-center p-2 text-2xl">Objednávkový systém</div>
            <input
                class="pt-2 appearance-none text-black block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-grey"
                type="text"
                v-model="search"
                placeholder="Vyhledejte zboží"
            />
            <div
                class="text-center pt-2 cursor-pointer"
                v-on:click="allProduct"
            >
                Všechny produkty
            </div>
            <div v-for="category in categories" v-bind:key="category.id">
                <div
                    class="text-center pt-2 cursor-pointer"
                    v-on:click="value(category.id, category.name)"
                >
                    {{ category.name }}
                </div>
            </div>
        </div>
        <div>
            <div
                class="bg-blue-800 p-2 shadow text-xl text-white border-l-8 border-green-600 shadow-lg p-5"
            >
                <h3 class="font-bold pl-2">
                    {{ all ? "Všechny produkty" : categoryName }}
                </h3>
            </div>
            <div
                v-if="orders"
                class="bg-green-100 border-t-4 border-b-4 border-green-600 rounded-lg shadow-lg m-1 ml-3 mt-4"
            >
                <div class="flex flex-col p-10">
                    <h3 class="font-bold pl-2">Zvolili jste</h3>
                    <div v-for="product in products" v-bind:key="product.id">
                        <div v-for="(value, index) in orders.order">
                            <div
                                v-if="index == product.id"
                                class="flex justify-between"
                            >
                                <div>{{ product.name }}</div>
                                <div>{{ product.hmotnost }}</div>
                                <div>{{ value }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <form @submit.prevent="addOrder">
                <button
                    class="mt-3 bg-blue-800 hover:bg-blue-900 text-white font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded ml-10 t-2"
                    type="submit"
                >
                    Potvrdit
                </button>
                <div
                    class="bg-green-100 border-t-4 border-b-4 border-green-600 rounded-lg shadow-lg m-1 ml-3 mt-4"
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
  name: "AddOrder",
  data() {
    return {
      products: [],
      orders: {
        order: null
      },
      search: "",
      val: "",
      all: true,
      data: {},
      categoryName: ""
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
        return product.name.toLowerCase().includes(this.search.toLowerCase());
      });
    },
    filterOrders() {
      return this.products.filter(product => {
        return product.name.toLowerCase().includes(this.search.toLowerCase());
      });
    },
      categories() {
      return this.$store.getters.categories;
    }
  },
  created() {
    this.fetchProducts();
    const order = {};
    this.products.forEach(item => {
      order[item[1]] = null;
    });
    this.orders.order = order;
    this.$store.dispatch('fetchCategories');
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
    fetchProducts(page_url) {
      page_url = "api/product";
      fetch(page_url)
        .then(res => res.json())
        .then(res => {
          this.products = res.data;
        })
        .catch(error => console.log(error));
    },
    addOrder() {
      this.axios
        .post(`order`, this.orders, {
          headers: {
            Authorization: "Bearer " + localStorage.getItem("access_token")
          }
        })
        .then(res => {
          this.$router.push({
            name: "ShowOrder",
            params: { id: res.data }
          });
        })
        .catch(error => console.log(error));
    },
  }
};
</script>

import Vue from "vue";
import Vuex from "vuex";
import axios from "axios";

Vue.use(Vuex);
axios.defaults.baseURL = "http://127.0.0.1:8000/api";

export const store = new Vuex.Store({
    state: {
        token: localStorage.getItem("access_token") || null,
        categories: [],
        user: {},
        allUsers: {},
        orders: [],
        order: { id: 0 },
        allOrders: [],
        categories: [],
        category: [],
        orderItems: [],
        products: [],
        filter: 'all',
        userProfile: [],
        theme: "theme-light",
        navbarlinks: [
            { name: "Zboží", route: "zbozi" },
            { name: "Kontakt", route: "kontakt" },
            { name: "Přihlásit", route: "login" }
        ],
        loogedInlinks: [
            { name: "Zboží", route: "zbozi" },
            { name: "Kontakt", route: "kontakt" }
        ],
        sidebarlinks: [
            // { name: "Zboží", route: "zbozi" },
            { name: "Objednat zboží", route: "objednat", fa: "fa-plus-circle" },
            { name: "Objednávky", route: "Orders", fa: "fa-tasks" },
            { name: "Nastavení", route: "settings", fa: "fa-cogs" },
        ]
    },
    getters: {
        loogedInlinks(state) {
            return state.navbarlinks
        },
        isAdmin(state) {
            return state.user.email == 'b1g2h3@seznam.cz'
        },
        theme(state) {
            return state.theme;
        },
        loggedIn(state) {
            return state.token !== null;
        },
        invoice(state) {
            return state.user.invoice !== null;
        },
        ordersFilter(state) {
            return Array.isArray(state.orders) && state.orders.length;
        },
        orders(state) {
            return state.orders;
        },
        order(state) {
            return state.order;
        },
        orderItems(state) {
            return state.orderItems;
        },
        categories(state) {
            return state.categories;
        },
        category(state) {
            return state.category;
        },
        products(state) {
            return state.products;
        },
        userProfile(state) {
            return state.userProfile;
        },
        user(state) {
            return state.user;
        },
        allOrders(state) {
            return state.allOrders;
        },
        allUsers(state) {
            return state.allUsers;
        },
        allUsersFiltered(state) {
            if (state.filter == 'all') {
                return state.allUsers
            } else if (state.filter == 'withinvoice') {
                return state.allUsers.filter(user => user.invoice)
            } else if (state.filter == 'withoutinvoice') {
                return state.allUsers.filter(user => !user.invoice)
            }
            return state.todos
        },

    },
    mutations: {
        getTheme(state, theme) {
            state.theme = theme;
        },
        getUserProfile(state, userProfile) {
            state.userProfile = userProfile;
        },
        retrieveOrders(state, orders) {
            state.orders = orders;
        },
        getUser(state, user) {
            state.user = user;
        },
        fetchOrder(state, order) {
            state.order = order;
        },
        addOrder(state, order) {
            state.order = order;
            state.orders.unshift({
                id: order.id,
                created_at: order.created_at,
                amounts: order.amounts,
                user_id: order.user_id,
                status: 'rozpracovaná',
            })
        },
        confirmOrder(state, data) {
            state.order.status = "potvrzena"
            state.order.description = data.description
            const index = state.orders.findIndex(item => item.id == data.id)
            state.orders.splice(index, 1, state.order)
        },
        deleteOrder(state, id) {
            const index = state.orders.findIndex(item => item.id == id);
            state.orders.splice(index, 1);
            state.order = [];
        },
        orderItems(state, item) {
            console.log(item);
        },
        deleteCategory(state, id) {
            const index = state.categories.findIndex(item => item.id == id);
            state.categories.splice(index, 1);
        },
        updateOrderItem(state, amount) {
            const index = state.order.amounts.findIndex(
                item => item.id == amount.id
            );
            state.orders.amounts.splice(index, 1, amount);
        },
        deleteOrderItem(state, id) {
            const index = state.order.amounts.findIndex(item => item.id == id);
            state.order.amounts.splice(index, 1);
        },
        fetchCategories(state, categories) {
            state.categories = categories;
        },
        fetchProducts(state, products) {
            state.products = products;
        },
        fetchCategory(state, category) {
            state.category = category;
        },
        allOrders(state, allOrders) {
            state.allOrders = allOrders;
        },
        allUsers(state, allUsers) {
            state.allUsers = allUsers;
        },
        updateFilter(state, filter) {
            state.filter = filter
        },
        retrieveToken(state, token) {
            state.token = token;
        },
        destroyToken(state) {
            state.token = null;
        }
    },
    actions: {
        retrieveName(context) {
            axios.defaults.headers.common["Authorization"] =
                "Bearer " + context.state.token;

            return new Promise((resolve, reject) => {
                axios
                    .get("/user")
                    .then(response => {
                        resolve(response);
                    })
                    .catch(error => {
                        reject(error);
                    });
            });
        },
        register(context, data) {
            return new Promise((resolve, reject) => {
                axios
                    .post("/register", {
                        phone: data.phone,
                        email: data.email,
                        password: data.password,
                        confirm_password: data.confirm_password
                    })
                    .then(response => {
                        resolve(response);
                    })
                    .catch(error => {
                        reject(error);
                    });
            });
        },
        destroyToken(context) {
            axios.defaults.headers.common["Authorization"] =
                "Bearer " + context.state.token;

            if (context.getters.loggedIn) {
                return new Promise((resolve, reject) => {
                    axios
                        .post("/logout")
                        .then(response => {
                            localStorage.removeItem("access_token");
                            context.commit("destroyToken");
                            resolve(response);
                        })
                        .catch(error => {
                            localStorage.removeItem("access_token");
                            context.commit("destroyToken");
                            reject(error);
                        });
                });
            }
        },
        retrieveToken(context, credentials) {
            return new Promise((resolve, reject) => {
                axios
                    .post("/login", {
                        username: credentials.username,
                        password: credentials.password
                    })
                    .then(response => {
                        const token = response.data.access_token;

                        localStorage.setItem("access_token", token);
                        context.commit("retrieveToken", token);
                        resolve(response);
                    })
                    .catch(error => {
                        console.log(error);
                        reject(error);
                    });
            });
        },
        retrieveOrders(context) {
            axios.defaults.headers.common["Authorization"] =
                "Bearer " + context.state.token;

            axios
                .get("/orders")
                .then(response => {
                    context.commit("retrieveOrders", response.data.data);
                })
                .catch(error => {
                    console.log(error);
                });
        },
        fetchUserProfile(context, id) {
            return new Promise((resolve, reject) => {
                axios.defaults.headers.common["Authorization"] =
                    "Bearer " + context.state.token;

                axios.get(`userprofile/${id}`)
                    .then(response => {
                        resolve(response);
                        context.commit("getUserProfile", response.data.data);
                        context.commit("retrieveOrders", response.data.data.orders);
                    })
                    .catch(error => {
                        console.log(error);
                    });
            });
        },
        getUser(context) {
            axios.defaults.headers.common["Authorization"] =
                "Bearer " + context.state.token;

            axios
                .post("/user")
                .then(response => {
                    context.commit("getUser", response.data.data);
                })
                .catch(error => {
                    console.log(error);
                });
        },
        fetchOrder(context, id) {
            return new Promise((resolve, reject) => {
                axios.defaults.headers.common["Authorization"] =
                    "Bearer " + context.state.token;

                axios
                    .get(`order/${id}`)
                    .then(response => {
                        context.commit("fetchOrder", response.data.data);
                        resolve(response);
                    })
                    .catch(error => {
                        console.log(error);
                    });
            });
        },
        deleteOrder(context, id) {
            axios.defaults.headers.common["Authorization"] =
                "Bearer " + context.state.token;

            axios
                .delete(`order/${id}`)
                .then(response => {
                    context.commit("deleteOrder", id);
                })
                .catch(error => {
                    console.log(error);
                });
        },
        updateOrderItem(context, amount) {
            axios.defaults.headers.common["Authorization"] =
                "Bearer " + context.state.token;
            axios
                .put(`amount/${amount.id}`, amount)
                .then(response => {
                    context.commit("updateOrderItem", amount);
                })
                .catch(error => {
                    console.log(error);
                });
        },
        deleteOrderItem(context, id) {
            axios.defaults.headers.common["Authorization"] =
                "Bearer " + context.state.token;

            axios
                .delete(`amount/${id}`)
                .then(response => {
                    context.commit("deleteOrderItem", id);
                })
                .catch(error => {
                    console.log(error);
                });
        },
        deleteCategory(context, id) {
            axios.defaults.headers.common["Authorization"] =
                "Bearer " + context.state.token;

            axios
                .delete(`category/${id}`)
                .then(response => {
                    context.commit("deleteCategory", id);
                })
                .catch(error => {
                    console.log(error);
                });
        },
        confirmOrder(context, data) {
            axios.defaults.headers.common["Authorization"] =
                "Bearer " + context.state.token;
            axios
                .post(`order/${data.id}/confirm`, data)
                .then(response => {
                    context.commit("confirmOrder", data);
                })
                .catch(error => {
                    console.log(error);
                });
        },
        fetchCategories(context) {
            axios
                .get(`categories`)
                .then(response => {
                    context.commit("fetchCategories", response.data.data);
                })
                .catch(error => {
                    console.log(error);
                });
        },
        fetchCategory(context, id) {
            axios
                .get(`category/${id}`)
                .then(response => {
                    context.commit("fetchCategory", response.data.data);
                })
                .catch(error => {
                    console.log(error);
                });
        },
        fetchProducts(context) {
            axios
                .get(`products`)
                .then(response => {
                    context.commit("fetchProducts", response.data.data);
                })
                .catch(error => {
                    console.log(error);
                });
        },
        allOrders(context) {
            return new Promise((resolve, reject) => {
                axios
                    .get(`allorders`)
                    .then(response => {
                        context.commit("allOrders", response.data.data);
                        resolve(response);
                    })
                    .catch(error => {
                        console.log(error);
                        reject(error)
                    })
            })
        },
        allUsers(context) {
            return new Promise((resolve, reject) => {
                axios.get(`allusers`)
                    .then(response => {
                        context.commit("allUsers", response.data.data);
                        resolve(response)
                    })
                    .catch(error => {
                        console.log(error);
                        reject(error)
                    })
            })
        },
    }
});
<template>
    <div class="flex">
        <aside v-if="user.invoice" class="sidebar">
            <div class="name">Objednávky</div>
            <div v-if="user" class="menu">
                <router-link                 
                :to="{ name: 'addOrder' }"
                class="link text-center"
                >
                <i class="fas  fa-plus"></i> Přidat
                </router-link>
                <div v-if="!ordersFilter" class="link">
                Nemá objednávky
                </div>
                <router-link 
                        v-for="order in orders"
                        v-bind:key="order.id"
                        class="link" 
                        :to="{ name: 'showOrder', params: {idc: order.id} }"
                        >č. {{order.id}} 
                        <i :class="order.status == 'rozpracovaná' ? 'fa-pen' : 'fa-check'" class="fas"></i>
                        {{order.created_at | formatDate }}
                    </router-link>
            </div>
        </aside>
        <div>
            <div v-if="loading" class="loading">
        </div>
        <div v-if="!loading" class="header">
            <h3>Uživatel <span  v-if="user" class="text-junglegreen">{{ user.email }}</span></h3>
        </div>
        <div v-if="!loading" class="pb-3 pl-3">
        <button
            v-if="!user.invoice"
            class="bg-transparent hover:bg-green-700 text-black font-semibold hover:text-white py-2 px-4 border border-green-700 hover:border-transparent rounded"
            v-on:click="addInvoice"
            >
            Přidat fakturační údaje
        </button>
        <button
            v-else
            class="bg-transparent hover:bg-green-700 text-black font-semibold hover:text-white py-2 px-4 border border-green-700 hover:border-transparent rounded"
            >
            Upravit údaje
        </button>
        <button
            class="bg-transparent hover:bg-red-700 text-black font-semibold hover:text-white py-2 px-4 border border-red-700 hover:border-transparent rounded"
            v-on:click="deleteUser"
            >
            Odstranit uživatele
        </button>
        </div>
        <div  v-if="user.invoice" class="flex flex-wrap">
            <div class="w-full">
                <div class="table">
                      <div v-if="user" class="flex p-2">
                        <div>
                            <div v-if="user.invoice.nazev"><span class="font-bold">Název:</span> <span class="text-junglegreen font-semibold">{{ user.invoice.nazev }}</span></div>
                            <div><span class="font-bold">Email:</span>{{ user.email }}</div>
                            <div><span class="font-bold">Telefon:</span>{{ user.phone }}</div>
                            <div v-if="user.invoice.ic"><span class="font-bold">IC:</span> <span class="text-junglegreen font-semibold">{{ user.invoice.ic }}</span></div>
                            <div v-if="user.invoice.dic"><span class="font-bold">DIC:</span> <span class="text-junglegreen font-semibold">{{ user.invoice.dic }}</span></div>
                        </div>
                        <div v-if="user.invoice" class="pl-2">
                            <div><span class="font-bold">Ulice:</span> {{ user.invoice.ulice }}</div>
                            <div><span class="font-bold">Město:</span> {{ user.invoice.mesto }}</div>
                            <div><span class="font-bold">PSČ:</span> {{ user.invoice.psc }}</div>
                            <div><span class="font-bold">Země:</span> {{ user.invoice.zeme }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>   
        <router-view />
        </div>
    </div>
</template>

<script>
export default {
    name: "userProfile",
    props: {
        id: ""
    },
    data() {
        return {
            loading: false,
        };
    },
    computed: {        
        orders() {
        return this.$store.getters.orders;
        },
        user() {
        return this.$store.getters.userProfile;
        },
        ordersFilter() {
        return this.$store.getters.ordersFilter;
        },
        activeOrder() {
        return this.$store.getters.order;
        },
    },
    created() {              
        this.loading = true;
        this.$store.dispatch("fetchUserProfile", this.id)
            .then(response => {
            this.loading =false;
            })         
    },
    methods: {
        addInvoice(){
            this.$router.push({
                        name: "addInvoice", params:{ id: this.id}
            })
        },
        deleteUser() {
            if(confirm('Jste si jistý?')){
                 this.axios
                .delete(`deleteuser/${this.id}`,
                {
                    headers: {
                        Authorization:
                        "Bearer " + localStorage.getItem("access_token")
                    }
                })
                .then(res => {                
                    this.$router.push({
                        name: "showUsers",
                    });
                })
                .catch(error => {
                    console.log(error);
                });
            }
        }
    }
};
</script>

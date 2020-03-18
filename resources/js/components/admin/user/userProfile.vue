<template>
    <div class="flex">
        <aside class="sidebar">
            <div class="name">Objednávky</div>
            <div v-if="user" class="menu">
                <router-link 
                        v-for="order in user.orders"
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
            <div v-if="loading" class="loader">
            <div class="inner one"></div>
            <div class="inner two"></div>
            <div class="inner three"></div>
        </div>
        <div class="header">
            <h3>Uživatel <span class="text-junglegreen">{{ user.invoice.nazev }}</span></h3>
        </div>
        <div class="flex flex-wrap">
            <div class="w-full">
                <div class="table">
                      <div v-if="user.invoice" class="flex p-2">
                        <div>
                            <div><span class="font-bold">Název:</span> <span class="text-junglegreen font-semibold">{{ user.invoice.nazev }}</span></span></div>
                            <div><span class="font-bold">Email:</span>{{ user.email }}</div>
                            <div><span class="font-bold">Telefon:</span>{{ user.phone }}</div>
                            <div><span class="font-bold">IC:</span> <span class="text-junglegreen font-semibold">{{ user.invoice.ic }}</span></div>
                            <div v-if="user.invoice.dic"><span class="font-bold">DIC:</span> <span class="text-junglegreen font-semibold">{{ user.invoice.dic }}</span></div>
                        </div>
                        <div class="pl-2">
                            <div><span class="font-bold">Ulice:</span> {{ user.invoice.ulice }}</div>
                            <div><span class="font-bold">Město:</span> {{ user.invoice.mesto }}</div>
                            <div><span class="font-bold">PSČ:</span> {{ user.invoice.psc }}</div>
                            <div><span class="font-bold">Země:</span> {{ user.invoice.zeme }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>   
        <!-- <div class="p-3">
            <button
                class="bg-transparent hover:bg-green-700 text-black font-semibold hover:text-white py-2 px-4 border border-green-700 hover:border-transparent rounded"
                >
                Upravit údaje
            </button>
            <button
                class="bg-transparent hover:bg-red-700 text-black font-semibold hover:text-white py-2 px-4 border border-red-700 hover:border-transparent rounded"
                >
                Odstranit uživatele
            </button>
        </div> -->
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
            user: null,
        };
    },
    created() {
        this.getUser();
    },
    methods: {
        getUser(){
            this.axios
            .get(`userprofile/${this.id}`,
            {
                headers: {
                    Authorization:
                    "Bearer " + localStorage.getItem("access_token")
                }
            })
            .then(res => {
                this.user =res.data.data
            })
            .catch(error => {
                console.log(error);
            });
        }
    }
};
</script>

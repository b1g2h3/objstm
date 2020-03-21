<template>
    <div>
        <div v-if="loading" class="loading">
        </div>

        <div v-if="!loading" class="header">
            <h3>Přehled všech objednávek</h3>
        </div>

        <div v-if="!loading" class="flex flex-wrap">
            <div class="w-full">
                <div class="table">
                    <table class="table-fixed">
                        <thead>
                            <tr>
                            <th >Číslo</th>
                            <th >Zakazník</th>
                            <th class=" px-4 py-2">Status</th>
                            <th>Datum vytvoření</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr   
                             v-bind:key="order.id" v-for="order in allOrders">
                                <td class="border text-center py-2">
                                    <router-link :to="{ name: 'showOrder', params: {id:order.user_id ,idc: order.id} }">
                                        {{order.id}}                            
                                    </router-link>
                                </td>
                                <td class="border text-center p-2">
                                    <router-link :to="{ name: 'showOrder', params: {id:order.user_id ,idc: order.id} }">
                                        {{order.user.invoice.nazev }}                            
                                    </router-link>
                                </td>
                                <td class="border px-4 py-2">                                
                                    <router-link :to="{ name: 'showOrder', params: {id:order.user_id ,idc: order.id} }">
                                    {{order.status}}
                                    </router-link>
                                </td>
                                <td class="border text-center">                                
                                    <router-link :to="{ name: 'showOrder', params: {id:order.user_id ,idc: order.id} }">
                                        {{order.created_at | fullFormatDate}}
                                    </router-link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "createProduct",
    props: {
        id: ""
    },
    data() {
        return {
            loading: false
        };
    },
    created() {
        this.loading = false;
        this.$store.dispatch("allOrders")
         .then(response => {
            this.loading =false
            })
    },
    computed: {
        allOrders() {
            return this.$store.getters.allOrders;
        }
    }
};
</script>

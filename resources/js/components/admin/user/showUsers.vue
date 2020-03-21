<template>
    <div>
        <div v-if="loading" class="loading">
        </div>

        <div v-if="!loading" class="header">
            <h3>Přehled všech uživatelů</h3>
        </div>
        <div v-if="!loading" class="ml-4 mb-4">
            <div>   
                <button 
                    class="bg-transparent hover:bg-green-700 text-black font-semibold hover:text-white py-2 px-4 border border-green-700 hover:border-transparent rounded"
                    :class="{ active: filter == 'all' }" @click="changeFilter('all')">Všichni zakazníci</button>
                <button 
                    class="bg-transparent hover:bg-green-700 text-black font-semibold hover:text-white py-2 px-4 border border-green-700 hover:border-transparent rounded"
                    :class="{ active: filter == 'active' }" @click="changeFilter('withinvoice')">S fakturačními údajy</button>
                <button 
                    class="bg-transparent hover:bg-green-700 text-black font-semibold hover:text-white py-2 px-4 border border-green-700 hover:border-transparent rounded"
                    :class="{ active: filter == 'completed' }" @click="changeFilter('withoutinvoice')">Bez fakturačních údajů</button>
            </div>
        </div>
        <div  v-if="!loading" class="flex flex-wrap">
            <div class="w-full">
                <div class="table">
                     <table class="table-fixed">
                        <thead>
                            <tr>
                            <th >Název firmy</th>
                            <th>IC</th>
                            <th>DIC</th>
                            <th>Email</th>
                            <th>Telefon</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr   
                             v-bind:key="user.id" v-for="user in allUsers"
                             >
                                <td class="border text-center py-2">
                                    <router-link :to="{ name: 'user', params: {id:user.id } }">
                                        {{user.invoice ? user.invoice.nazev : 'NaN'}}                            
                                    </router-link>
                                </td>
                                <td class="border text-center p-2">
                                    <router-link :to="{ name: 'user', params: {id:user.id } }">
                                         {{user.invoice ? user.invoice.ic : 'NaN'}}                           
                                    </router-link>
                                </td>
                                <td class="border px-4 py-2">                                
                                    <router-link :to="{ name: 'user', params: {id:user.id } }">
                                        {{user.invoice ? user.invoice.dic : 'NaN'}}   
                                    </router-link>
                                </td>
                                <td class="border text-center">                                
                                    <router-link :to="{ name: 'user', params: {id:user.id } }">
                                         {{user.email}}  
                                    </router-link>
                                </td>
                                <td class="border text-center">                                
                                    <router-link :to="{ name: 'user', params: {id:user.id } }">
                                         {{user.phone}}  
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
    name: "allUsers",
    props: {
        id: ""
    },
    data() {
        return {
            loading: false,
        };
    },
    created() {
        this.loading =true
        this.$store.dispatch("allUsers")
            .then(response => {
            this.loading =false
            })
    },
    computed: {
        allUsers() {
            return this.$store.getters.allUsersFiltered;
        },
         filter() {
            return this.$store.state.filter    
        }
    },
    methods: {
        changeFilter(filter) {
            this.$store.commit('updateFilter', filter)
        }
    },
};
</script>

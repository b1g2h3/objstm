<template>
    <div>
        <div v-if="loading" class="loader">
            <div class="inner one"></div>
            <div class="inner two"></div>
            <div class="inner three"></div>
        </div>

        <div class="header">
            <h3>Přehled všech uživatelů</h3>
        </div>

        <div class="flex flex-wrap">
            <div class="w-full">
                <div class="table">
                    <div class="flex w-full text-center p-3 justify-between">
                        <div class="font-bold">Název firmy</div>
                        <div class="font-bold pl-3">IC</div>
                        <div class="font-bold pl-3">DIC</div>
                        <div class="font-bold pl-3">Email</div>
                        <div class="font-bold pl-3">Telefon</div>
                    </div>
                    <router-link 
                        v-bind:key="user.id"
                        v-for="user in allUsers"
                        class="flex w-full text-center pt-1 justify-between" 
                        :to="{ name: 'user', params: {id: user.id} }"
                        >
                        <div class="text-bold">{{ user.invoice.nazev }}</div>
                        <div class="pl-3">{{ user.invoice.ic }}</div>
                        <div class="pl-3">{{ user.invoice.dic }}</div>
                        <div class="pl-3">{{ user.email }}</div>
                        <div class="pl-3">{{ user.phone }}</div>
                    </router-link>
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
            loading: false
        };
    },
    created() {
        this.$store.dispatch("allUsers");
    },
    computed: {
        allUsers() {
            return this.$store.getters.allUsers;
        }
    }
};
</script>

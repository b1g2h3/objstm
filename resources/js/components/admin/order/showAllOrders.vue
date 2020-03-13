<template>
    <div>
        <div v-if="loading" class="loader">
            <div class="inner one"></div>
            <div class="inner two"></div>
            <div class="inner three"></div>
        </div>

        <div class="header">
            <h3>Přehled všech objednávek</h3>
        </div>

        <div class="flex flex-wrap">
            <div class="w-full">
                <div class="table">
                    {{ allOrders }}
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
        this.$store.dispatch("allOrders");
    },
    computed: {
        allOrders() {
            return this.$store.getters.allOrders;
        }
    }
};
</script>

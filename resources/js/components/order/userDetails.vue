<template>
    <div>
        <div class="text-xl font-bold font-sans px-2">
            Kontaktí údaje
        </div>
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
</template>

<script>
export default {
    name: "userDetaiList",
    computed: {
        user() {
            return this.$store.getters.user;
        }
    }
};
</script>

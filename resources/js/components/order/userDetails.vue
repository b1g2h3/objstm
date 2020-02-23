<template>
 <div>
       <div class="text-xl font-bold font-sans px-2">
             Kontaktí údaje
        </div>
        <div v-if="user" class="flex p-2">
            <div class="font-bold">
            <div>Název: {{ user.invoice.nazev }}</div>
            <div>Email: {{ user.email }}</div>
            <div>Telefon: {{ user.phone }}</div>
            <div>IC {{ user.invoice.ic }}</div>
            <div v-if="user.invoice.dic">DIC {{user.invoice.dic}}</div>
        </div>
        <div class="pl-2 font-bold">
            <div>Ulice: {{ user.invoice.ulice }}</div>
            <div>Město: {{ user.invoice.mesto }}</div>
            <div>PSČ: {{ user.invoice.psc }}</div>
            <div>Země: {{ user.invoice.zeme }}</div>
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

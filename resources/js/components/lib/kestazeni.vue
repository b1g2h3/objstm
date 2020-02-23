<template>
<div class="w-5/6">
  <div class="max-w-sm w-full lg:max-w-full lg:flex pt-5">
  <div class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden" style="background-image: url('https://cdn.nere.cz/assets/attachments18/582943/screen/fotografie-jidla-pro-katalog-fotografie-jidla-pro-katalog_4.jpg?1549830512')" title="Woman holding a mug">
  </div>
  <div class="border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
    <div class="mb-8">
      <div class="text-gray-900 font-bold text-xl mb-2">Katalog ke stažení</div>
      <p class="text-gray-700 text-base">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium nihil.</p>
    </div>
    <div class="flex items-center">
      <div class="text-sm">
        <p class="text-gray-900 leading-none">Šotola Miroslav</p>
        <p class="text-gray-600">20.1 2020</p>
      </div>
    </div>
  </div>
</div>
  <div class="max-w-sm w-full lg:max-w-full lg:flex pt-5">
  <div class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden" style="background-image: url('https://cdn.nere.cz/assets/attachments18/582943/screen/fotografie-jidla-pro-katalog-fotografie-jidla-pro-katalog_4.jpg?1549830512')" title="Woman holding a mug">
  </div>
  <div class="border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
    <div class="mb-8">
      <div class="text-gray-900 font-bold text-xl mb-2">Alegeny ke stažení</div>
      <p class="text-gray-700 text-base">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium nihil.</p>
    </div>
    <div class="flex items-center">
      <div class="text-sm">
         <p class="text-gray-900 leading-none">Šotola Miroslav</p>
        <p class="text-gray-600">20.1 2020</p>
      </div>
    </div>
  </div>
</div>
</div>
</template>

<script>
export default {
  data() {
    return {
      book: {}
    };
  },
  methods: {
    addBook() {
      this.axios
        .post("http://localhost:8000/api/book/add", this.book)
        .then(
          response => this.$router.push({ name: "home" })
          //   console.log(response.data)
        )
        .catch(error => console.log(error))
        .finally(() => (this.loading = false));
    }
  }
};
</script>
<template>
 <footer class="bg-gray-100">
  <div class="container mx-auto px-6 pt-10 pb-6">
    <div class="flex flex-wrap justify-center">
      <div class="w-full md:w-1/4 text-center md:text-left">
        <h5 class="uppercase mb-6 font-bold">Example</h5>
        <ul class="mb-4">
          <li class="mt-2">
            <router-link 
              :to="{ name: 'kestazeni'}"
              class="hover:underline text-gray-600 hover:text-orange-500">
                Ke stažení
              </router-link>
          </li>
        </ul>
      </div>
      <div class="w-full md:w-1/4 text-center md:text-left">
        <h5 class="uppercase mb-6 font-bold">Example</h5>
        <ul class="mb-4">
          <li class="mt-2">
          <router-link 
            :to="{ name: 'kestazeni'}"
            class="hover:underline text-gray-600 hover:text-orange-500">
              Ke stažení
            </router-link>
        </li>
        </ul>
      </div>
      <div class="w-full md:w-1/4 text-center md:text-left">
        <h5 class="uppercase mb-6 font-bold">Example</h5>
        <ul class="mb-4">
          <li class="mt-2">
             <router-link 
              :to="{ name: 'kontakt'}"
              class="hover:underline text-gray-600 hover:text-orange-500">
                Kontakt
              </router-link>
          </li>
        </ul>
      </div>
    </div>
  </div>
  </footer>
</template>
<script>
export default {
  name: 'foot',
};
</script>

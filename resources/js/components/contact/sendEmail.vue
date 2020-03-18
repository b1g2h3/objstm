<template>
  <div>
     <div class="max-w-3xl flex   flex-wrap p-6 ">
    
	<!--Main Col-->
	<div id="profile" class="w-full lg:w-3/5 rounded-lg lg:rounded-l-lg lg:rounded-r-none shadow-2xl bg-ivory  mx-6 lg:mx-0">
		<div class="p-4 md:p-12 text-center lg:text-left">
			<!-- Image for mobile view-->
			<div class="block lg:hidden rounded-full shadow-xl mx-auto -mt-6 h-48 w-48 bg-cover bg-center" style="background-image: url('https://www.prteconline.com/home2/wp-content/uploads/2018/09/AAE78F1E-39A5-41C4-9AAA-8EE91232AAFE.jpeg')"></div>
			
			<h1 class="text-3xl font-bold pt-8 lg:pt-0">Šotola Miroslav</h1>
			<div class="mx-auto lg:mx-0 w-4/5 pt-3 border-b-2 border-teal-500 opacity-25"></div>
			<p class="pt-4 text-base font-bold flex items-center justify-center lg:justify-start"><svg class="h-4 fill-current text-darkergreen pr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9 12H1v6a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-6h-8v2H9v-2zm0-1H0V5c0-1.1.9-2 2-2h4V2a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v1h4a2 2 0 0 1 2 2v6h-9V9H9v2zm3-8V2H8v1h4z"/></svg> Velkoobchod a maloobchod</p>
			<p class="pt-8 text-2xl text-base font-bold flex items-center justify-center lg:justify-start"> Kontaktujte nás</p>
    <form @submit.prevent="sendEmail" class="mx-auto lg:mx-0 w-4/5   border-teal-500 opacity-100">
    <div class="flex flex-wrap -mx-3 mb-4">
      <div class="w-full md:w-1/2 px-3 mb-4 md:mb-0">
        <label
          class=" pt-2 text-base font-bold flex pl-2 justify-start lg:justify-start"
          for="grid-first-name"
        >Jméno</label>
        <input
          class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-2 mb-3 leading-tight focus:outline-none focus:bg-white"
          v-bind:class="{ 'border-red-500': errors.firstname }"
          id="grid-first-name"
          type="text"
          placeholder="Jméno"
          v-model="contact.firstname"
        />
        <p v-if="errors.firstname" class="text-red-500 text-xs italic">{{errors.firstname[0]}}</p>
      </div>
      <div class="w-full md:w-1/2 ">
        <label
          class="pt-2 text-base font-bold flex pl-2 justify-start lg:justify-start"
          for="grid-last-name"
        >Příjmení</label>
        <input
          class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
          id="grid-last-name"
          type="text"
          v-bind:class="{ 'border-red-500': errors.lastname }"
          v-model="contact.lastname"
          placeholder="Příjmení"
        />
        <p v-if="errors.lastname" class="text-red-500 text-xs italic">{{errors.lastname[0]}}</p>
      </div>
    </div>
    <div class="flex flex-wrap -mx-3 mb-2">
      <div class="w-full px-3">
        <label
          class=" text-base font-bold flex pl-2 justify-start lg:justify-start"
          for="grid-password"
        >E-mailová adresa</label>
        <input
          class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
          id="email"
          type="email"
          v-bind:class="{ 'border-red-500': errors.email }"
          v-model="contact.email"
          placeholder="Email"
        />
        <p v-if="errors.email" class="text-red-500 text-xs italic">{{errors.email[0]}}</p>
      </div>
    </div>
    <div class="flex flex-wrap -mx-3 mb-4">
      <div class="w-full px-3">
        <label
          class=" text-base font-bold flex pl-2 justify-start lg:justify-start"
          for="reason"
        >Předmět zprávy</label>
        <input
          class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
          id="reason"
          type="text"
          v-bind:class="{ 'border-red-500': errors.reason }"
          v-model="contact.reason"
          placeholder="Předmět zprávy"
        />
        <p v-if="errors.reason" class="text-red-500 text-xs italic">{{errors.reason[0]}}</p>
      </div>
    </div>
    <div class="flex flex-wrap -mx-3 mb-4">
      <div class="w-full px-3">
        <label
          class=" text-base font-bold flex pl-2 justify-start lg:justify-start"
          for="message"
        >Zpráva</label>
        <textarea
          class="no-resize appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 h-20 resize-none"
          id="message"
          placeholder="Místo pro váš dotaz"
          v-bind:class="{ 'border-red-500': errors.message }"
          v-model="contact.message"
        ></textarea>
        <p v-if="errors.message" class="text-red-500 text-xs italic">{{errors.message[0]}}</p>
      </div>
    </div>
    <div class="md:flex md:items-center">
      <div class="md:w-full">
        <button
          class="shadow bg-junglegreen hover:bg-darkergreen focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"
          type="submit"
        >Kontaktujte nás!!</button>
      </div>
    </div>
  </form>

		</div>

	</div>
	
	<div class="w-full lg:w-2/5">
		<img src="https://www.prteconline.com/home2/wp-content/uploads/2018/09/AAE78F1E-39A5-41C4-9AAA-8EE91232AAFE.jpeg" class="rounded-none lg:rounded-lg shadow-2xl hidden lg:block">
	</div>
</div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      contact: {
        firstname: "",
        lastname: "",
        email: "",
        reason: "",
        message: ""
      },
      errors: []
    };
  },
  methods: {
    sendEmail() {
      this.errors = [];
      this.axios
        .post("/contact", this.contact)
        .then(res => {
          // this.$router.push({ name: "ShowOrder", params: { id: res.data } });
        })
        .catch(error => {
          if (error.response.status == 422) {
            this.errors = error.response.data.errors;
          }
        });
    }
  }
};
</script>
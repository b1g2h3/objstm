<template>
  <div class="container">
    <div class="row d-flex">

      <div class="col-lg-12">
        <h1 class="pl-3 my-4">Úvod</h1>
      </div>


      <div class="col-lg-9">

        <p>
            Vítejte na stránkách společnosti Varnes Hodonín
        </p>
        
        <p>
            Naše společnost působí jako distributor zboží, zejména konvenientních potravin pro gastrozařízení.
        </p>
        <p>
            Jsou to koncentrované potravinářské sypké směsi i pasty, které se připravují z nejkvalitnějších surovin šetrným zpracováním, při použití nejmodernějších technologií. Výrobky obsahují čerstvě zpracované přírodní suroviny, zeleninu, zeleninové extrakty, koření, bylinky a mořskou či jodidovanou sůl.
        </p>
       <p>
        Díky vysoce kvalitnímu zpracování surovin tyto směsi neztrácejí aroma a jsou silně koncentrované, a proto mají vysokou vydatnost. Směsi jsou rychlým základem pro přípravu polévek, omáček, těstovin, zeleninových základů i nákypů, salátů a dalších pokrmů. Jsou  velmi chutné, harmonické, jemné i pikantní chuti. Splňuji všechny požadavky zdravé a moderní kuchyně.
       </p>
        <p>
            Specializujeme se hlavně na produkci německé firmy Wela-Trognitz Fritz Busch GmbH & Co. KG, která drží vysokou kvalitu výrobků přes 75 let.  
        </p>
        <p>
            Mezi naše zákazníky patří především školní kuchyně vč. jídelen v Mateřských školkách, kuchyní a vývařoven ve zdravotnických zařízeních jako jsou nemocnice, pečovatelské služby, rehabilitační střediska, domovy pro seniory a prostě všude tam, kde je zapotřebí úzkostlivě dbát na kvalitu stravování. 
        </p>
     

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
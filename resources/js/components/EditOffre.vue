<template>
<div>
<div class="container" >
  <div class="row my-4">
    <div class="col-md-8 mx-auto mt-5">
      <div class="card bg-light">
        <h3 class="card-header" >Modifier une offre</h3>
      <div class="card-body">
         <form @submit="updateOffre" enctype="multipart/form-data">
              <div class="form-group">
                    <label for="">Secteurs d'activites</label>
                    <select v-model="offre.sector_id" class="form-control" name="secteur" required id="secteur">
                    <option value disabled selected>Veuillez choisir une secteur d'activite</option>    
                    <option v-for="(secteur,index) in secteurs " :key="index" :value="secteur.id">
                        {{secteur.title}}
                    </option>
                    </select>
              </div>
              <div class="form-group">
                    <label for="">Titre</label>
                    <input v-model="offre.title" type="text" required class="form-control" id="title" name="title" placeholder="Titre de l'offre">
              </div>
              <div class="form-group">
                    <label for="">Contenu</label>
                    <textarea v-model="offre.text" required class="form-control" id="" placeholder="contenu" name="text" rows="5"></textarea>
              </div>
              <div class="form-group">
                    <label for="">Publier</label>
                      <div class="form-check form-check-inline">
                        <input v-model="offre.is_published" class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="1">
                        <label class="form-check-label" for="inlineRadio1">Oui</label>
                        </div>
                        <div class="form-check form-check-inline">
                        <input v-model="offre.is_published" class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="0">
                        <label class="form-check-label" for="inlineRadio2">Non</label>
                      </div>
              </div>
              <button type="submit" class="btn btn-primary">Valider</button>
         </form>
      </div>
    </div>
  </div>
  </div>
  </div>
</div>
</template>
<script >
export default {
    data(){
        return {
           offre: {
                title: "",
                text: "",
                sector_id: "",
                is_published: ""
           },
           secteurs: [],
        }
    },
     created(){
       this.getPosts();
       this.getSecteurs();
    },
    methods: {

      
        getSecteurs(){
               axios.get('/api/secteurs')
                .then(response => this.secteurs = response.data.secteurs)
                .catch(err => console.log(err));
        },
        getPosts(){
           axios.get(`/api/offres/${this.$route.params.slug}`)
          .then(response => {
              console.log('offre',response.data.offre);
             this.offre = response.data.offre;
          }).catch(err => console.log(err));
        },
        updateOffre(e){
            e.preventDefault();
            const config = {
                headers : {"content-type" : "application/x-www-form-urlencoded"}
            }

            let formData = new FormData();
            formData.append('title', this.offre.title);
            formData.append('text', this.offre.text);
            formData.append('sector_id' , this.offre.sector_id);
            formData.append('user_id', User.isLogged().id);
            formData.append('is_published',this.offre.is_published);
            formData.append('published_by', User.isLogged().id);
            formData.append('_method', 'put');
            axios.post(`/api/offres/${this.offre.slug}`, formData,config)
             .then(res => {
                    this.offre.title = '';
                    this.offre.text = null;
                    this.offre.category_id = '';
                    this.offre.is_published = '';
                    Swal.fire({
                      position: 'center',
                      icon: 'success',
                      title: 'Offre modifié',
                      showConfirmButton: false,
                      timer: 1500
                    })
                    this.$router.push({name : "allOffres"});
             }).catch(err => console.log(err));
        }
    }
}
</script>
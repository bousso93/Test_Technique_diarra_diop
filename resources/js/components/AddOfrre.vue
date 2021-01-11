<template>
<div>
<div class="modal fade" id="addOffre" tabindex="-1" aria-labelledby="addOffre" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ajouter une offre</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <form @submit="addOffre" enctype="multipart/form-data">
              <div class="form-group">
                    <label for="">Secteur d'activite</label>
                    <select v-model="sector_id" class="form-control" name="category" required id="secteur">
                    <option value disabled selected>Veuillez choisir une secteur d'activite</option>    
                    <option  v-for="(secteur,index) in secteurs"
                          :key="index" :value="secteur.id">
                        {{secteur.title}}
                    </option>
                    </select>
              </div>
              <div class="form-group">
                    <label for="">Titre</label>
                    <input v-model="title" type="text" required class="form-control" id="title" name="title" placeholder="Titre de l'article">
              </div>
              <div class="form-group">
                    <label for="">Contenu</label>
                    <textarea v-model="text" required class="form-control" id="" placeholder="contenu" name="text" rows="5"></textarea>
              </div>
              <div class="form-group">
                    <label for="">Publier</label>
                      <div class="form-check form-check-inline">
                        <input v-model="is_published" class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="1">
                        <label class="form-check-label" for="inlineRadio1">Oui</label>
                        </div>
                        <div class="form-check form-check-inline">
                        <input v-model="is_published" class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="0">
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
</template>
<script >
export default {
    data(){
        return {
           title: '',
           text: '',
           sector_id: '',
           is_published: '',
           secteurs: [],
        }
    },
     created(){
        axios.get('/api/secteurs')
        .then(response => this.secteurs = response.data.secteurs)
        .catch(err => console.log(err))
    },
    methods: {

        addOffre(e){
            e.preventDefault();
            const config = {
                headers : {"content-type" : "multipart/form-data"}
            }

            let formData = new FormData();
            formData.append('title', this.title);
            formData.append('text', this.text);
            formData.append('sector_id' , this.sector_id);
            formData.append('user_id', User.isLogged().id);
            formData.append('is_published',this.is_published);
            formData.append('published_by', User.isLogged().id);
            axios.post('/api/offres', formData,config)
             .then(res => {
                    $('#addOffre').modal('hide');
                    this.title = '';
                    this.text = null;
                    this.sector_id = '';
                    this.is_published = '';
                    Swal.fire({
                      position: 'center',
                      icon: 'success',
                      title: 'Article ajouté',
                      showConfirmButton: false,
                      timer: 1500
                    })
                    this.$emit("added");
             }).catch(err => console.log(err));
        }
    }
}
</script>
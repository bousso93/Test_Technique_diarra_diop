<template>
<div>
<div class="modal fade" id="addSecteur" tabindex="-1" aria-labelledby="addSecteur" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ajouter une secteur</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <form @submit="addSecteur" enctype="multipart/form-data">
              <div class="form-group">
                    <label for="">Titre</label>
                    <input v-model="title" type="text" required class="form-control" id="title" name="title" placeholder="Titre">
              </div>
              <div class="form-group">
                    <label for="">Description</label>
                    <textarea v-model="description" required class="form-control" id="" placeholder="description" name="description" rows="5"></textarea>
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
           description: ''
         
        }
    },
   
    methods: {

        addSecteur(e){
            e.preventDefault();
            const config = {
                headers : {"content-type" : "multipart/form-data"}
            }

            let formData = new FormData();
            formData.append('title', this.title);
            formData.append('description', this.description);
            axios.post('/api/secteurs', formData,config)
             .then(res => {
                    $('#addSecteur').modal('hide');
                    this.title = '';
                    this.description = '';
                    Swal.fire({
                      position: 'center',
                      icon: 'success',
                      title: 'Secteur ajouté',
                      showConfirmButton: false,
                      timer: 1500
                    })
                    this.$emit("added");
             }).catch(err => console.log(err));
        }
    }
}
</script>
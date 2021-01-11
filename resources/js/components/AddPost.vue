<template>
<div>
<div class="modal fade" id="addPost" tabindex="-1" aria-labelledby="addPost" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ajouter un article</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <form @submit="addPost" enctype="multipart/form-data">
              <div class="form-group">
                    <label for="">Categories</label>
                    <select v-model="category_id" class="form-control" name="category" required id="category">
                    <option value disabled selected>Veuillez choisir une categorie</option>    
                    <option v-for="(category,index) in categories " :key="index" :value="category.id">
                        {{category.title}}
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
                    <label for="">Image</label>
                    <input v-on:change="onImageChange" type="file" class="form-control-file" name="image" id="">
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
           category_id: '',
           is_published: '',
           categories: [],
           image: null,
        }
    },
     created(){
        axios.get('/api/categories')
        .then(response => this.categories = response.data.categories)
        .catch(err => console.log(err));
    },
    methods: {

        onImageChange(e){
            console.log(e.target.files[0]);
            this.image = e.target.files[0];
        },
        addPost(e){
            e.preventDefault();
            const config = {
                headers : {"content-type" : "multipart/form-data"}
            }

            let formData = new FormData();
            formData.append('image', this.image);
            formData.append('title', this.title);
            formData.append('text', this.text);
            formData.append('category_id' , this.category_id);
            formData.append('user_id', User.isLogged().id);
            formData.append('is_published',this.is_published);
            formData.append('published_by', User.isLogged().id);
            axios.post('/api/posts', formData,config)
             .then(res => {
                    $('#addPost').modal('hide');
                    this.title = '';
                    this.image = null;
                    this.text = null;
                    this.category_id = '';
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
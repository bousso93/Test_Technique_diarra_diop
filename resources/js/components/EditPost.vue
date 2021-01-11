<template>
<div>
<div class="container" >
  <div class="row my-4">
    <div class="col-md-8 mx-auto mt-5">
      <div class="card bg-light">
        <h3 class="card-header" >Modifier un article</h3>
      <div class="card-body">
         <form @submit="updatePost" enctype="multipart/form-data">
              <div class="form-group">
                    <label for="">Categories</label>
                    <select v-model="post.category_id" class="form-control" name="category" required id="category">
                    <option value disabled selected>Veuillez choisir une categorie</option>    
                    <option v-for="(category,index) in categories " :key="index" :value="category.id">
                        {{category.title}}
                    </option>
                    </select>
              </div>
              <div class="form-group">
                    <label for="">Titre</label>
                    <input v-model="post.title" type="text" required class="form-control" id="title" name="title" placeholder="Titre de l'article">
              </div>
              <div class="form-group">
                    <label for="">Contenu</label>
                    <textarea v-model="post.text" required class="form-control" id="" placeholder="contenu" name="text" rows="5"></textarea>
              </div>
              <div class="form-group">
                    <label for="">Image</label>
                    <input v-on:change="onImageChange" type="file" class="form-control-file" name="image" id="">
              </div>
              <div class="form-group">
                    <label for="">Publier</label>
                      <div class="form-check form-check-inline">
                        <input v-model="post.is_published" class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="1">
                        <label class="form-check-label" for="inlineRadio1">Oui</label>
                        </div>
                        <div class="form-check form-check-inline">
                        <input v-model="post.is_published" class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="0">
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
           post: {
                title: "",
                text: "",
                category_id: "",
                is_published: ""
           },
           categories: [],
           image: null,
        }
    },
     created(){
       this.getPosts();
       this.getCategories();
    },
    methods: {

        onImageChange(e){
            console.log(e.target.files[0]);
            this.image = e.target.files[0];
        },
        getCategories(){
               axios.get('/api/categories')
                .then(response => {
                    console.log(response.data.categories);
                    this.categories = response.data.categories
                    })
                .catch(err => console.log(err));
        },
        getPosts(){
           axios.get(`/api/posts/${this.$route.params.slug}`)
               .then(response => {
              console.log('post', response.data.post);
             this.post = response.data.post;
             this.image= response.data.post.image;
          }).catch(err => console.log(err));
        },
        updatePost(e){
            e.preventDefault();
            const config = {
                headers : {"content-type" : "application/x-www-form-urlencoded"}
            }

            let formData = new FormData();
            formData.append('image', this.image);
            formData.append('title', this.post.title);
            formData.append('text', this.post.text);
            formData.append('category_id' , this.post.category_id);
            formData.append('user_id', User.isLogged().id);
            formData.append('is_published',this.post.is_published);
            formData.append('published_by', User.isLogged().id);
            formData.append('_method', 'put');
            axios.post(`/api/posts/${this.post.slug}`, formData,config)
             .then(res => {
                    this.post.title = '';
                    this.image = null;
                    this.post.text = null;
                    this.post.category_id = '';
                    this.post.is_published = '';
                    Swal.fire({
                      position: 'center',
                      icon: 'success',
                      title: 'Article modifié',
                      showConfirmButton: false,
                      timer: 1500
                    })
                    this.$router.push({name : "allPosts"});
             }).catch(err => console.log(err));
        }
    }
}
</script>
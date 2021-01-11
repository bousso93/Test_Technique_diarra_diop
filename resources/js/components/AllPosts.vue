<template>
    <div class="container">
       <div class="row my-4">
           <div class="col-md-12">
               <a href="#" data-target="#addPost" data-toggle="modal" class="btn btn-sm btn-success text-white mb-2">
                  <i class="fa fa-plus"></i>
               </a>
               <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Categorie</th>
                        <th scope="col">Titre</th>
                        <th scope="col">Contenu</th>
                        <!-- <th scope="col">Image</th> -->
                        <th scope="col">Ajouté par</th>
                        <th scope="col">Le</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(post,index) in posts.data" :key="index">
                        <th scope="row">{{post.id}}</th>
                        <td>{{post.category.title}}</td>
                        <td>{{post.title}}</td>
                        <td>{{post.text.substr(0,100)}}....</td>
                        <!-- <td>
                            <img :src="'http://127.0.0.1:8000'+post.image" height="60" width="60" class="img-fluid mr-2 rounded shadow-sm" alt="">
                        </td> -->
                        <td>{{post.user.name}}</td>
                        <td>{{post.added}}</td>
                        <td class="d-flex flex-row justify-content-center align-items-center">
                            <router-link :to="post.path" class="btn mr-2 btn-sm btn-primary">
                             <div class="fa fa-eye"></div>
                            </router-link>
                            <router-link :to="{path : '/post/edit/' + post.slug}"
                             class="btn mr-2 btn-sm btn-warning"
                            >
                             <div class="fa fa-edit"></div>
                            </router-link>

                            <a @click="deletePost(post.slug)" class="btn btn-sm btn-danger text-white ">
                              <i class="fa fa-trash"></i>
                             </a>
                        </td>
                        </tr>
                    </tbody>
                </table>
                <AddPost @added="postAdded"/>
           </div>
       </div>
    </div>
</template>

<script >
import AddPost from './AddPost'
export default {
    data(){
        return{
           posts : {},
           loading : true,
        }
    },
    components:{
        AddPost,
    },
    created (){
        this.getPosts();
    },
    methods: {
         getPosts(){
                axios.get('/api/posts')
                .then(response => {
                    console.log(response.data);
                    this.posts = response.data;
                })
                .catch(err => console.log(err));
            },
          postAdded(){
              this.getPosts();
          },
          deletePost(slug){
            Swal.fire({
            title: 'Etes vous sur de vouloir supprimer?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirmer',
            cancelButtonText: 'Annuler',
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(`/api/posts/${slug}`)
                    .then(res => {
                         Swal.fire(
                    'Suppression!',
                    'Article supprimé avec succés.',
                    'success'
                    )
                    this.getPosts();
                    }).catch(err => console.log(err));
                   
                }
                });
          }  
    }
}
</script>
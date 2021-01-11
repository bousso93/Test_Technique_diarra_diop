<template>
    <div class="container">
        <div class="row my-4">
            <div class="col-md-8 mx-auto mt-5">
                <div class="card">
                    <div class="card-header">{{post.title}}</div>
                     <p class="p-2">
                        <span class="badge badge-default">
                          {{post.user}}
                        </span>
                        <span class="badge badge-info">
                          {{post.created_at}}
                        </span>
                         <span class="badge badge-success">
                          {{post.category}}
                        </span>
                     </p>
                    <div class="card-img-top">
                       <img style="width:100%; height:400px" :src="post.image" class="rounded shadow-sm img-fluid mr-2" alt="">
                    </div>
                    <div class="card-body">
                        <div class="media">
                            <div class="media-body">
                                <p class="lead">{{post.text}}</p>
                            </div>
                        </div>
                    </div>
      
                <div class="row my-3">
                    <div class="col-md-12">
                        <div class="media shadow my-4 p-4">
                            <div class="media-body">
                                <h3 class="my-3 text-dark">
                                    Ajouter un commentaire
                                </h3>
                                <div class="form-group">
                                    <label for="commentaire"></label>
                                    <textarea class="form-control" v-model="comment" id="" cols="10" rows="5"></textarea>
                                </div>
                                <button @click="addComment(post.id)" type="button" name="" id="" class="btn btn-primary" >Valider</button>
                            </div>
                        </div>
                        <h3 class="text-info mb-3">
                            Commentaire
                            <span class="badge badge-dark p-2">{{post.comments_count}}</span>
                        </h3>
                        <div class="media my-4 p-4 shadow"
                         v-for="(comment,index) in post.comment"
                         :key="index"
                        >
                         <div class="media-body">
                             <span class="text-danger">
                                 {{comment.user}} | {{comment.created_at}}
                             </span>
                             <p class="lead">
                                 {{comment.text}}
                             </p>
                         </div>

                        </div>
                    </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</template>

<script>
import router from '../routes/route.js';
export default {
    
    data(){
        return{
            post: '',
            comment: ''
        }
    },
   
    created(){
        axios.get(`/api/posts/${this.$route.params.slug}`)
          .then(response => {
              console.log(response.data.post);
             this.post = response.data.post;
          }).catch(err => console.log(err));

    },
    methods: {
        addComment(id){
            axios.post('/api/comments',{
                post_id: id,
                text: this.comment,
                user_id: User.isLogged().id
            }).then(response => {
                this.post.comment_count+=1;
                this.post.comment.unshift(response.data);
                this.comment = null;
                this.$router.go();
            }).catch(err => console.log(err));
        }
    }
}
</script>
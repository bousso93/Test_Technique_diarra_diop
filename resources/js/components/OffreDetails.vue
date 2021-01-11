<template>
    <div class="container">
        <div class="row my-4">
            <div class="col-md-8 mx-auto mt-5">
                <div class="card">
                    <div class="card-header">{{offre.title}}</div>
                     <p class="p-2">
                        <span class="badge badge-default">
                          {{offre.user}}
                        </span>
                        <span class="badge badge-info">
                          {{offre.created_at}}
                        </span>
                         <span class="badge badge-success">
                          {{offre.secteur}}
                        </span>
                     </p>
                    <div class="card-body">
                        <div class="media">
                            <div class="media-body">
                                <p class="lead">{{offre.text}}</p>
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
            offre: '',
        }
    },
   
    created(){
        axios.get(`/api/offres/${this.$route.params.slug}`)
          .then(response => {
              console.log('offre',response.data.offre);
             this.offre = response.data.offre;
          }).catch(err => console.log(err));

    },
    methods: {
       
    }
}
</script>
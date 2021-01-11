<template>
    <div class="container">
        <div class="row my-4">
            <Secteur></Secteur>
            <div class="col-md-8 mx-auto ">
                <div class="card">
                    <div class="card-header">Offres</div>

                    <div class="card-body" 
                    v-for="(offre,index) in offres.data"
                    :key="index"
                    >
                    <div class="media">
                       <div class="media-body">
                           <router-link :to="offre.path">
                           <h3>{{offre.title}}</h3>
                           </router-link>
                           <p>
                               <span class="text-default">
                                   {{offre.user.name}}
                               </span>
                                <span class="text-danger">
                                   {{offre.added}}
                               </span>
                           </p>
                           <p class="lead">{{offre.text.substr(0,200)}}....</p>
                       </div>
                    </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Secteur from './Secteur.vue';
    export default {
        data(){
            return{
                offres : {}
            }
        },
        components : {
           Secteur
        },
        created (){
            this.getOffres();
        },

        methods: {
            getOffres(){
                axios.get('/api/offres')
                .then(response => {
                    console.log(response.data);
                    this.offres = response.data;
                })
                .catch(err => console.log(err));
            }

        },
    }
</script>

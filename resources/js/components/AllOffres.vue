<template>
    <div class="container">
       <div class="row my-4">
           <div class="col-md-12">
               <a href="#" data-target="#addOffre" data-toggle="modal" class="btn btn-sm btn-success text-white mb-2">
                  <i class="fa fa-plus"></i>
               </a>
               <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Secteur</th>
                        <th scope="col">Titre</th>
                        <th scope="col">Contenu</th>
                        <th scope="col">Ajouté par</th>
                        <th scope="col">Le</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(offre,index) in offres.data" :key="index">
                        <th scope="row">{{offre.id}}</th>
                        <td>{{offre.sector.title}}</td>
                        <td>{{offre.title}}</td>
                        <td>{{offre.text.substr(0,100)}}....</td>
                        <td>{{offre.user.name}}</td>
                        <td>{{offre.added}}</td>
                        <td class="d-flex flex-row justify-content-center align-items-center">
                            <router-link :to="offre.path" class="btn mr-2 btn-sm btn-primary">
                             <div class="fa fa-eye"></div>
                            </router-link>
                            <router-link :to="{path : '/offre/edit/' + offre.slug}"
                             class="btn mr-2 btn-sm btn-warning"
                            >
                             <div class="fa fa-edit"></div>
                            </router-link>

                            <a @click="deleteOffre(offre.slug)" class="btn btn-sm btn-danger text-white ">
                              <i class="fa fa-trash"></i>
                             </a>
                        </td>
                        </tr>
                    </tbody>
                </table>
                <AddOffre @added="offreAdded"/>
           </div>
       </div>
    </div>
</template>

<script >
import AddOffre from './AddOfrre'
export default {
    data(){
        return{
           offres : {},
           loading : true,
        }
    },
    components:{
        AddOffre,
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
            },
          offreAdded(){
              this.getOffres();
          },
          deleteOffre(slug){
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
                    axios.delete(`/api/offres/${slug}`)
                    .then(res => {
                         Swal.fire(
                    'Suppression!',
                    'Offre supprimé avec succés.',
                    'success'
                    )
                    this.getOffres();
                    }).catch(err => console.log(err));
                   
                }
                });
          }  
    }
}
</script>
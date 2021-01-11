<template>
    <div class="container">
       <div class="row my-4">
           <div class="col-md-12">
               <a href="#" data-target="#addSecteur" data-toggle="modal" class="btn btn-sm btn-success text-white mb-2">
                  <i class="fa fa-plus"></i>
               </a>
               <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Titre</th>
                        <th scope="col">Description</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(secteur,index) in secteurs"
                          :key="index">
                        <th scope="row">{{secteur.id}}</th>
                        <td>{{secteur.title}}</td>
                        <td>{{secteur.description.substr(0,100)}}...</td>
                        <td class="d-flex flex-row justify-content-center align-items-center">
                            <router-link to="#" class="btn mr-2 btn-sm btn-primary">
                             <div class="fa fa-eye"></div>
                            </router-link>
                            <router-link :to="{path : '/secteurs/edit/' + secteur.slug}"
                             class="btn mr-2 btn-sm btn-warning"
                            >
                             <div class="fa fa-edit"></div>
                            </router-link>

                            <a @click="deleteSecteur(secteur.slug)" class="btn btn-sm btn-danger text-white ">
                              <i class="fa fa-trash"></i>
                             </a>
                        </td>
                        </tr>
                    </tbody>
                </table>
                <AddSecteur @added="secteurAdded"/>
           </div>
       </div>
    </div>
</template>

<script >
import AddSecteur from './AddSecteur'
export default {
    data(){
        return{
           secteurs : {},
           loading : true,
        }
    },
    components:{
        AddSecteur,
    },
    created (){
        this.getSecteurs();
    },
    methods: {
          getSecteurs(){
                 axios.get('/api/secteurs')
                    .then(response => this.secteurs = response.data.secteurs)
                    .catch(err => console.log(err));
            },
          secteurAdded(){
              this.getSecteurs();
          },
          deleteSecteur(slug){
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
                    axios.delete(`/api/secteurs/${slug}`)
                    .then(res => {
                         Swal.fire(
                    'Suppression!',
                    'Secteur supprimé avec succés.',
                    'success'
                    )
                    this.getSecteurs();
                    }).catch(err => console.log(err));
                   
                }
                });
          }  
    }
}
</script>
<template>
    <div class="container">
       <div class="row my-4">
           <div class="col-md-12">
               <a href="#" data-target="#addCategory" data-toggle="modal" class="btn btn-sm btn-success text-white mb-2">
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
                        <tr  v-for="(category,index) in categories" :key="index">
                        <th scope="row">{{category.id}}</th>
                        <td>{{category.title}}</td>
                        <td>{{category.description.substr(0,100)}}...</td>
                        <td class="d-flex flex-row justify-content-center align-items-center">
                            <router-link to="#" class="btn mr-2 btn-sm btn-primary">
                             <div class="fa fa-eye"></div>
                            </router-link>
                            <router-link :to="{path : '/categories/edit/' + category.slug}"
                             class="btn mr-2 btn-sm btn-warning"
                            >
                             <div class="fa fa-edit"></div>
                            </router-link>

                            <a @click="deleteCategory(category.slug)" class="btn btn-sm btn-danger text-white ">
                              <i class="fa fa-trash"></i>
                             </a>
                        </td>
                        </tr>
                    </tbody>
                </table>
                <AddCategory @added="categoryAdded"/>
           </div>
       </div>
    </div>
</template>

<script >
import AddCategory from './AddCategory'
export default {
    data(){
        return{
           categories : {},
           loading : true,
        }
    },
    components:{
        AddCategory,
    },
    created (){
        this.getCategories();
    },
    methods: {
          getCategories(){
                axios.get('/api/categories')
                .then(response => this.categories = response.data.categories)
                .catch(err => console.log(err));
            },
          categoryAdded(){
              this.getCategories();
          },
          deleteCategory(slug){
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
                    axios.delete(`/api/categories/${slug}`)
                    .then(res => {
                         Swal.fire(
                    'Suppression!',
                    'Category supprimé avec succés.',
                    'success'
                    )
                    this.getCategories();
                    }).catch(err => console.log(err));
                   
                }
                });
          }  
    }
}
</script>
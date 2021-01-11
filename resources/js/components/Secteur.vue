<template>
    <div class="col-md-4">
        <div class="card">
            <h2 class="card-header">Secteur Activité</h2>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item"
                          v-for="(secteur,index) in secteurs"
                          :key="index"
                    > 
                   <router-link to="#">{{secteur.title}}</router-link> 
                    </li>
                </ul>
            </div>
        </div>

    </div>
</template>
<script>
export default {
    data(){
        return{
            secteurs: []
        }
    },
    created(){
        axios.get('/api/secteurs')
        .then(response => this.secteurs = response.data.secteurs)
        .catch(err => console.log(err));
    }
}
</script>
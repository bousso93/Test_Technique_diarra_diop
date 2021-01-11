<template>
    <div>
         <nav class="navbar navbar-expand-lg mb-4 navbar-light bg-light">
            <router-link class="navbar-brand" :to="home">Accueil</router-link>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                   <router-link class="navbar-brand" :to="home">Blog</router-link>
                </li>
                <li class="nav-item active">
                   <router-link class="navbar-brand" :to="carriere">Carriere</router-link>
                </li>
                <li class="nav-item active">
                   <router-link class="navbar-brand" :to="allPosts">Articles</router-link>
                </li>
                <li class="nav-item active">
                   <router-link class="navbar-brand" :to="allCategories">Categories</router-link>
                </li>
                <li class="nav-item active">
                   <router-link class="navbar-brand" :to="allOffres">Offres</router-link>
                </li>
                 <li class="nav-item active">
                   <router-link class="navbar-brand" :to="allSecteurs">Secteur d'activite</router-link>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link" :to="signup" v-if="!logged">Inscription</router-link>
                </li>
                <li class="nav-item">
                   <router-link class="nav-link" v-if="!logged" :to="login">Connexion</router-link>
                </li>
                <li class="nav-item">
                    <a class="nav-link" @click="Userlogout" style="cursor:pointer" v-if="logged">
                      <span class="font-weight-bold">{{name.toUpperCase()}}</span> Deconnexion
                    </a>
                </li>
                </ul>
            </div>
        </nav>
    </div>
</template>
<script>
export default {
    data(){
      return{
          home : '/',
          login : '/login',
          signup : '/signup',
          logout : '/logout',
          allPosts: '/allposts',
          carriere: '/carriere',
          allOffres: '/alloffres',
          allCategories: '/allcategories',
          allSecteurs: '/allsecteurs',
          logged : User.isLogged().logged,
          name : User.isLogged().name,
      }
    },
    methods: {
        Userlogout(){
            User.logout();
            this.logged = false;
            this.$router.go();
        }
    },
}
</script>
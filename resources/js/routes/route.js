import Vue from 'vue'
import VueRouter from 'vue-router'

import Home from '../components/Home.vue';
import Carriere from '../components/Carriere.vue';
import Login from '../components/Login.vue';
import Signup from '../components/Signup.vue';
import Logout from '../components/Logout.vue';
import PostDetails from '../components/PostDetails.vue';
import OffreDetails from '../components/OffreDetails.vue';
import PostCategory from '../components/PostCategory.vue';
import AllPosts from '../components/AllPosts.vue';
import AllCategories from '../components/AllCategories.vue';
import EditPost from '../components/EditPost.vue';
import EditOffre from '../components/EditOffre.vue';
import AllOffres from '../components/AllOffres.vue';
import AllSecteurs from '../components/AllSecteurs.vue';
Vue.use(VueRouter)

const routes = [
    {
        path: '/', 
        component: Home, 
        name: 'home'
    },
    {
        path: '/login', 
        component: Login, 
        name: 'login'
    },
    {
        path: '/signup', 
        component: Signup, 
        name: 'signup'
    },
    {
        path: '/logout', 
        component: Logout, 
        name: 'logout'
    },
    {
        path: '/posts/:slug',
        component: PostDetails,
        name: 'postDetails'
    },
    {
        path: '/offres/:slug',
        component: OffreDetails,
        name: 'offreDetails'
    },
    {
        path: '/post/edit/:slug',
        component: EditPost,
        name: 'editPost'
    },
    {
        path: '/offre/edit/:slug',
        component: EditOffre,
        name: 'editOffre'
    },
    {
        path: '/posts/category/:slug',
        component: PostCategory,
        name: 'postCategory'
    },
    {
        path: '/allposts',
        component: AllPosts,
        name: 'allPosts'
    },
    {
        path: '/allcategories',
        component: AllCategories,
        name: 'allCategories'
    },
    {
        path: '/allsecteurs',
        component: AllSecteurs,
        name: 'allSecteurs'
    },
    {
        path: '/carriere', 
        component: Carriere, 
        name: 'carriere'
    },
    {
        path: '/alloffres',
        component: AllOffres,
        name: 'allOffres'
    },
]

const router = new VueRouter({
    routes,
    hashbang : false,
    mode: 'history',
})

export default router;
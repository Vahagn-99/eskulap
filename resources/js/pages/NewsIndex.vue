<script setup>
    import {onMounted, reactive} from "vue";

    const state = reactive({
        news: {},
        email: null,
        password: null,
        loggedIn: null
    })

    function login(){
        axios.get('/sanctum/csrf-cookie').then(response => {
            axios.post('login', {
                email: state.email,
                password: state.password
            })
                .then(() => {
                    state.loggedIn = true
                })
        });
    }

    function logout(){
        axios.get('/sanctum/csrf-cookie').then(() => {
            axios.post('logout')
                .then(() => {
                    state.loggedIn = false
                })
        });
    }

    function getAuthUser(){
        axios.get('/api/user').then(res => {
            if(res.data && res.data.email){
                state.loggedIn = true
            }else{
                state.loggedIn = false
            }
        });
    }

    function getNews(){
        axios.get('/api/news')
            .then(res => {
                state.news = res.data
            })
    }

    onMounted(() => {
        getAuthUser()
        getNews()
    })
</script>

<template>
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid" v-if="!state.loggedIn">
            <p class="text-danger">You need to login before commenting.</p>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" v-model="state.email" placeholder="Email">
                <input class="form-control me-2" type="search" v-model="state.password" placeholder="Password">
                <button class="btn btn-outline-success" type="button" @click="login()">Login</button>
            </form>
        </div>
        <div v-else>
            <button class="btn btn-outline-success" type="button" @click="logout()">Logout</button>
        </div>
    </nav>
    <div class="row">
        <div class="col-3 mb-4" v-for="news in state.news">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ news.title }}</h5>
                    <p class="card-text">{{ news.body }}</p>
                    <router-link class="link-secondary" :to="{ name: 'news.show', params: { id: news.id } }">View</router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.card {
    min-height: 250px;
}
</style>

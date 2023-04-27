<script setup>
    import {onMounted, reactive} from "vue";
    import {useRoute, useRouter} from "vue-router";
    import Comment from "@/components/Comment.vue";

    const route = useRoute()
    const router = useRouter()
    const state = reactive({
        news: {},
        body: null,
        comment_data: {
            user_id: null,
            comment_id: null,
            body: null,
            news_id: route.params.id
        }
    })

    function createComment(data = null){
        if(!state.comment_data.user_id) {
            router.push({ name: 'news.index' })
        }else{
            if(data){
                state.comment_data.body = data.body
                state.comment_data.comment_id = data.comment_id
            }else{
                state.comment_data.body = state.body
            }
            axios.post(`/api/comments`, state.comment_data)
                .then(res => {
                    state.comment_data.body = null
                    state.body = null
                    state.comment_data.comment_id = null
                    getData()
                })
        }
    }

    function getData(){
        axios.get(`/api/news/${route.params.id}/show`)
            .then(res => {
                state.news = res.data
            })
    }

    function getAuthUser(){
        axios.get('/api/user').then(res => {
            if(res.data && res.data.email){
                state.comment_data.user_id = res.data.id
            }
        });
    }

    onMounted(() => {
        getData()
        getAuthUser()
    });
</script>

<template>
    <div class="d-flex justify-content-center">
        <div class="card col-6 text-center">
            <div class="card-body">
                <h5 class="card-title">{{state.news.title}}</h5>
                <p class="card-text">{{state.news.body}}</p>
            </div>

            <section class="gradient-custom">
                <div class="container my-5 py-5">
                    <div class="row d-flex justify-content-center">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body p-4">
                                    <h4 class="text-center mb-4 pb-2">Comments section</h4>

                                    <div class="form-outline mb-4">
                                        <input type="text" v-model="state.body" class="form-control" placeholder="Type comment..." />
                                        <label class="form-label cursor-pointer" for="addANote" @click="createComment()">+ Add a note</label>
                                    </div>

                                    <div class="row">
                                        <div class="col-12 mt-4" v-for="comment in state.news.comments">
                                            <Comment :comment="comment"
                                                @createComment="(data) => createComment(data)"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</template>

<style>
.cursor-pointer {
    cursor: pointer;
}
</style>

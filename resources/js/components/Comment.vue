<script setup>
    import {reactive} from "vue";

    const props = defineProps(['comment'])
    const state = reactive({
        comment_data: {
            body: null,
            comment_id: null
        }
    })
</script>

<template>
    <div class="d-flex flex-start">
        <img class="rounded-circle shadow-1-strong me-3"
             src="https://st3.depositphotos.com/1767687/16607/v/600/depositphotos_166074422-stock-illustration-default-avatar-profile-icon-grey.jpg" alt="avatar" width="65"
             height="65" />
        <div class="flex-grow-1 flex-shrink-1">
            <div>
                <div class="d-flex justify-content-between align-items-center">
                    <p class="mb-1">
                        {{ comment.name }}
                    </p>
                    <p @click.prevent="state.comment_data.comment_id = comment.id"><i class="fas fa-reply fa-xs"></i><span class="small cursor-pointer"> reply</span></p>
                </div>
                <p class="small mb-0">{{ comment.body }}</p>
            </div>
            <div class="form-outline mb-4 mt-4" v-if="state.comment_data.comment_id == comment.id">
                <input type="text" v-model="state.comment_data.body" class="form-control" placeholder="Type comment..." />
                <label class="form-label cursor-pointer" for="addANote" @click="$emit('createComment', state.comment_data)">+ Add</label>
            </div>

            <div class="d-flex flex-start mt-4" v-for="sub in comment.comments">
                <a class="me-3" href="#">
                    <img class="rounded-circle shadow-1-strong"
                         src="https://st3.depositphotos.com/1767687/16607/v/600/depositphotos_166074422-stock-illustration-default-avatar-profile-icon-grey.jpg" alt="avatar"
                         width="65" height="65" />
                </a>
                <div class="flex-grow-1 flex-shrink-1">
                    <div>
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="mb-1">{{ sub.name }}</p>
                        </div>
                        <p class="small mb-0">{{ sub.body }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<template>
    <button class="btn btn-default"
            v-bind:class="{'btn-success' : followed}"
            v-text="text"
            v-on:click="follow"
    ></button>
</template>


<script>
    export default {
        props: ['user', 'user_api'],
        mounted() {
            axios.post('/api/user/followers',{'user': this.user, 'user_api': this.user_api}).then(response => {
                this.followed = response.data.followed
            })

//            axios.post('/api/user/followers_count', {'user': this.user, 'user_api': this.user_api}).then(response => {
//                this.followers_count = response.data.followers_count
//            })
        },
        data() {
            return {
                followed: false
            }
        },
        computed: {
            text() {
                return this.followed ? '已关注' : '关注他'
            }
        },
        methods: {
            follow() {
                axios.post('/api/user/follow', {'user': this.user, 'user_api': this.user_api}).then(response => {
                    this.followed = response.data.followed
                });
//
//                axios.post('/api/user/followers_count', {'user': this.user, 'user_api': this.user_api}).then(response => {
//                    this.followers_count = response.data.followers_count
//                })
            }
        }
    }
</script>
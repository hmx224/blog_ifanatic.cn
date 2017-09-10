<template>
    <button class="btn btn-default"
            v-bind:class="{'btn-success' : followed}"
            v-text="text"
            v-on:click="follow"
    ></button>
</template>


<script>
    export default {
        //鉴于安全性,就去掉user,使用api获取用户信息
//        props: ['question', 'user'],
        props: ['question'],
        mounted() {
            //laravel5.3写法
//            this.$http.post('/api/question/follower', {'question': this.question}).then(response => {
            //laravel5.4
            axios.post('/api/question/follower', {'question': this.question}).then(response => {
                this.followed = response.data.followed
            })
        },
        data() {
            return {
                followed: false
            }
        },
        computed: {
            text() {
                return this.followed ? '已关注' : '关注该问题'
            }
        },
        methods: {
            follow() {
                //laravel5.3写法
//                this.$http.post('/api/question/follow', {'question': this.question}).then(response => {
                //laravel5.4
                axios.post('/api/question/follow', {'question': this.question}).then(response => {
//                    console.log(response.data);
                    this.followed = response.data.followed
                })
            }
        }
    }
</script>
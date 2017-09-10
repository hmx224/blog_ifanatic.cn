<template>
    <button class="btn btn-default"
            v-bind:class="{'btn-success' : voted}"
            v-text="text"
            v-on:click="vote"
    ></button>
</template>


<script>
    export default {
        props: ['answer', 'count'],
        mounted() {
            axios.post('/api/answer/' + this.answer + '/votes/users').then(response => {
                this.voted = response.data.voted
            })

        },
        data() {
            return {
                voted: false,
                answer_count:this.count
            }
        },
        computed: {
            text() {
                return this.answer_count
            }
        },
        methods: {
            vote() {
                axios.post('/api/answer/vote', {'answer': this.answer}).then(response => {
                    this.voted = response.data.voted;
                    response.data.voted ? this.answer_count ++ : this.answer_count --
                });
            }
        }
    }
</script>
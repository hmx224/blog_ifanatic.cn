<template>
    <div>
        <button class="button is-naked delete-button"
                style="margin: -10px 0 0 40px"
                @click="showCommentForm"
                v-text="text"
        >
        </button>

        <!--使用passport中的模板-->
        <div class="modal fade" :id="dialog" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                        <h4 class="modal-title">
                            评论列表
                        </h4>
                    </div>

                    <div class="modal-body">
                        <div v-if="comments.length > 0">
                            <div class="media" v-for="comment in comments">
                                <div class="media-left">
                                    <a href="#">
                                        <img :src="comment.user.avatar" alt="会员头像" class="media-object img-circle"
                                             width="50px" height="50px">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">{{ comment.user.name}}</h4>
                                    {{ comment.body }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Actions -->
                    <div class="modal-footer">

                        <textarea type="text" class="form-control" v-model="body" placeholder="开始畅聊..."></textarea>
                        <button type="button" class="btn btn-primary" @click="store">
                            评论
                        </button>

                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>


<script>
    export default {
        props: ['type', 'model', 'count'],
        data() {
            return {
                body: '',
                comments: [],
                newComment: { //展示评论列表信息
                    user: {
                        name: Ifanatic.name,
                        avatar: Ifanatic.avatar
                    },
                    body: ''
                },
                comment_count: this.count
            }
        },
        computed: {
            dialog(){
                return 'comments-dialog-' + this.type + '-' + this.model
            },
            dialogId(){
                return '#' + this.dialog
            },
            text(){
                return this.comment_count + '评论'
            },
        },
        methods: {
            store() {
                axios.post('/api/comment', {
                    'type': this.type,
                    'model': this.model,
                    'body': this.body
                }).then(response => {
                    let comment = {
                        user: {
                            name: Ifanatic.name,
                            avatar: Ifanatic.avatar
                        },
                        body: response.data.body
                    }
                    this.comments.push(comment);

//                    this.newComment.body = response.data.body;
//                    this.comments.push(this.newComment);
                    this.body = '';
                    this.comment_count++;
                });
            },

            showCommentForm(){
                this.getComments();
                $(this.dialogId).modal('show');
            },

            getComments(){
                axios.get('/api/' + this.type + '/' + this.model + '/comments').then(res => {
                    console.log(res.data);
                    this.comments = res.data
                })
            }
        }
    }
</script>
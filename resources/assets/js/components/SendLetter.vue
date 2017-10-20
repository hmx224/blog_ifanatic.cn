<template>
    <div>
        <button class="btn btn-default pull-right"
                style="margin-top: -35px"
                @click="showSendLetterForm"
        >发送私信
        </button>

        <!--使用passport中的模板-->
        <div class="modal fade" id="modal-send-letter" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                        <h4 class="modal-title">
                            发送私信
                        </h4>
                    </div>

                    <div class="modal-body">
                        <textarea name="body" class="form-control" v-model="body" v-if="!status"></textarea>
                        <div class="alert alert-success" v-if="status">
                            <strong>私信发送成功</strong>
                        </div>
                    </div>
                    <!-- Modal Actions -->
                    <div class="modal-footer">

                        <button type="button" class="btn btn-default" @click="store">
                            发送私信
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
        props: ['user'],
        data() {
            return {
                body: '',
                status: false
            }
        },
        methods: {
            store() {
                axios.post('/api/letter/store', {'user': this.user, 'body': this.body}).then(response => {
                    this.status = response.data.status
                    this.body = ''

                    //2s后执行隐藏弹框
                    setTimeout(function () {
                        $('#modal-send-letter').modal('hide')
                    }, 2000)
                });
            },
            showSendLetterForm(){
                $('#modal-send-letter').modal('show');
                this.status = false;
            }
        }
    }
</script>
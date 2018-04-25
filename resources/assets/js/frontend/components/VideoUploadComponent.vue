// https://appdividend.com/2018/02/13/vue-js-laravel-file-upload-tutorial/

<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">File Upload Component</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3" v-if="image">
                                <img :src="image" class="img-responsive" height="70" width="90">
                            </div>
                            <div class="col-md-6">
                                <input type="file" v-on:change="onVideoChange" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-success btn-block" @click="uploadVideo">Upload</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "VideoUploadComponent.vue",
        data(){
            return {
                image: ''
            }
        },
        methods: {
            onVideoChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createVideo(files[0]);
            },
            createVideo(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.image = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            uploadVideo(){
                axios.post('/image/store',{image: this.image}).then(response => {
                    console.log(response);
                });
            }
        }
    }
    // name: "VideoUploadComponent.vue"
</script>

<style scoped>

</style>

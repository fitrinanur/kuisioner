<template>

    <div class="row">
        <div class="col-md-6 justify-content-center m-auto">
            <div class="card shadow">
                <div class="card-header border-0 tag-title d-flex justify-content-between align-items-center">

                    <h3 class="mb-0">{{ $t('back_end.table.edit_icon') }}</h3>
                    <router-link to="/icon">
                        <button class="btn btn-icon btn-3 btn-primary" type="button">
                            <span class="btn-inner--icon"><i class="fas fa-arrow-left"></i></span>
                            <span class="btn-inner--text">{{ $t('back_end.table.back') }}</span>
                        </button>
                    </router-link>

                </div>
                <div class="col-md-12">
                    <form @submit.prevent="updateIcon">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">

                                    <label>{{ $t('back_end.table.title') }} <span>*</span></label>
                                    <input v-model="form.title" type="text" name="title" class="form-control" :class="{ 'is-invalid': form.errors.has('title') }">
                                    <has-error :form="form" field="title"></has-error>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">

                                    <label>{{ $t('back_end.table.icon_upload') }} <span>*</span></label>

                                    <input type="file" v-on:change="uploadPhoto" name="photo" class="form-control" :class="{ 'is-invalid': form.errors.has('photo') }">
                                    <span class="preview_img_span">{{ $t('back_end.table.img_size') }}:128x128</span>
                                    <has-error :form="form" field="photo"></has-error>

                                </div>
                                <img class="img-avatar img-avatar96 img-avatar-thumb" :src="getProfilePhoto()" :alt="form.photo">
                                <br>
                                <br>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group mb-4">
                                        <button type="submit" class="btn btn-primary btn-block"> {{ $t('back_end.table.update') }} </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</template>

<script>

    export default {

        data () {
            return {
              // Create a new form instance
              form: new Form({
                title: '',
                photo: ''
              })
            }
        },

        methods: {

            getProfilePhoto(){
                let prefix = (this.form.photo.match(/\//) ? '' : '/public-assets/images/icon/');
                return prefix + this.form.photo;
            },

            updateIcon(){
                this.$Progress.start();
                this.form.patch(`/api/icon/${this.$route.params.id}`)
                .then(()=>{

                  toast.fire({
                    type: 'success',
                    title: 'Icon Updated successfully.'
                  })

                  this.$router.push('/icon')

                }).catch(()=>{
                  //
                })

                this.$Progress.finish();
                
            },

            uploadPhoto(e){
                let file = e.target.files[0];
                let reader = new FileReader();

                //check file size
                if(file['size'] < 2111775) {
                    reader.onloadend = (file) => {
                        //console.log('RESULT', reader.result)
                        this.form.photo = reader.result;
                    }
                    reader.readAsDataURL(file)
                } else {
                    Swal.fire({
                        title: 'Oops...',
                        text: "You are uploading a large file.",
                        type: 'fel',
                    })
                }
            }
            
        },

        mounted() {
            axios.get(`/api/edit-icon/${this.$route.params.id}`)
              .then((response)=>{
                this.form.fill(response.data.icon)
            })
        }
    }
    
</script>
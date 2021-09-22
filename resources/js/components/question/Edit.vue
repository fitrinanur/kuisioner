<template>

  <div class="row">
      <div class="col-md-6 justify-content-center m-auto">
          <div class="card shadow">
              <div class="card-header border-0 tag-title d-flex justify-content-between align-items-center">

                  <h3 class="mb-0">Edit Pertanyaan</h3>
                  <router-link to="/questions">
                      <button class="btn btn-icon btn-3 btn-primary" type="button">
                          <span class="btn-inner--icon"><i class="fas fa-arrow-left"></i></span>
                          <span class="btn-inner--text">{{ $t('back_end.table.back') }}</span>
                      </button>
                  </router-link>

              </div>
              <div class="col-md-12">
                  <form @submit.prevent="updateQuestion">
                      <div class="row">
                          <div class="col-md-12">
                              <div class="form-group">

                                  <label>Data Pertanyaan :</label>
                                  <input v-model="form.question" type="text" name="question" class="form-control" :class="{ 'is-invalid': form.errors.has('question') }">
                                  <has-error :form="form" field="question"></has-error>

                              </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-md-12">
                              <div class="form-group">

                                  <label>Upload Gambar Untuk Pertanyaan ({{ $t('back_end.table.optional') }})</label>

                                  <input type="file" v-on:change="uploadPhoto" name="photo" class="form-control" :class="{ 'is-invalid': form.errors.has('photo') }">
                                  <span class="preview_img_span">{{ $t('back_end.table.img_size') }}:128x128</span>
                                  <has-error :form="form" field="photo"></has-error>

                              </div>
                              <img v-if="form.photo" :src="getProfilePhoto()" class="preview_img">
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
                question: '',
                photo: ''
              })
            }
        },

        methods: {
            getProfilePhoto(){
                let prefix = (this.form.photo.match(/\//) ? '' : '/public-assets/images/question/');
                return prefix + this.form.photo;
            },

            updateQuestion(){
                this.$Progress.start();

                this.form.patch(`/api/questions/${this.$route.params.id}`)
               
                .then(()=>{

                  toast.fire({
                    type: 'success',
                    title: 'Pertanyaan Berhasil Diperbarui.'
                  })

                  this.$router.push('/questions')

                }).catch(()=>{
                  // shoe message if data not saved
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
                    console.log("ok");
                } else {
                    Swal.fire({
                        title: 'Oops...',
                        text: "Ukuran file kamu terlalu besar.",
                        type: 'fel',
                    })
                }
            }
            
        },

        mounted() {
            axios.get(`/api/edit-question/${this.$route.params.id}`)
              .then((response)=>{
                this.form.fill(response.data.question)
            })
        }
    }
    
</script>
<template>

  <div class="row">
      <div class="col-md-6 justify-content-center m-auto">
          <div class="card shadow">
              <div class="card-header border-0 tag-title d-flex justify-content-between align-items-center">

                  <h3 class="mb-0">{{ $t('back_end.table.add_new_question') }}</h3>
                  <router-link to="/questions">
                      <button class="btn btn-icon btn-3 btn-primary" type="button">
                          <span class="btn-inner--icon"><i class="fas fa-arrow-left"></i></span>
                          <span class="btn-inner--text">{{ $t('back_end.table.back') }}</span>
                      </button>
                  </router-link>

              </div>
              <div class="col-md-12">
                  <form @submit.prevent="createQuestion">
                        <div class="row">
                          <div class="col-md-12">
                              <div class="form-group">
                                  <vue-single-select placeholder="Please select a indicator" you-want-to-select-a-post="id" v-model="form.questionIndicatorId" out-of-all-these-posts="makes sense" :options="indicators.indicators" you-like-bootstrap="yes" a-post-has-an-id="id" option-value="id" the-post-has-a-title="make sure to show these" option-label="indicator" class="form-control" :class="{ 'is-invalid': form.errors.has('questionIndicatorId') }"></vue-single-select>
                                  <has-error :form="form" field="questionIndicatorId"></has-error>

                              </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-md-12">
                              <div class="form-group">

                                  <label>{{ $t('back_end.table.question_text') }}:</label>
                                  <input v-model="form.question" type="text" name="question" class="form-control" :class="{ 'is-invalid': form.errors.has('question') }">
                                  <has-error :form="form" field="question"></has-error>

                              </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-md-12">
                              <div class="form-group">

                                  <label>Tambahkan Gambar ({{ $t('back_end.table.optional') }})</label>

                                  <input type="file" v-on:change="uploadPhoto" name="photo" class="form-control" :class="{ 'is-invalid': form.errors.has('photo') }">
                                  <span class="preview_img_span">{{ $t('back_end.table.img_size') }}:128x128</span>
                                  <has-error :form="form" field="photo"></has-error>

                              </div>
                              <br>
                              <br>
                          </div>
                          <div class="col-md-12">
                              <div class="form-group">
                                  <div class="input-group mb-4">
                                      <button type="submit" class="btn btn-primary btn-block"> {{ $t('back_end.table.add') }} </button>
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
                indicators: [],
              // Create a new form instance
              form: new Form({
                questionIndicatorId:'',
                question: '',
                photo: ''
              })
            }
        },

        methods: {
            getProfilePhoto(){

                 let prefix = (this.form.photo.match(/\//) ? '' : 'public-assets/images/question/');
                 return prefix + this.form.photo;

            },

            createQuestion(){
                this.$Progress.start();
                this.form.post(window.location.origin+'/api/questions')
                .then(()=>{

                  toast.fire({
                    type: 'success',
                    title: 'Question created.'
                  })

                  this.$router.push('/questions')

                }).catch(()=>{
                  // shoe message if data not saved
                })

                this.$Progress.finish();
                
            },

            loadQuestionIndicators(){
               axios.get("/api/create-indicator").then(({ data }) => (this.indicators = data));
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
            this.loadQuestionIndicators();
        }
    }
    
</script>
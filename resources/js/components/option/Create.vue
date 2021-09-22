<template>

  <div class="row">
      <div class="col-md-6 justify-content-center m-auto">
          <div class="card shadow">
              <div class="card-header border-0 tag-title d-flex justify-content-between align-items-center">

                  <h3 class="mb-0">{{ $t('back_end.table.add_opt') }}</h3>
                  <router-link to="/options">
                      <button class="btn btn-icon btn-3 btn-primary" type="button">
                          <span class="btn-inner--icon"><i class="fas fa-arrow-left"></i></span>
                          <span class="btn-inner--text">{{ $t('back_end.table.back') }}</span>
                      </button>
                  </router-link>

              </div>
              <div class="col-md-12">
                  <form @submit.prevent="createOption">
                      <div class="row">
                          <div class="col-md-12">
                              <div class="form-group">

                                  <vue-single-select placeholder="Please select a question" you-want-to-select-a-post="id" v-model="form.questionId" out-of-all-these-posts="makes sense" :options="questions.questions" you-like-bootstrap="yes" a-post-has-an-id="id" option-value="id" the-post-has-a-title="make sure to show these" option-label="question" class="form-control" :class="{ 'is-invalid': form.errors.has('questionId') }"></vue-single-select>
                                  <has-error :form="form" field="questionId"></has-error>

                              </div>
                          </div>
                      </div>

                      <label>{{ $t('back_end.table.choose_ans_typ') }}:</label>
                      <div class="checkboxWrap d-flex">
                          <div class="custom-control custom-radio mb-3 mr-4">
                              <input class="custom-control-input" id="customRadio5" v-model="form.choose_option" value="text" type="radio">
                              <label class="custom-control-label" for="customRadio5">{{ $t('back_end.table.text') }}</label>
                          </div>
                          <div class="custom-control custom-radio mb-3">
                              <input class="custom-control-input" id="customRadio6" v-model="form.choose_option" value="img" type="radio">
                              <label class="custom-control-label" for="customRadio6">{{ $t('back_end.table.picture') }}</label>
                          </div>
                      </div>
                      <has-error :form="form" field="choose_option" class="mb-3"></has-error>

                      <div v-show="form.choose_option === 'text'" class="row">
                          <div class="col-md-12">
                              <div class="form-group">

                                  <label>{{ $t('back_end.table.enter_opt') }}:</label>

                                  <input v-model="form.optionName" type="text" class="form-control" :class="{ 'is-invalid': form.errors.has('optionName') }">
                                  <has-error :form="form" field="optionName"></has-error>

                              </div>
                          </div>
                      </div>

                      <div v-show="form.choose_option === 'img'">
                          <div class="row">
                              <div class="col-md-12">
                                  <div class="form-group">

                                      <label>{{ $t('back_end.table.pic_opt') }}:</label>
                                      <input type="file" v-on:change="uploadPhoto" name="optionImg" class="form-control" :class="{ 'is-invalid': form.errors.has('optionImg') }">
                                      <has-error :form="form" field="optionImg"></has-error>

                                  </div>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-md-12">
                                  <div class="form-group">

                                      <div class="custom-control custom-checkbox mb-3">
                                          <input class="custom-control-input" v-model="form.isRadius" id="customCheck2" type="checkbox">
                                          <label class="custom-control-label" for="customCheck2">{{ $t('back_end.table.border_radius') }}</label>
                                      </div>

                                  </div>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-md-12">
                                  <div class="form-group">

                                      <div class="custom-control custom-checkbox mb-3">
                                          <input class="custom-control-input" v-model="form.isCircle" id="customCheck1" type="checkbox">
                                          <label class="custom-control-label" for="customCheck1">{{ $t('back_end.table.circle') }}</label>
                                      </div>

                                  </div>
                              </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-md-12">
                              <div class="form-group">

                                  <label>{{ $t('back_end.table.status') }}:</label>
                                  <select name="active" v-model="form.active" class="form-control" :class="{'is-invalid': form.errors.has('active')}">
                                      <option value="1" selected="selected">{{ $t('back_end.table.active') }}</option>
                                      <option value="2">{{ $t('back_end.table.inactive') }}</option>
                                  </select>

                              </div>
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
              questions: [],
              // Create a new form instance
              form: new Form({
                questionId:  '',
                choose_option:'',
                optionName:  '',
                optionImg :  '',
                isRadius:      '',
                isCircle:      '',
                active    :  1,
               
              })
            }
        },

        methods: {

            createOption(){
                this.$Progress.start();
                this.form.post(window.location.origin+'/api/options')
                .then(()=>{

                  toast.fire({
                    type: 'success',
                    title: 'Option Created successfully.'
                  })

                  this.$router.push('/options')

                }).catch(()=>{
                  // shoe message if data not saved
                })

                this.$Progress.finish();
                
            },

            loadQuestions(){
               axios.get("/api/create-option").then(({ data }) => (this.questions = data));
            },

            uploadPhoto(e){
                let file = e.target.files[0];
                let reader = new FileReader();

                //check file size
                if(file['size'] < 2111775) {
                    reader.onloadend = (file) => {
                        //console.log('RESULT', reader.result)
                        this.form.optionImg = reader.result;
                    }
                    reader.readAsDataURL(file)
                    console.log("ok");
                } else {
                    Swal.fire({
                        title: 'Oops...',
                        text: "You are uploading a large file.",
                        type: 'error',
                    })
                }
            }

            
        },

        mounted() {
            this.loadQuestions();
        }
    }
    
</script>

<template>

  <div class="row">
      <div class="col-md-6 justify-content-center m-auto">
          <div class="card shadow">
              <div class="card-header border-0 tag-title d-flex justify-content-between align-items-center">

                  <h3 class="mb-0">{{ $t('back_end.table.edit_result_opt') }}</h3>
                  <router-link to="/result-map">
                      <button class="btn btn-icon btn-3 btn-primary" type="button">
                          <span class="btn-inner--icon"><i class="fas fa-arrow-left"></i></span>
                          <span class="btn-inner--text">{{ $t('back_end.table.back') }}</span>
                      </button>
                  </router-link>

              </div>
              <div class="col-md-12">
                  <form @submit.prevent="updateRule">

                      <div class="queOption" v-for="(question, index) in questions.questions" :key="question.id">
                          <label><strong>{{ index+1 }} . </strong>{{ question.question }}</label>
                          <div class="checkboxWrap d-flex">
                              <div class="custom-control custom-radio mb-3 mr-4" v-for="(opt, key) in question.option" :key="key">
                                  <input class="custom-control-input" :id="opt.id" v-model="form.choose_option[index]" :value="opt.id" type="radio">
                                  <label class="custom-control-label" :for="opt.id">
                                      <span v-if="opt.optionName!=null">{{ opt.optionName }}</span>
                                      <span v-else>
                                        <img v-bind:src="getAvatar(opt.optionImg)" class="option-input-avatar">
                                      </span>
                                  </label>
                              </div>
                              <has-error :form="form" field="choose_option[index]" class="mb-3"></has-error>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-md-12">
                              <div class="form-group">

                                  <vue-single-select placeholder="Pick an icon title" you-want-to-select-a-post="id" v-model="form.icon_id" out-of-all-these-posts="makes sense" :options="questions.icons" you-like-bootstrap="yes" a-post-has-an-id="id" option-value="id" the-post-has-a-title="make sure to show these" option-label="title" class="form-control" :class="{ 'is-invalid': form.errors.has('icon_id') }"></vue-single-select>
                                  <has-error :form="form" field="icon_id"></has-error>

                              </div>
                          </div>
                      </div>

                      <div class="row">
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
                choose_option:[],
                icon_id:  '',
               
              })
            }
        },

        methods: {
            getAvatar(avatar){
              return "/public-assets/images/option/"+avatar;
            },

            updateRule(){
                this.$Progress.start();
                this.form.patch(`/api/option-suggestion/${this.$route.params.id}`)
                .then(()=>{

                  toast.fire({
                    type: 'success',
                    title: 'Rule Updated successfully.'
                  })

                  //this.$router.push('/icon')

                }).catch(()=>{
                  // shoe message if data not saved
                })

                this.$Progress.finish();
                
            },


            loadQuestions(){
              axios.get("/api/create-option-suggestion").then(({ data }) => (this.questions = data));
            },

            loadResult(){
                axios.get(`/api/edit-result/${this.$route.params.id}`)
                .then((response)=>{
                    this.form.icon_id = response.data.optionSuggestion.icon;
                    this.form.choose_option = JSON.parse(response.data.optionSuggestion.options_id);
                })
            },

            
        },

        mounted() {
            this.loadQuestions();
            this.loadResult();
        }
    }
    
</script>
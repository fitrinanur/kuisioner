<template>

  <div class="row">
      <div class="col-md-6 justify-content-center m-auto">
          <div class="card shadow">
              <div class="card-header border-0 tag-title d-flex justify-content-between align-items-center">

                  <h3 class="mb-0">Tambah Data Indikator Pertanyaan</h3>
                  <router-link to="/question-indicators">
                      <button class="btn btn-icon btn-3 btn-primary" type="button">
                          <span class="btn-inner--icon"><i class="fas fa-arrow-left"></i></span>
                          <span class="btn-inner--text">{{ $t('back_end.table.back') }}</span>
                      </button>
                  </router-link>

              </div>
              <div class="col-md-12">
                  <form @submit.prevent="createQuestionIndicator">
                      <div class="row">
                          <div class="col-md-12">
                              <div class="form-group">

                                  <label>Indikator :</label>
                                  <input v-model="form.indicator" type="text" name="indicator" class="form-control" :class="{ 'is-invalid': form.errors.has('indicator') }">
                                  <has-error :form="form" field="indicator"></has-error>

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
              // Create a new form instance
              form: new Form({
                indicator: '',
              })
            }
        },

        methods: {
            createQuestionIndicator(){
                this.$Progress.start();
                this.form.post(window.location.origin+'/api/question-indicators')
                .then(()=>{

                  toast.fire({
                    type: 'success',
                    title: 'Indikator Pertanyaan Berhasil Dibuat.'
                  })

                  this.$router.push('/question-indicators')

                }).catch(()=>{
                  // shoe message if data not saved
                })

                this.$Progress.finish();
                
            },            
        }
    }
    
</script>
<template>

  <div class="row">
      <div class="col-md-6 justify-content-center m-auto">
          <div class="card shadow">
              <div class="card-header border-0 tag-title d-flex justify-content-between align-items-center">

                  <h3 class="mb-0">{{ $t('back_end.table.update_profile') }}</h3>
                  <router-link to="/users">
                      <button class="btn btn-icon btn-3 btn-primary" type="button">
                          <span class="btn-inner--icon"><i class="fas fa-arrow-left"></i></span>
                          <span class="btn-inner--text">{{ $t('back_end.table.back') }}</span>
                      </button>
                  </router-link>

              </div>
              <div class="col-md-12">
                  <form @submit.prevent="updateUser">
                      <div class="row">
                          <div class="col-md-12">
                              <div class="form-group">

                                  <label>{{ $t('back_end.table.name') }} <span>*</span></label>

                                  <input v-model="form.name" type="text" name="name" class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                                  <has-error :form="form" field="name"></has-error>

                              </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-md-12">
                              <div class="form-group">

                                  <label>{{ $t('back_end.table.email') }} <span>*</span></label>
                                  <input v-model="form.email" type="text" name="email" class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                                  <has-error :form="form" field="email"></has-error>

                              </div>
                          </div>

                          <div class="col-md-12">
                              <div class="form-group">

                                  <div class="form-group">
                                      <label>{{ $t('back_end.table.password') }}</label>
                                      <input v-model="form.password" type="password" name="password" class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                                      <has-error :form="form" field="password"></has-error>
                                  </div>

                              </div>
                          </div>
                          <div class="col-md-12">
                              <div class="form-group">

                                  <div class="form-group">
                                      <label>{{ $t('back_end.table.confirm_password') }}</label>

                                      <input id="password-confirm" type="password" class="form-control" v-model="form.password_confirmation" name="password_confirmation" autocomplete="new-password">

                                  </div>

                              </div>
                          </div>
                          <div class="col-md-12">
                              <div class="form-group">

                                  <label>{{ $t('back_end.table.profile_photo') }}</label>
                                  <input type="file" @change="updateProfile" name="photo" class="form-control" :class="{ 'is-invalid': form.errors.has('photo') }">
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
                  id:'',
                  name : '',
                  email: '',
                  password: '',
                  photo: ''
              })
            }
        },
   
        methods:{

            getProfilePhoto(){

                 let prefix = (this.form.photo.match(/\//) ? '' : 'admin-assets/img/profile/');
                 return prefix + this.form.photo;

            },
    

            updateUser() {
                this.$Progress.start();
                this.form.put('api/profile/')
                .then(()=>{

                  toast.fire({
                    type: 'success',
                    title: 'Profile updated successfully!'
                  })

                    //Fire.$emit('AfterUpdate');
                    this.$Progress.finish();

                })
                .catch(() => {

                    this.$Progress.fail();

                });
            },

            updateProfile(e){
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
                        type: 'error',
                    })
                }
            }
        },

        created() {
            axios.get("api/profile")
            .then(({ data }) => (this.form.fill(data)));

        }
    

    }
</script>
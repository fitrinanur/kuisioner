<template>

        <div class="row">
            <div class="col-md-6 justify-content-center m-auto">
                <div class="card shadow">
                    <div class="card-header border-0 tag-title d-flex">
                        <h3 class="mb-0">{{ $t('back_end.table.system_settings') }}</h3>
                    </div>
                    <div class="col-md-12">
                        <form @submit.prevent="updateSetting">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{ $t('back_end.table.home_title') }} <span>*</span></label>
                                        <input v-model="form.main_title" type="text" name="main_title" class="form-control" :class="{ 'is-invalid': form.errors.has('main_title') }">
                                        <has-error :form="form" field="main_title"></has-error>

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">

                                        <label>{{ $t('back_end.table.home_details') }} <span>*</span></label>
                                        <textarea v-model="form.sort_desc" name="sort_desc" class="form-control" :class="{ 'is-invalid': form.errors.has('sort_desc') }"></textarea>
                                        <has-error :form="form" field="sort_desc"></has-error>

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">

                                        <label>{{ $t('back_end.table.logo_light_theme') }} <span>*</span></label>

                                        <input type="file" v-on:change="uploadLightLogo" name="light_logo" class="form-control" :class="{ 'is-invalid': form.errors.has('light_logo') }">

                                        <span class="preview_img_span">{{ $t('back_end.table.img_size') }}:108x108</span>
                                        <has-error :form="form" field="light_logo"></has-error>

                                    </div>
                                    <img class="img-avatar logo" :src="getPhoto('light_logo')" :alt="form.light_logo">
                                    <br>
                                    <br>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">

                                        <label>{{ $t('back_end.table.logo_dark_theme') }} <span>*</span></label>

                                        <input type="file" v-on:change="uploadDarkLogo" name="dark_logo" class="form-control" :class="{ 'is-invalid': form.errors.has('dark_logo') }">

                                        <span class="preview_img_span">{{ $t('back_end.table.img_size') }}:108x108</span>
                                        <has-error :form="form" field="dark_logo"></has-error>

                                    </div>
                                    <img class="img-avatar logo" :src="getPhoto('dark_logo')" :alt="form.dark_logo">
                                    <br>
                                    <br>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">

                                        <label>{{ $t('back_end.table.active_theme_style') }} <span>*</span></label>
                                        <div class="checkboxWrap d-flex">
                                            <div class="custom-control custom-radio mb-3 mr-4">
                                                <input id="customRadio5" v-model="form.theme_style" value="2" type="radio" class="custom-control-input">
                                                <label for="customRadio5" class="custom-control-label">{{ $t('back_end.table.light') }}</label>
                                            </div>
                                            <div class="custom-control custom-radio mb-3">
                                                <input id="customRadio6" value="1" v-model="form.theme_style" type="radio" class="custom-control-input">
                                                <label for="customRadio6" class="custom-control-label">{{ $t('back_end.table.dark') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div>

                                        <label>{{ $t('back_end.table.favicon_icon') }}</label>

                                        <input type="file" v-on:change="faviconUpload" name="favicon" class="form-control" :class="{ 'is-invalid': form.errors.has('dark_logo') }">

                                        <span class="preview_img_span">{{ $t('back_end.table.img_size') }}:70x70</span>
                                        <has-error :form="form" field="favicon"></has-error>

                                    </div>
                                    <img v-if="form.favicon" class="img-avatar logo favicon" :src="getPhoto('favicon') " :alt="form.favicon" >
                                    <br>
                                    <br>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">

                                        <label>{{ $t('back_end.table.site_title') }}</label>
                                        <input v-model="form.site_title" type="text" name="site_title" class="form-control" :class="{ 'is-invalid': form.errors.has('site_title') }">
                                        <has-error :form="form" field="site_title"></has-error>

                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{ $t('back_end.table.footer_text') }}</label>
                                        <input v-model="form.footer_text" type="text" name="footer_text" class="form-control" :class="{ 'is-invalid': form.errors.has('footer_text') }">
                                        <has-error :form="form" field="footer_text"></has-error>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
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
                main_title: '',
                sort_desc: '',
                light_logo: '',
                dark_logo: '',
                theme_style:2,
                favicon:'',
                site_title:'',
                footer_text:'',
              })
            }
        },

        methods: {

             getPhoto(data){
                 if(data == 'favicon'){
                    let prefix = (this.form.favicon.match(/\//) ? '' : '/public-assets/images/');
                    return prefix + this.form.favicon;
                 } else if (data == 'dark_logo') {
                    let prefix = (this.form.dark_logo.match(/\//) ? '' : '/public-assets/images/');
                    return prefix + this.form.dark_logo;
                 } else if (data == 'light_logo'){
                    let prefix = (this.form.light_logo.match(/\//) ? '' : '/public-assets/images/');
                    return prefix + this.form.light_logo;
                 } else {
                     return;
                 }
             },

             updateSetting(){
                this.$Progress.start();
                this.form.patch(`/api/setting`)
                .then(()=>{

                  toast.fire({
                    type: 'success',
                    title: 'Settings Updated successfully.'
                  })

                  this.$router.push('/settings')

                }).catch(()=>{
                  //
                })

                this.$Progress.finish();
                
             },

             uploadLightLogo(e){
                let file = e.target.files[0];
                let reader = new FileReader();

                //check file size
                if(file['size'] < 2111775) {
                    reader.onloadend = (file) => {
                        this.form.light_logo = reader.result;
                    }
                    reader.readAsDataURL(file)
                } else {
                    Swal.fire({
                        title: 'Oops...',
                        text: "You are uploading a large file.",
                        type: 'fel',
                    })
                }
             },

             uploadDarkLogo(e){
                let file = e.target.files[0];
                let reader = new FileReader();

                //check file size
                if(file['size'] < 2111775) {
                    reader.onloadend = (file) => {
                        //console.log('RESULT', reader.result)
                        this.form.dark_logo = reader.result;
                    }
                    reader.readAsDataURL(file)
                } else {
                    Swal.fire({
                        title: 'Oops...',
                        text: "You are uploading a large file.",
                        type: 'fel',
                    })
                }
             },

             faviconUpload(e){
                let file = e.target.files[0];
                let reader = new FileReader();

                //check file size
                if(file['size'] < 2111775) {
                    reader.onloadend = (file) => {
                        //console.log('RESULT', reader.result)
                        this.form.favicon = reader.result;
                    }
                    reader.readAsDataURL(file)
                } else {
                    Swal.fire({
                        title: 'Oops...',
                        text: "You are uploading a large file.",
                        type: 'fel',
                    })
                }
             },
            
        },

        mounted() {
            axios.get(`/api/setting-update`)
              .then((response)=>{
                this.form.fill(response.data)
            })
        }
    }
    
</script>
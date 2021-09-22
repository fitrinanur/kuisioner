<template>

<div class="row">
    <div class="col-md-6 justify-content-center m-auto">
        <div class="card shadow">

            <div class="card-header border-0 tag-title d-flex justify-content-between align-items-center">

                <h3 class="mb-0"> {{ $t('back_end.table.add_new_result') }} </h3>
                <router-link to="/result">
                    <button class="btn btn-icon btn-3 btn-primary" type="button">
                        <span class="btn-inner--icon"><i class="fas fa-arrow-left"></i></span>
                        <span class="btn-inner--text"> {{ $t('back_end.table.back') }} </span>
                    </button>
                </router-link>
            </div>
            <div class="col-md-12">
                <form @submit.prevent="createSuggestion">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">

                                <label>{{ $t('back_end.table.select_an_icon') }} <span>*</span></label>
                                <vue-single-select 
                                    placeholder="Select an icon title" 
                                    you-want-to-select-a-post="id" 
                                    v-model="form.icon_id" 
                                    out-of-all-these-posts="makes sense" 
                                    :options="icons.icons" 
                                    you-like-bootstrap="yes" 
                                    a-post-has-an-id="id" 
                                    option-value="id" 
                                    the-post-has-a-title="make sure to show these" 
                                    option-label="title" 
                                    class="form-control" 
                                    :class="{ 'is-invalid': form.errors.has('icon_id') }">
                                </vue-single-select>
                                <has-error :form="form" field="icon_id"></has-error>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">

                                <label>{{ $t('back_end.table.write_proposal_title') }} <span>*</span></label>
                                <input type="text" v-model="form.title" class="form-control" :class="{ 'is-invalid': form.errors.has('title') }">
                                <has-error :form="form" field="title"></has-error>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">

                                <label>{{ $t('back_end.table.write_proposal') }} <span>*</span></label>
                                <textarea v-model="form.sug_desc" class="form-control" :class="{ 'is-invalid': form.errors.has('sug_desc') }"></textarea>
                                <has-error :form="form" field="sug_desc"></has-error>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">

                                <label>{{ $t('back_end.table.external_url') }}:</label>
                                <input type="text" v-model="form.external_url" class="form-control" :class="{ 'is-invalid': form.errors.has('external_url') }">
                                <has-error :form="form" field="external_url"></has-error>

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
              icons: [],
              // Create a new form instance
              form: new Form({
                icon_id:'',
                title: '',
                sug_desc: '',
                external_url: '',
                active: 1,
              })
            }
        },

        methods: {

            createSuggestion(){
                this.$Progress.start();
                this.form.post(window.location.origin+'/api/suggestions')
                .then(()=>{

                  toast.fire({
                    type: 'success',
                    title: 'Profit proposal created'
                  })

                  this.$router.push('/result')

                }).catch(()=>{
                  //
                })

                this.$Progress.finish();
                
            },

            loadQuestions(){
               axios.get("/api/suggestion-create").then(({ data }) => (this.icons = data));
            },
            
        },

        mounted() {
           this.loadQuestions();
        }
    }
    
</script>
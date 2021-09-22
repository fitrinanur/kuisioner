<template>

    <div class="row">
        <div class="col-md-6 justify-content-center m-auto">
            <div class="card shadow">
                <div class="card-header border-0 tag-title d-flex justify-content-between">

                    <h3 class="mb-0">{{ $t('back_end.table.add_upcoming_event') }}</h3>
                    <router-link to="/event">
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

                                    <label>{{ $t('back_end.table.title') }} <span>*</span></label>
                                    <input v-model="form.title" type="text" name="title" class="form-control" :class="{ 'is-invalid': form.errors.has('title') }">
                                    <has-error :form="form" field="title"></has-error>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">

                                    <label>{{ $t('back_end.table.description') }} <span>*</span></label>

                                    <textarea v-model="form.description" name="description" class="form-control" :class="{ 'is-invalid': form.errors.has('description') }"></textarea>
                                    <has-error :form="form" field="description"></has-error>

                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">

                                    <label>{{ $t('back_end.table.link') }}:</label>
                                    <input v-model="form.link" type="text" name="link" class="form-control" :class="{ 'is-invalid': form.errors.has('link') }" placeholder="Use http or https">
                                    <has-error :form="form" field="link"></has-error>

                                </div>
                            </div>
                            <div class="col-md-12">

                                <div class="form-group">

                                    <label>{{ $t('back_end.table.status') }}:</label>
                                    <select name="status" v-model="form.status" class="form-control" :class="{'is-invalid': form.errors.has('status')}">
                                        <option value="1" selected="selected">{{ $t('back_end.table.active') }}</option>
                                        <option value="2">{{ $t('back_end.table.deactive') }}</option>
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group mb-4">
                                        <button type="submit" class="btn btn-primary btn-block"> {{ $t('back_end.table.Add') }} </button>
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
                description: '',
                link: '',
                status: 1,
              })
            }
        },

        methods: {

            createQuestion(){
                this.$Progress.start();
                this.form.post(window.location.origin+'/api/event')
                .then(()=>{

                  toast.fire({
                    type: 'success',
                    title: 'The entry has been added.'
                  })

                  this.$router.push('/event')

                }).catch(()=>{
                  // shoe message if data not saved
                })

                this.$Progress.finish();
                
            },
            
        }

    }
    
</script>
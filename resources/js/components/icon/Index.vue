<template>

  <div class="row">
      <div class="col">
          <div class="card shadow">
              <div class="card-header border-0 tag-title d-flex justify-content-between align-items-center">

                  <h3 class="mb-0">{{ $t('back_end.table.all_icon') }}</h3>
                  <router-link to="/icon/create">
                      <button class="btn btn-icon btn-3 btn-info" type="button">
                          <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
                          <span class="btn-inner--text">{{ $t('back_end.table.create_new') }}</span>
                      </button>
                  </router-link>

              </div>
              <div class="table-responsive" v-if="icons.data && icons.data.length>0">
                  <table class="table align-items-center table-flush">
                      <thead class="thead-light">
                          <tr>
                              <th scope="col">{{ $t('back_end.table.sl') }}</th>
                              <th scope="col">{{ $t('back_end.table.title') }}</th>
                              <th scope="col">{{ $t('back_end.table.icon') }}</th>
                              <th scope="col">{{ $t('back_end.table.created_at') }}</th>
                              <th scope="col"></th>
                          </tr>
                      </thead>
                      <tbody>

                          <tr v-for="(icon, index) in icons.data" :key="icon.id">

                              <td>
                                  {{ index+1 }}
                              </td>

                              <td>
                                  <span class="mb-0 text-sm">{{ icon.title | capitalize }}</span>
                              </td>

                              <td scope="row">
                                  <div class="media align-items-center iconImg">
                                      <img v-if="icon.photo" v-bind:src="getAvatar(icon.photo)">
                                  </div>
                              </td>

                              <td>
                                  <span class="badge">{{ icon.created_at | dateFormat }}</span>
                              </td>

                              <td class="text-right">
                                  <div class="dropdown">
                                      <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          <i class="fas fa-ellipsis-v"></i>
                                      </a>
                                      <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow data-operation" x-placement="bottom-end">
                                          <router-link :to="`/icon/edit/${icon.id}`" class="dropdown-item">
                                              {{ $t('back_end.table.edit') }}
                                          </router-link>
                                          <a class="dropdown-item" href="#" @click="deleteQuestion(icon.id)">{{ $t('back_end.table.delete') }}</a>

                                      </div>
                                  </div>
                              </td>
                          </tr>

                      </tbody>

                  </table>
              </div>
              <div v-else>
                  <h2 class="text-center pb-5">{{ $t('back_end.table.no_icon') }}</h2>
              </div>
              <div class="card-footer py-4">
                  <pagination :data="icons" @pagination-change-page="getResults"></pagination>
              </div>
          </div>
      </div>
  </div>

</template>


<script>


    export default {
        data() {
            return {
                icons : {}
            }
        },

        methods: {

            // Our method to GET results from a Laravel endpoint
            getResults(page = 1) {
              axios.get('api/icon?page=' + page)
                .then(response => {
                  this.icons = response.data;
                });
            },

            getAvatar(avatar){
              return "/public-assets/images/icon/"+avatar;
            },

            deleteQuestion(id){
                
               
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You will not be able to return to this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ja, radera det!'
                    }).then((result) => {
                        // Send request to the server
                         if (result.value) {
                                axios.delete('api/icon/'+id).then(()=>{
                                        Swal.fire(
                                        'deleted!',
                                        'Your file has been deleted.',
                                        'Success'
                                        )
                                    Fire.$emit('AfterDelete');
                                }).catch(()=> {
                                    Swal.fire("failed! "," There is something wrong.", "warning");
                                });
                         }
                    })
            },


        },

        created() {
           this.getResults();
           Fire.$on('AfterDelete',() => {
               this.getResults();
           });
        }

    }

</script>
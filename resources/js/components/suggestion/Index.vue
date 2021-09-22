<template>

  <div class="row">
      <div class="col">
          <div class="card shadow">
              <div class="card-header border-0 tag-title d-flex justify-content-between align-items-center">
                  <h3 class="mb-0">{{ $t('back_end.table.all_result') }}</h3>
                  <router-link to="/result/create">
                      <button class="btn btn-icon btn-3 btn-info" type="button">
                          <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
                          <span class="btn-inner--text">{{ $t('back_end.table.create_new') }}</span>
                      </button>
                  </router-link>
              </div>
              <div class="table-responsive" v-if="suggestions.data && suggestions.data.length">
                  <table class="table align-items-center table-flush">
                      <thead class="thead-light">
                          <tr>
                              <th scope="col">{{ $t('back_end.table.icon') }}</th>
                              <th scope="col">{{ $t('back_end.table.proposal_title') }}</th>
                              <th scope="col">{{ $t('back_end.table.url') }}</th>
                              <th scope="col">{{ $t('back_end.table.status') }}</th>
                              <th scope="col">{{ $t('back_end.table.created_at') }}</th>
                              <th scope="col"></th>
                          </tr>
                      </thead>
                      <tbody>

                          <tr v-for="(suggestion, index) in suggestions.data" :key="index">
                              <th scope="row">
                                  <div class="media align-items-center">
                                      <a href="#" class="avatar rounded-circle mr-3">
                                          <img v-if="suggestion.icon.photo" v-bind:src="getAvatar(suggestion.icon.photo)">
                                      </a>
                                      <div class="media-body">
                                          <span class="mb-0 text-sm">{{ suggestion.icon.title | capitalize }}</span>
                                      </div>
                                  </div>
                              </th>

                              <th scope="row">
                                  <div class="media align-items-center">
                                      <div class="media-body">
                                          <span class="mb-0 text-sm">{{ suggestion.title | capitalize }}</span>
                                      </div>
                                  </div>
                              </th>

                              <td>
                                  <a href="{suggestion.external_url}" target="_blank" v-if="suggestion.external_url">{{ suggestion.external_url }}</a>
                                  <a href="#" target="_blank" v-else>{{ $t('back_end.table.no_map_link') }}</a>
                              </td>

                              <td>
                                  <span class="badge badge-success" v-if="suggestion.active==1">{{ $t('back_end.table.active') }}</span>
                                  <span class="badge badge-danger" v-else>{{ $t('back_end.table.inactive') }}</span>
                              </td>

                              <td>
                                  <span class="badge">{{ suggestion.created_at | dateFormat }}</span>
                              </td>

                              <td class="text-right">
                                  <div class="dropdown">
                                      <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          <i class="fas fa-ellipsis-v"></i>
                                      </a>
                                      <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow data-operation" x-placement="bottom-end">

                                          <router-link :to="`/result/edit/${suggestion.id}`" class="dropdown-item">
                                              {{ $t('back_end.table.edit') }}
                                          </router-link>
                                          <a class="dropdown-item" href="#" @click="deleteQuestion(suggestion.id)">{{ $t('back_end.table.delete') }}</a>

                                      </div>
                                  </div>
                              </td>
                          </tr>

                      </tbody>
                  </table>

              </div>
              <div v-else>
                  <h2 class="text-center mb-5">No result data added yet.</h2>
              </div>
              <div class="card-footer py-4">
                  <pagination :data="suggestions" @pagination-change-page="getResults"></pagination>
              </div>
          </div>
      </div>
  </div>

</template>


<script>


    export default {
        data() {
            return {
                suggestions : {}
            }
        },

        methods: {

            // Our method to GET results from a Laravel endpoint
            getResults(page = 1) {
              axios.get('api/suggestions?page=' + page)
                .then(response => {
                  this.suggestions = response.data;
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
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        // Send request to the server
                         if (result.value) {
                                axios.delete('api/suggestions/'+id).then(()=>{
                                        Swal.fire(
                                        'Deleted!',
                                        'Your file has been deleted.',
                                        'success'
                                        )
                                    Fire.$emit('AfterDelete');
                                }).catch(()=> {
                                    Swal.fire("Failed!", "There was something wrong.", "warning");
                                });
                         }
                    })
            }

        },

        created() {
           this.getResults();
           Fire.$on('AfterDelete',() => {
               this.getResults();
           });
        }

    }

</script>

<template>

  <div class="row">
      <div class="col">
          <div class="card shadow">
              <div class="card-header border-0 tag-title d-flex justify-content-between align-items-center">
                  <h3 class="mb-0">{{ $t('back_end.table.result_map') }}</h3>
                  <router-link to="/create-option-suggestion">
                      <button class="btn btn-icon btn-3 btn-info" type="button">
                          <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
                          <span class="btn-inner--text">{{ $t('back_end.table.add_new') }}</span>
                      </button>
                  </router-link>
              </div>
              <div class="table-responsive" v-if="suggestions.data && suggestions.data.length>0">
                  <table class="table align-items-center table-flush">
                      <thead class="thead-light">
                          <tr>
                              <th scope="col">{{ $t('back_end.table.sl') }}</th>
                              <th scope="col">{{ $t('back_end.table.icon_title') }}</th>
                              <th scope="col">{{ $t('back_end.table.created_at') }}</th>
                              <th scope="col"></th>
                          </tr>
                      </thead>
                      <tbody>

                          <tr v-for="(suggestion, index) in suggestions.data" :key="suggestion.id">

                              <td>
                                  {{ index+1 }}
                              </td>

                              <td>
                                  {{ suggestion.icon.title }} <img class="IconImg" v-if="suggestion.icon.photo" v-bind:src="getAvatar(suggestion.icon.photo)">
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
                                          <router-link :to="`/edit-option-suggestion/${suggestion.id}`" class="dropdown-item">
                                              {{ $t('back_end.table.edit') }}
                                          </router-link>
                                          <a class="dropdown-item" href="#" @click="deleteData(suggestion.id)">{{ $t('back_end.table.delete') }}</a>

                                      </div>
                                  </div>
                              </td>
                          </tr>

                      </tbody>
                  </table>
              </div>
              <div v-else>
                  <h2 class="text-center pb-4">{{ $t('back_end.table.no_data_added') }}</h2>
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

            getAvatar(avatar){
              return "/public-assets/images/icon/"+avatar;
            },

            deleteData(id){
                
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        // Send request to the server
                         if (result.value) {
                                axios.delete('api/option-suggestion/'+id).then(()=>{
                                        Swal.fire(
                                        'Deleted!',
                                        'Your data has been deleted.',
                                        'success'
                                        )
                                    Fire.$emit('AfterDelete');
                                }).catch(()=> {
                                    Swal.fire("Failed!", "There was something wronge.", "warning");
                                });
                         }
                    })
            },

            loadSuggestions(){
                axios.get("api/option-suggestion").then(({ data }) => (this.suggestions = data));
            },

        },

        created() {
           this.loadSuggestions();
           Fire.$on('AfterDelete',() => {
               this.loadSuggestions();
           });
        }

    }

</script>
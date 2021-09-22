<template>

  <div class="row">
      <div class="col">
          <div class="card shadow">
              <div class="card-header border-0 tag-title d-flex justify-content-between">

                  <h3 class="mb-0">Data User</h3>
                  <router-link to="/user/create">
                      <button class="btn btn-icon btn-3 btn-info" type="button">
                          <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
                          <span class="btn-inner--text">Tambah User</span>
                      </button>
                  </router-link>

              </div>

              <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                      <thead class="thead-light">
                          <tr>
                              <th scope="col">{{ $t('back_end.table.profile') }}</th>
                              <th scope="col"> Nama </th>
                              <th scope="col">{{ $t('back_end.table.email') }}</th>
                              <th scope="col">{{ $t('back_end.table.type') }}</th>
                              <th scope="col">{{ $t('back_end.table.created_at') }}</th>
                              <th scope="col"></th>
                          </tr>
                      </thead>
                      <tbody>
                          <tr v-for="(user, index) in users.data" :key="index">
                              <th scope="row">
                                  <div class="media align-items-center">
                                      <a href="#" class="avatar rounded-circle mr-3">
                                          <img v-if="user.photo" v-bind:src="getAvatar(user.photo)">
                                          <img v-else src="/admin-assets/img/profile/profile.png">
                                      </a>
                                  </div>
                              </th>
                              <td class="font-w600">
                                  <a href="#">{{ user.name | capitalize }}</a>
                              </td>
                              <td><em class="text-muted">{{ user.email }}</em></td>
                              <td>
                                  <span class="badge badge-success" v-if="user.type=='admin'">{{ user.type }}</span>
                                  <span class="badge badge-warning" v-else>{{ user.type }}</span>
                              </td>
                              <td>
                                  <span class="badge">{{ user.created_at | dateFormat }}</span>
                              </td>

                              <td>
                                  <div class="dropdown">
                                      <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          <i class="fas fa-ellipsis-v"></i>
                                      </a>
                                      <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow data-operation" x-placement="bottom-end">
                                          <router-link :to="`/user/edit/${user.slug}`" class="dropdown-item">
                                              {{ $t('back_end.table.edit') }}
                                          </router-link>
                                          <a class="dropdown-item" href="#" @click="deleteUser(user.slug)">{{ $t('back_end.table.delete') }}</a>

                                      </div>
                                  </div>
                              </td>
                          </tr>
                      </tbody>
                  </table>
              </div>

              <div class="card-footer py-4">
                  <pagination :data="users" @pagination-change-page="getResults"></pagination>
              </div>
          </div>
      </div>
  </div>

</template>


<script>


    export default {
        data() {
            return {
                users : {}
            }
        },

        methods: {
            getAvatar(avatar){
              return "/admin-assets/img/profile/"+avatar;
            },

            // Our method to GET results from a Laravel endpoint
            getResults(page = 1) {
              axios.get('api/user?page=' + page)
                .then(response => {
                  this.users = response.data;
                });
            },


            deleteUser(slug){     
               
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
                                axios.delete('api/user/'+slug).then(()=>{
                                        Swal.fire(
                                        'Deleted!',
                                        'Your file was deleted.',
                                        'success'
                                        )
                                    Fire.$emit('AfterDelete');
                                }).catch(()=> {
                                    Swal.fire("Failed!", "There was something wrong.", "warning");
                                });
                         }
                    })
            },

            loadUsers(){
                axios.get("api/user").then(({ data }) => (this.users = data));
            },

        },

        created() {
           this.loadUsers();
           Fire.$on('AfterDelete',() => {
               this.loadUsers();
           });
        }

    }
</script>

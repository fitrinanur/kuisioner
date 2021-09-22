<template>

  <div class="row">
      <div class="col">
          <div class="card shadow">

              <div class="card-header border-0 tag-title d-flex justify-content-between align-items-center">
                  <h3 class="mb-0">Semua Opsi Jawaban</h3>
                  <router-link to="/options/create">
                      <button class="btn btn-icon btn-3 btn-info" type="button">
                          <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
                          <span class="btn-inner--text">Tambahkan Data</span>
                      </button>
                  </router-link>
              </div>

              <div class="table-responsive" v-if="options.data && options.data.length>0">
                  <table class="table align-items-center table-flush">
                      <thead class="thead-light">
                          <tr>
                              <th scope="col">{{ $t('back_end.table.sl') }}</th>
                              <th scope="col">Pertanyaan</th>
                              <th scope="col">Opsi Jawaban</th>
                              <th scope="col">{{ $t('back_end.table.status') }}</th>
                              <th scope="col">{{ $t('back_end.table.created_at') }}</th>
                              <th scope="col"></th>
                          </tr>
                      </thead>
                      <tbody>

                          <tr v-for="(option, index) in options.data" :key="option.id">
                              <td>
                                  <span class="mb-0 text-sm">{{ index+1 }}</span>
                              </td>
                              <td>
                                  <span class="mb-0 text-sm">{{ option.question.question | capitalize }}</span>
                              </td>
                              <th scope="row">
                                  <div class="media align-items-center">
                                      <div class="media-body">
                                          <span class="mb-0 text-sm" v-if="option.optionName!=null">{{ option.optionName | capitalize }}</span>
                                          <span class="mb-0 text-sm" v-else>
                                              <img v-bind:src="getAvatar(option.optionImg)" class="optionAvImg" >
                                         </span>
                                      </div>
                                  </div>
                              </th>

                              <td>
                                  <span class="badge badge-success" v-if="option.active==1">{{ $t('back_end.table.active') }}</span>
                                  <span class="badge badge-danger" v-else>{{ $t('back_end.table.inactive') }}</span>
                              </td>
                              <td>
                                  <span class="badge">{{ option.created_at | dateFormat }}</span>
                              </td>

                              <td class="text-right">
                                  <div class="dropdown">
                                      <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          <i class="fas fa-ellipsis-v"></i>
                                      </a>
                                      <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow data-operation" x-placement="bottom-end" >
                                          <router-link :to="`/option/edit/${option.id}`" class="dropdown-item">
                                              {{ $t('back_end.table.edit') }}
                                          </router-link>
                                          <a class="dropdown-item" href="#" @click="deleteOption(option.id)">{{ $t('back_end.table.delete') }}</a>

                                      </div>
                                  </div>
                              </td>
                          </tr>

                      </tbody>
                  </table>
              </div>
              <div v-else>
                  <h2 class="text-center pb-5">No options added yet.</h2>
              </div>
              <div class="card-footer py-4">
                  <pagination :data="options" @pagination-change-page="getResults"></pagination>
              </div>

          </div>
      </div>
  </div>

</template>


<script>


    export default {
        data() {
            return {
                options : {}
            }
        },

        methods: {

            // Our method to GET results from a Laravel endpoint
            getResults(page = 1) {
              axios.get('api/options?page=' + page)
                .then(response => {
                  this.options = response.data;
                });
            },

            getAvatar(avatar){
              return "/public-assets/images/option/"+avatar;
            },

            deleteOption(id){
                
               
                Swal.fire({
                    title: 'Anda Yakin?',
                    text: "Data yang sudah dihapus tidak bisa dikembalikan!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Ya, Hapus!'
                    }).then((result) => {
                        // Send request to the server
                         if (result.value) {
                                axios.delete('api/options/'+id).then(()=>{
                                        Swal.fire(
                                        'Terhapus!',
                                        'Data Opsi Jawaban Berhasil Dihapus.',
                                        'success'
                                        )
                                    Fire.$emit('AfterDelete');
                                }).catch(()=> {
                                  Swal.fire("Gagal!", "Proses Menghapus Gagal!.", "warning");
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
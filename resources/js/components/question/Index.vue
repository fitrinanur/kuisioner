<template>

  <div class="row">
      <div class="col">
          <div class="card shadow">
              <div class="card-header border-0 tag-title d-flex justify-content-between align-items-center">

                  <h3 class="mb-0">Data Pertanyaan</h3>
                  <router-link to="/question/create">
                      <button class="btn btn-icon btn-3 btn-info" type="button">
                          <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
                          <span class="btn-inner--text">Tambah Data</span>
                      </button>
                  </router-link>

              </div>
              <div class="table-responsive" v-if="questions.data && questions.data.length>0">
                  <table class="table align-items-center table-flush">
                      <thead class="thead-light">
                          <tr>
                              <th scope="col">Pertanyaan</th>
                              <th scope="col">{{ $t('back_end.table.status') }}</th>
                              <th scope="col">Tanggal Dibuat</th>
                              <th scope="col"></th>
                          </tr>
                      </thead>
                      <tbody>

                          <tr v-for="(question, index) in questions.data" :key="index">
                              <th scope="row">
                                  <div class="media align-items-center">
                                      <a href="#" class="avatar rounded-circle mr-3">
                                          <img v-if="question.photo" v-bind:src="getAvatar(question.photo)">
                                      </a>
                                      <div class="media-body">
                                          <span class="mb-0 text-sm">{{ question.question | capitalize }}</span>
                                      </div>
                                  </div>
                              </th>

                              <td>
                                  {{ $t('back_end.table.active') }}
                              </td>

                              <td>
                                  <span class="badge">{{ question.created_at | dateFormat }}</span>
                              </td>

                              <td class="text-right">
                                  <div class="dropdown">
                                      <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          <i class="fas fa-ellipsis-v"></i>
                                      </a>
                                      <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow data-operation" x-placement="bottom-end">
                                          <router-link :to="`/question/edit/${question.id}`" class="dropdown-item">
                                              {{ $t('back_end.table.edit') }}
                                          </router-link>
                                          <a class="dropdown-item" href="#" @click="deleteQuestion(question.id)">{{ $t('back_end.table.delete') }}</a>
                                      </div>
                                  </div>
                              </td>
                          </tr>

                      </tbody>
                  </table>
              </div>
              <div v-else>
                  <h2 class="text-center pb-5">Data Pertanyaan Kosong.</h2>
              </div>
          </div>
      </div>
  </div>
  
</template>


<script>


    export default {
        data() {
            return {
                questions : {}
            }
        },

        methods: {
            getAvatar(avatar){
              return "/public-assets/images/question/"+avatar;
            },

            deleteQuestion(id){
                
               
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
                                axios.delete('api/questions/'+id).then(()=>{
                                        Swal.fire(
                                        'Terhapus!',
                                        'Data Pertanyaan Berhasil Dihapus.',
                                        'success'
                                        )
                                    Fire.$emit('AfterDelete');
                                }).catch(()=> {
                                    Swal.fire("Gagal!", "Proses Menghapus Gagal!.", "warning");
                                });
                         }
                    })
            },

            loadQuestions(){
                axios.get("api/questions").then(({ data }) => (this.questions = data));
            },

        },

        created() {
           this.loadQuestions();
           Fire.$on('AfterDelete',() => {
               this.loadQuestions();
           });
        }

    }

</script>
<template>

    <div class="row">
        <div class="col">
            <div class="card shadow">
                
                <div class="card-header border-0 tag-title d-flex" >
                    <a class="btn btn-icon btn-3 btn-success" href="subscriber/pre/exports" style="margin: 0px !important"><span class="btn-inner--icon">
                            <i class="fa fa-file-excel"></i></span> Export (Pre Test)
                    </a>
                     <a class="btn btn-icon btn-3 btn-success" href="subscriber/post/exports"><span class="btn-inner--icon">
                            <i class="fa fa-file-excel"></i></span> Export (Post Test)
                    </a>
                </div>
               
                <div class="table-responsive" v-if="subscribers.data && subscribers.data.length">
                     <h3 class="mb-0" style="margin: 20px;">Semua Responden</h3>
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">{{ $t('back_end.table.sl') }}</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Umur</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Pendidikan</th>
                                <th scope="col">Pekerjaan</th>
                                <th scope="col">No.HP</th>
                                <th scope="col">Riwayat Penyakit</th>
                                <th scope="col">Tanggal Dibuat</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr v-for="(data, index) in subscribers.data" :key="data.id">
                                <th scope="row">
                                    <span class="mb-0 text-sm">{{ index+1 }}</span>
                                </th>
                                <td>
                                    {{ data.name }}
                                </td>
                                <td>
                                    {{ data.age }}
                                </td>
                                <td>
                                    {{ data.gender }}
                                </td>
                                <td>
                                    {{ data.education }}
                                </td>
                                <td>
                                    {{ data.profession }}
                                </td>
                                <td>
                                    {{ data.telephoneNumber }}
                                </td>
                                <td>
                                    {{ data.diseaseHistory }}
                                </td>
                                <td>
                                    <span class="badge">{{ data.created_at | dateFormat }}</span>
                                </td>

                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow data-operation"
                                            x-placement="bottom-end">
                                            <a class="dropdown-item" href="#"
                                                @click="deleteData(data.id)">{{ $t('back_end.table.delete') }}</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                <div v-else>
                    <h2 class="text-center mb-5">No subscriber found.</h2>
                </div>
                <div class="card-footer py-4">
                    <pagination :data="subscribers" @pagination-change-page="getResults"></pagination>
                </div>
            </div>
        </div>
    </div>

</template>


<script>
    export default {
        data() {
            return {
                subscribers: {}
            }
        },

        methods: {

            deleteData(id) {

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
                        axios.delete('api/subscriber/' + id).then(() => {
                            Swal.fire(
                                'deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                            Fire.$emit('AfterDelete');
                        }).catch(() => {
                            Swal.fire("failed!", "There was something wrong.", "warning");
                        });
                    }
                })
            },

            // Our method to GET results from a Laravel endpoint
            getResults(page = 1) {
                axios.get('api/subscriber?page=' + page)
                    .then(response => {
                        this.subscribers = response.data;
                    });
            },
            doExport(){
                 axios.get('api/subscriber/exports')
                    .then(()=>{
                        toast({
                            type: 'success',
                            title: 'Export the Data'
                        })
                    })
                    .catch(()=> {
                        toast({
                                type: 'warning',
                                title: 'Can not Export'
                                })
                    });
            }
        },

        created() {
            this.getResults();
            Fire.$on('AfterDelete', () => {
                this.getResults();
            });
        }

    }

</script>

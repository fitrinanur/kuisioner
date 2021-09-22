<template>

    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0 tag-title d-flex justify-content-between align-items-center">

                    <h3 class="mb-0">{{ $t('back_end.table.all_event') }}</h3>
                    <router-link to="/event/create" v-if="posts.data && posts.data.length==0">
                        <button class="btn btn-icon btn-3 btn-info" type="button">
                            <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
                            <span class="btn-inner--text">{{ $t('back_end.table.create_new') }}</span>
                        </button>
                    </router-link>

                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">{{ $t('back_end.table.sl') }}</th>
                                <th scope="col">{{ $t('back_end.table.title') }}</th>
                                <th scope="col">{{ $t('back_end.table.description') }}</th>
                                <th scope="col">{{ $t('back_end.table.link') }}</th>
                                <th scope="col">{{ $t('back_end.table.status') }}</th>
                                <th scope="col">{{ $t('back_end.table.created_at') }}</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr v-for="(post, index) in posts.data" :key="post.id">
                                <th scope="row">
                                    <span class="mb-0 text-sm">{{ index+1 }}</span>
                                </th>
                                <td>
                                    {{ post.title }}
                                </td>
                                <td>
                                    <em class="text-muted">{{ post.description | truncate(50, '...') }}</em>
                                </td>
                                <td>
                                    <a v-bind:href="post.link" class="text-muted" target="__blank">{{ post.link | truncate(50, '...') }}</a>
                                </td>
                                <td>
                                    <span class="mb-0 text-sm text-success" v-if="post.status">Active</span>
                                    <span class="mb-0 text-sm text-danger" v-else>Deactive</span>
                                </td>

                                <td>
                                    <span class="badge">{{ post.created_at | dateFormat }}</span>
                                </td>

                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow data-operation" x-placement="bottom-end" >
                                            <router-link :to="`/event/edit/${post.id}`" class="dropdown-item">
                                                {{ $t('back_end.table.edit') }}
                                            </router-link>
                                            <a class="dropdown-item" href="#" @click="deleteQuestion(post.id)">{{ $t('back_end.table.delete') }}</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</template>


<script>


    export default {
        data() {
            return {
                posts : {}
            }
        },

        methods: {
            getAvatar(avatar){
              return "/public-assets/images/question/"+avatar;
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
                                axios.delete('api/event/'+id).then(()=>{
                                        Swal.fire(
                                        'deleted!',
                                        'Your file has been deleted.',
                                        'success'
                                        )
                                    Fire.$emit('AfterDelete');
                                }).catch(()=> {
                                    Swal.fire("failed!", "There was something wrong.", "warning");
                                });
                         }
                    })
            },

            loadPost(){
                axios.get("api/event").then(({ data }) => (this.posts = data));
            },

        },

        created() {
           this.loadPost();
           Fire.$on('AfterDelete',() => {
               this.loadPost();
           });
        }

    }

</script>
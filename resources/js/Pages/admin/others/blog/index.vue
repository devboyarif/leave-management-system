<template>
    <Head :title="__('Post List')" />

    <div class="row justify-content-center">
            <div class="col-12">
                <div class="card mt-3">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                             <span>{{ __('Post List') }}</span>
                            <Link :href="route('posts.create')" class="btn btn-primary">
                                <i class="fa-solid fa-plus"></i>
                                {{ __('Create') }}
                            </Link>
                        </div>
                    </div>
                     <div class="card-body table-responsive p-0">
                        <table class="table table-valign-middle">
                            <thead>
                               <tr>
                                    <th width="10%">{{ __('Thumbnail') }}</th>
                                    <th width="40%">{{ __('Title') }}</th>
                                    <th width="50%">{{ __('Short Description') }}</th>
                                    <th width="150px">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-if="posts && posts.data.length">
                                    <tr v-for="(post,index) in posts.data" :key="index">
                                        <td><img :src="post.thumbnail" alt="thumbnail" class="rounded post-img"></td>
                                        <td>{{ post.title }}</td>
                                        <td><p>{{ post.short_description }}</p></td>
                                        <td class="d-flex">
                                            <Link :href="route('leaveTypes.edit',post.id)" v-tooltip="__('Edit Leave Type')" class="btn btn-sm  pl-0">
                                                <EditIcon/>
                                            </Link>
                                            <button @click="deleteData(post.id)" v-tooltip="__('Delete Leave Type')" class="btn btn-sm">
                                                <DeleteIcon/>
                                            </button>
                                        </td>
                                    </tr>
                                </template>
                                <tr v-else>
                                    <td colspan="5" class="text-center">
                                        <h6>{{ __('No Data Found') }}</h6>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- Pagination  -->
                        <Pagination :links="posts.links" />
                    </div>
                </div>
            </div>
    </div>
</template>

<script>
export default {
    props: {
        posts: {
            type: Array,
            required: true,
        },
    },
};
</script>

<style scoped>
.post-img {
    width: 60px;
    height: 60px;
    object-fit: cover;
}
</style>

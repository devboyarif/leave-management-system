<template>
    <Head :title="user.name" />

    <div class="row gutters-sm p-4">
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img :src="user.avatar" alt="Admin" class="rounded-circle"
                            width="150">
                        <div class="mt-3">
                            <h4>{{ user.name }}</h4>
                            <p class="text-secondary mb-1 text-uppercase" v-tooltip="__('Role')">
                                <span class="badge badge-primary">{{ user.role }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">{{ __('Name') }}</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ user.name }}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">{{ __('Email') }}</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ user.email }}
                        </div>
                    </div>
                     <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">{{ __('Joining Date') }}</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ timeFromNow(user.created_at) }}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">{{ __('Last Profile Update') }}</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ timeFromNow(user.updated_at) }}
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-sm-12">
                            <Link :href="route('admins.edit',user.id)" v-tooltip="'Edit'" class="btn pl-0">
                                <EditIcon/>
                            </Link>
                            <button @click="deleteData(user.id)" v-tooltip="'Delete'" class="btn" v-if="user.id != auth_user.id">
                                <DeleteIcon/>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    export default {
        props: {
            user: Object
        },
        data(){
            return {
                auth_user: this.$page.props.authenticatedUser
            }
        },
        methods: {
            deleteData(id) {
                this.$swal({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!",
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.$inertia.delete(route("admins.destroy", id));
                    }
                });
            },
        }
    };
</script>

<style scoped>
    .gutters-sm {
        margin-right: -8px;
        margin-left: -8px;
    }

    .gutters-sm>.col,
    .gutters-sm>[class*=col-] {
        padding-right: 8px;
        padding-left: 8px;
    }

    .mb-3,
    .my-3 {
        margin-bottom: 1rem !important;
    }

    .bg-gray-300 {
        background-color: #e2e8f0;
    }

    .h-100 {
        height: 100% !important;
    }

    .shadow-none {
        box-shadow: none !important;
    }
</style>

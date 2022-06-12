<template>

    <Head title="Company List" />

    <div class="row justify-content-center mt-4">
        <div class="col-12">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a href="javascript:void(0)" @click="changeTab('home')" class="nav-link" :class="{'active': currentTab == 'home'}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:void(0)" @click="changeTab('profile')" class="nav-link" :class="{'active': currentTab == 'profile'}">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:void(0)" @click="changeTab('contact')" class="nav-link" :class="{'active': currentTab == 'contact'}">Contact</a>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade" :class="{'show active': currentTab == 'home'}">
                        Home
                    </div>
                    <div class="tab-pane fade" :class="{'show active': currentTab == 'profile'}">
                        Profile
                    </div>
                    <div class="tab-pane fade" :class="{'show active': currentTab == 'contact'}">
                        Contact
                    </div>
                </div>
            <!-- <div class="card">
                <div class="card-header">
                </div>
                <div class="card-body">
                </div>
            </div> -->




            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 semi-gutters">
                <div class="col mb-4" data-group-id="90467" style="">
                    <div class="card dt-card dt-card--colleague h-100 ">
                        <img src="https://desktime.com/shared/users/05/36/430536/1649496622.jpg" class="card-image-top">

                        <div class="card-body">
                            <h6 class="card-title">Abir</h6>
                            <p> Backend </p>
                            <p>
                                abiruzzaman.molla@gmail.com<br>


                            </p>
                        </div>
                    </div>
                </div>
                <div class="col mb-4" data-group-id="90467" style="">
                    <div class="card dt-card dt-card--colleague h-100 ">
                        <img src="https://desktime.com/shared/users/28/05/372805/1634354438.jpg" class="card-image-top">

                        <div class="card-body">
                            <h6 class="card-title">Arif</h6>
                            <p> Backend </p>
                            <p>
                                devboyarif@gmail.com<br>

                                01681729831<br>

                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- <div class="card mt-3">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <Link :href="route('employees.create')" class="btn btn-primary">
                        <i class="fa-solid fa-plus"></i>
                        Create
                        </Link>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-valign-middle">
                            <thead>
                               <tr>
                                    <th>Employee</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-if="employees && employees.data.length">
                                    <tr v-for="(user,index) in employees.data" :key="index">
                                        <td>
                                            <img :src="user.avatar" alt="Product 1"
                                                class="img-circle img-size-32 mr-2">
                                            {{ user.name }}
                                        </td>
                                        <td>{{ user.email }}</td>
                                        <td class="d-flex">
                                            <Link :href="route('employees.edit',user.id)" v-tooltip="'Edit Employee'" class="btn btn-sm  pl-0">
                                                <EditIcon/>
                                            </Link>
                                            <button @click="deleteData(user.id)" v-tooltip="'Delete Employee'" class="btn btn-sm">
                                                <DeleteIcon/>
                                            </button>
                                        </td>
                                    </tr>
                                </template>
                                <tr v-else>
                                    <td colspan="5" class="text-center">
                                        <h3>No User Found</h3>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <Pagination :links="employees.links" />
                </div>
            </div> -->
        </div>
    </div>
</template>


<script>
// import Pagination from "../../Shared/Pagination.vue";
// import debounce from "lodash/debounce";
// import { Inertia } from "@inertiajs/inertia";

export default {
    props: {
        employees: Object,
        // filters: Object || Array,
    },
    components: {
        // Pagination,
        // Inertia,
    },
    data() {
        return {
            currentTab: "home",
            // search: this.filters.search,
        };
    },
    methods: {
        changeTab(tab) {
            this.currentTab = tab;
        },
        // deleteData(id) {
        //     if (confirm("Are you sure to delete?")) {
        //         Inertia.delete(route("employees.destroy", id));
        //     }
        // },
    },
};
</script>

<style scoped>
    .avatar-img {
        height: 60px;
        width: 60px;
        object-fit: cover;
    }
</style>

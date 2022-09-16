<template>
<Head :title="__('Employee List')"/>

<div class="row justify-content-center mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <span>{{ __('Employee List') }}</span>
                    <div v-click-outside="()=> showEmployeeDropdown = false">
                        <div class="btn-group" :class="{'show':showEmployeeDropdown}" role="group">
                            <button type="button" class="btn btn-secondary dropdown-toggle" @click="showEmployeeDropdown = !showEmployeeDropdown">
                                {{ __('Employee Create') }}
                            </button>
                            <div class="dropdown-menu employee-add-dropdown" :class="{'show':showEmployeeDropdown}" x-placement="bottom-start">
                                <a @click="showEmployeeInviteModal = true" class="dropdown-item" href="javascript:void(0)" v-tooltip="'Invite employee via email address'">
                                    <i class="fa-regular fa-paper-plane"></i>
                                    {{ __('Invite Employee') }}
                                </a>
                                <a @click="showEmployeeCreateModal = true" class="dropdown-item" href="#" v-tooltip="'Create employee instant from here'">
                                    <i class="fa-solid fa-plus"></i>
                                    {{ __('Instant Create') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a href="javascript:void(0)" @click="changeTab('all')" class="nav-link" :class="{'active': currentTab == 'all'}">{{ __('All') }}</a>
                        </li>
                        <li class="nav-item" v-for="team in teams" :key="team.id">
                            <a href="javascript:void(0)" @click="changeTab(team.slug)" class="nav-link" :class="{'active': currentTab == team.slug}">{{ team.name }}</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade" :class="{'show active': currentTab == 'all'}">
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 semi-gutters">
                            <template v-if="employees && employees.length">
                                <div class="col mb-4" v-for="employee in employees" :key="employee.id">
                                    <div class="card h-100" v-if="employee.user">
                                        <img :src="employee.user.avatar" class="card-image-top">
                                        <div class="card-body">
                                            <h6 class="card-title">{{ employee.user.name }}</h6> <br>
                                            <p  class="m-0 p-0" v-if="employee.team">{{ employee.team.name }}</p>
                                            <p class="mt-0 p-0">
                                                {{ employee.user.email }}
                                            </p>
                                            <p class="mt-0 p-0">
                                                {{ employee.phone }}
                                            </p>
                                            <Link :href="route('company.employees.show',employee.user_id)" v-tooltip="'Details'" class="btn btn-sm team-member-show">
                                                <EyeIcon/>
                                            </Link>
                                            <button @click="editData(employee)" class="btn btn-sm team-member-edit">
                                                <EditIcon/>
                                            </button>
                                            <button @click="deleteData(employee.user.id)" class="btn btn-sm team-member-delete">
                                                <DeleteIcon/>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </template>
                            <h6 class="text-center m-auto" v-else>{{ __('No Data Found') }}</h6>
                        </div>
                    </div>
                    <div class="tab-pane fade" :class="{'show active': currentTab == team.slug}" v-for="team in teams" :key="team.id">
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 semi-gutters">
                            <template v-if="employees && employees.length">
                                <div class="col mb-4" v-for="employee in employees" :key="employee.id">
                                    <div class="card h-100" v-if="employee.user">
                                        <img :src="employee.user.avatar" class="card-image-top">
                                        <div class="card-body">
                                            <h6 class="card-title">{{ employee.user.name }}</h6> <br>
                                            <p  class="m-0 p-0" v-if="employee.team">{{ employee.team.name }}</p>
                                            <p class="mt-0 p-0">
                                                {{ employee.user.email }}
                                            </p>
                                            <p class="mt-0 p-0">
                                                {{ employee.phone ? employee.phone:'' }}
                                            </p>
                                            <Link :href="route('company.employees.show',employee.user_id)" v-tooltip="'Details'" class="btn btn-sm team-member-show">
                                                <EyeIcon/>
                                            </Link>
                                            <button @click="editData(employee)" class="btn btn-sm team-member-edit">
                                                <EditIcon/>
                                            </button>
                                            <button @click="deleteData(employee.user.id)" class="btn btn-sm team-member-delete">
                                                <DeleteIcon/>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </template>
                            <template v-else>
                                <div class="d-flex justify-content-center text-center m-auto">
                                    <h6>{{ __('No Data Found') }}</h6>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Invite Employee Modal -->
    <InviteEmployeeModal :show="showEmployeeInviteModal" @close="showEmployeeInviteModal = false" :teams="teams"/>

    <!-- Create Employee Modal -->
    <CreateEmployeeModal :show="showEmployeeCreateModal" @close="showEmployeeCreateModal = false" :teams="teams" @created="changeTab(currentTab)"/>

    <!-- Edit Employee Modal -->
    <EditEmployeeModal v-if="showEmployeeEditModal" :show="showEmployeeEditModal" @close="showEmployeeEditModal = false" :teams="teams" :employee="showEmployeeEditModal ? employee:''" @updated="changeTab(currentTab)"/>
</div>

</template>


<script>
import Pagination from "../../Shared/Pagination.vue";
import InviteEmployeeModal from "../../Shared/Company/Modal/InviteEmployeeModal.vue";
import CreateEmployeeModal from "../../Shared/Company/Modal/CreateEmployeeModal.vue";
import EditEmployeeModal from "../../Shared/Company/Modal/EditEmployeeModal.vue";

export default {
    props: {
        teams: Array,
        employees: Array,
    },
    components: {
        Pagination,
        InviteEmployeeModal,
        CreateEmployeeModal,
        EditEmployeeModal,
    },
    data() {
        return {
            currentTab: "all",
            employees: this.employees,
            showEmployeeDropdown: false,
            showEmployeeInviteModal: false,
            showEmployeeCreateModal: false,
            showEmployeeEditModal: false,
            employee: "",
        };
    },
    methods: {
        async changeTab(tab) {
            this.currentTab = tab;
            let response = await axios.get(
                route("company.teams.employees", {
                    team: tab,
                })
            );

            this.employees = response.data.employees;
        },
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
                    this.$inertia.delete(route("company.employees.destroy", id), {
                        onSuccess: () => {
                            this.changeTab(this.currentTab);
                        },
                    });
                }
            });
        },
        editData(employee) {
            this.employee = employee;
            this.showEmployeeEditModal = true;
        },
    },
    mounted() {
        this.checkPagePermission("owner");
    },
};
</script>

<style scoped>
    .avatar-img {
        height: 60px;
        width: 60px;
        object-fit: cover;
    }

    .employee-add-dropdown{
        position: absolute;
        transform: translate3d(0px, 38px, 0px);
        top: 0px;
        left: 0px;
        will-change: transform;
    }

   .team-member-show{
        position: absolute;
        top: 0;
        right: 80px;
    }
   .team-member-edit{
        position: absolute;
        top: 0;
        right: 40px;
    }
    .team-member-delete{
        position: absolute;
        top: 0;
        right: 0;
    }
</style>


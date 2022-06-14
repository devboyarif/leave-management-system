<template>

    <Head title="Company List" />

    <div class="row justify-content-center mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <span>Team List</span>
                        <Link :href="route('company.teams.create')" class="btn btn-primary">
                            <i class="fa-solid fa-plus"></i>
                            Create
                        </Link>
                    </div>
                </div>
            </div>
           <div class="card">
                <div class="card-header">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a href="javascript:void(0)" @click="changeTab('all')" class="nav-link" :class="{'active': currentTab == 'all'}">All</a>
                        </li>
                        <li class="nav-item" v-for="team in teams" :key="team.id">
                            <a href="javascript:void(0)" @click="changeTab(team.slug)" class="nav-link" :class="{'active': currentTab == team.slug}">{{ team.name }}</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade" :class="{'show active': currentTab == 'all'}">
                            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 semi-gutters">
                                <div class="col mb-4" v-for="employee in employees" :key="employee.id">
                                    <div class="card h-100" v-if="employee.user">
                                        <img :src="employee.user.avatar" class="card-image-top">
                                        <div class="card-body">
                                            <h6 class="card-title">{{ employee.user.name }}</h6> <br>
                                            <p  class="m-0 p-0" v-if="employee.team">{{ employee.team.name }}</p>
                                            <p class="mt-0 p-0">
                                                {{ employee.user.email }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" :class="{'show active': currentTab == team.slug}" v-for="team in teams" :key="team.id">
                            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 semi-gutters">
                                <div class="col mb-4" v-for="employee in employees" :key="employee.id">
                                    <div class="card h-100" v-if="employee.user">
                                        <img :src="employee.user.avatar" class="card-image-top">
                                        <div class="card-body">
                                            <h6 class="card-title">{{ employee.user.name }}</h6> <br>
                                            <p  class="m-0 p-0" v-if="employee.team">{{ employee.team.name }}</p>
                                            <p class="mt-0 p-0">
                                                {{ employee.user.email }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
        teams: Array,
        employees: Object,
    },
    data() {
        return {
            currentTab: "all",
            employees: this.employees,
            // search: this.filters.search,
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
            console.log(response.data.employees);
        },
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

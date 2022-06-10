<template>

    <Head title="Team Members" />
    <div class="row justify-content-center pt-5">
        <div class="col-lg-3 col-md-6 mb-4 mb-lg-0" v-for="employee in employeeUsers" :key="employee.id">
            <div class="card shadow-sm border-0 rounded card-size">
                <div class="card-body p-0">
                    <img :src="employee.user.avatar" alt="" class="w-100 card-img-top">
                    <div class="p-4">
                        <h4 class="mb-0">{{ employee.user.name }}</h4>
                        <p class="text-muted">{{ employee.team.name }}</p>
                        <p class="mb-0 pb-0">{{ employee.user.email }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
export default {
    props: {
        employeeUsers: {
            type: Array,
            required: true,
        },
        team: {
            type: Object,
            required: true,
        },
        companyUser: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {};
    },
    methods: {},
};
</script>

<style scoped>
.card-size {
    width: 18rem;
}
</style>

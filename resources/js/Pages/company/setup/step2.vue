<template>
    <Head title="Step 2 (2/5)"/>
    <div class="col-md-10 col-lg-8 mx-md-auto">
        <h3 class="text-center mb-3">{{ __('Create your team members') }}</h3>
        <p class="h5 text-center mb-3">{{ __('To manage and organize employees and leaves, you can divide your employees into teams') }}</p>
    </div>
    <div class="email-login mt-4">
        <template v-if="teams && teams.length">
            <div class="card-body row justify-content-center">
                <div class="col-lg-6 my-1" v-for="team in teams" :key="team.id">
                    <li class="list-group-item d-flex justify-content-between">
                        <h3 class="mt-2">{{ team.name }}</h3>
                        <div>
                            <button @click="deleteData(team.id)" v-tooltip="'Delete Holiday'" class="btn btn-sm mx-0 px-0">
                                <DeleteIcon />
                            </button>
                        </div>
                    </li>
                </div>
            </div>
        </template>
        <form @submit.prevent="saveData">
            <div class="row my-1 justify-content-center" v-for="(name, index) in form.names" :key="index">
                <div class="col-lg-8">
                    <input v-model="form.names[index]" :class="{'border-danger':form.errors.names}" type="text" :placeholder="__('Team Name')" id="company_name" class="d-block">
                    <AuthErrorMessage :name="form.errors.names" />
                </div>
                <div class="col-lg-1" v-if="index == 0">
                    <button type="button" class="cta-btn bg-primary mt-0" @click="addMore">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
                <div class="col-lg-1" v-else>
                    <button type="button" class="cta-btn bg-danger mt-0" @click="removeField(index)">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="row justify-content-center">
                <button :disabled="form.processing" type="submit" class="cta-btn bg-primary btn-sm w-25">
                    <Loading v-if="form.processing" :messageShow="false" />
                    <span v-else>{{ __('Save') }}</span>
                </button>
            </div>
        </form>
       <div class="d-flex justify-content-end mt-5 pt-5">
            <button type="button" class="cta-btn bg-primary w-25 ml-2" @click="changeStep">
                {{ __('Next') }}
            </button>
       </div>
    </div>
</template>


<script>
    export default {
    data() {
        return {
            teams: [],
            limitation: 0,
            form: this.$inertia.form({
                names: [""],
            }),
        };
    },
    methods: {
        async getTeams(){
            let response = await axios.get(route('fetch.company.teams'))
            this.teams = response.data.teams
            this.limitation = response.data.team_limitation
        },
        addMore() {
            this.form.names.push("");
        },
        removeField(index) {
            this.form.names.splice(index, 1);
        },
        saveData(){
            this.form.post(route('company.account.setup.step2'), {
                onSuccess: () => {
                    this.form.reset()
                    this.getTeams()
                }
            })
        },
        deleteData(id){
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
                    this.$inertia.delete(route("delete.company.teams", id), {
                        onSuccess: () => this.getTeams()
                    });
                }
            });
        },
        changeStep(){
            if(this.teams.length <= this.limitation){
                this.$emit('step',3)
            }else{
                return this.toastError(`You can't create more than ${this.limitation} teams`)
            }
        }
    },
    async mounted() {
        await this.getTeams();
    },
};
</script>


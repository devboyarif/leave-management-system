<template>
    <Head title="Step 1 (1/5)"/>
    <div class="col-md-10 col-lg-8 mx-md-auto">
        <h3 class="text-center mb-3">Tell us about your company</h3>
        <p class="h5 text-center mb-3">Please tell us about your company to build your team</p>
    </div>
    <div class="email-login">
        <div class="row">
            <div class="col-lg-6">
                <AuthLabel name="Company Name" />
                <input v-model="form.company_name" :class="{'border-danger':form.errors.company_name}" type="text"
                    :placeholder="__('Company Name')" id="company_name" class="d-block">
                <span v-if="errors.company_name" class="d-block text-danger mt--10 mb-1">{{ form.errors.company_name }}</span>
            </div>
            <div class="col-lg-6">
                <AuthLabel name="Company Email" />
                <input v-model="form.company_email" :class="{'border-danger':form.errors.company_email}" type="text"
                    :placeholder="__('Email')" id="company_email" class="d-block">
                <span v-if="errors.company_email"
                    class="d-block text-danger mt--10 mb-1">{{ form.errors.company_email }}</span>
            </div>
            <div class="col-lg-6">
                <AuthLabel name="Country" />
                <select v-model="form.country" id="company_country" :class="{'border-danger':form.errors.country}">
                    <option value="" class="d-none">{{ __('Select Country') }}</option>
                    <option :value="country.id" v-for="country in countries" :key="country.id">
                        {{ country.name }}
                    </option>
                </select>
                <span v-if="errors.country" class="d-block text-danger mt--10 mb-1">{{ form.errors.country }}</span>
                <div class="icheck-primary">
                    <input @change="checkboxChange" v-model="form.import_official_holidays" type="checkbox"
                        :checked="form.import_official_holidays" id="holiday">
                    <label for="holiday" class="ml-2 text-dark">
                        {{ __('Import official holidays from country ?') }}
                    </label>
                </div>
            </div>

            <div class="col-lg-6">
                <AuthLabel name="Team Size" />
                <select v-model="form.team_size" id="team_size" :class="{'border-danger':form.errors.team_size}">
                    <option value="" class="d-none">{{ __('Select Team Size') }}</option>
                    <option :value="team_size.id" v-for="team_size in team_sizes" :key="team_size.id">
                        {{ team_size.name }}
                    </option>
                </select>
                <span v-if="errors.team_size"
                    class="d-block text-danger mt--10 mb-1">{{ form.errors.team_size }}</span>
            </div>

            <button type="button" class="cta-btn bg-primary w-25 ml-auto" @click="$emit('step', 2)">
                {{ __('Next') }}
            </button>
            <!-- <button :disabled="form.processing" type="submit" class="cta-btn bg-primary w-25 ml-auto">
                <Loading v-if="form.processing" :messageShow="false" />
                <span v-else>{{ __('Next') }}</span>
            </button> -->
        </div>
    </div>
</template>


<script>
    export default {
    data() {
        return {
            form: this.$inertia.form({
                company_name: "",
                company_email: "",
                country: "",
                import_official_holidays: "",
                team_size: "",
            }),
            errors: {},
            countries: [],
            team_sizes: [],
        };
    },
    methods: {
        async getCountries() {
            let response = await axios.get(route("all.countries"));
            this.countries = response.data;
        },
        async getTeamSizes() {
            let response = await axios.get(route("all.team.sizes"));
            console.log(response);
            this.team_sizes = response.data;
        }
    },
    async mounted() {
        await this.getCountries();
        await this.getTeamSizes();
    }
};
</script>


<template>

    <Head title="Company Create" />
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card mt-3">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3>Company Create</h3>
                        <Link :href="route('companies.index')" class="btn btn-primary">
                        <i class="fa-solid fa-arrow-left"></i>
                        Back
                        </Link>
                    </div>
                </div>
                <div class="card-body">
                    <form @submit.prevent="createData">
                        <div class="mb-3 row">
                            <div class="col-lg-6">
                                <Label name="Name"/>
                                <input v-model="form.name" type="text" class="form-control"
                                    :class="{'is-invalid':form.errors.name}" id="name">
                                <ErrorMessage :name="form.errors.name" />
                            </div>
                            <div class="col-lg-6">
                                <Label name="Email address"/>
                                <input v-model="form.email" type="email" class="form-control"
                                    :class="{'is-invalid':form.errors.email}" id="email">
                                <ErrorMessage :name="form.errors.email" />
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <div class="col-lg-6">
                                <Label name="Country"/>
                                <select v-model="form.country" id="country" class="form-control"
                                    :class="{'is-invalid':form.errors.country}">
                                    <option value="">Select Country</option>
                                    <option :value="country.id" v-for="country in countries" :key="country.id">
                                        {{ country.name }}
                                    </option>
                                </select>
                                <ErrorMessage :name="form.errors.country" />
                            </div>
                            <div class="col-lg-6">
                                <Label name="Avatar" :required="false"/>
                                <input accept="image/jpeg, image/jpg/ image/png" class="form-control border-0 p-0"
                                    type="file" @input="form.avatar = $event.target.files[0]"
                                    :class="{'is-invalid':form.errors.avatar}" />
                                <ErrorMessage :name="form.errors.avatar" />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-lg-6">
                                <Label name="Password"/>
                                <input v-model="form.password" type="password" class="form-control"
                                    :class="{'is-invalid':form.errors.password}" id="password">
                                <ErrorMessage :name="form.errors.password" />
                            </div>
                            <div class="col-lg-6">
                                <Label name="Confirm Password"/>
                                <input v-model="form.password_confirmation" type="password" class="form-control"
                                    :class="{'is-invalid':form.errors.password_confirmation}" id="password_confirmation">
                                <ErrorMessage :name="form.errors.password_confirmation" />
                            </div>
                        </div>
                        <button :disabled="form.processing" type="submit" class="btn btn-primary">
                            <i v-if="!form.processing" class="fa-solid fa-check"></i>
                            <Loading v-else/>
                            Save
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        countries: {
            type: Array,
            required: true,
        },
    },
    data() {
        return {
            form: this.$inertia.form({
                name: null,
                email: null,
                country: null,
                password: null,
                password_confirmation: null,
                avatar: null,
            }),
        };
    },
    methods: {
        createData() {
            this.form.post(route("companies.store"));
        },
    },
};
</script>

<template>

    <Head :title="__('Company Edit')" />
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card mt-3">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">{{ __('Company Edit') }}</h3>
                        <Link :href="route('companies.index')" class="btn btn-primary">
                        <i class="fa-solid fa-arrow-left"></i>
                        {{ __('Back') }}
                        </Link>
                    </div>
                </div>
                <div class="card-body row justify-content-center">
                    <div class="col-lg-6">
                        <form @submit.prevent="updateData">
                        <div class="mb-3 row">
                            <div class="col-lg-6">
                                <Label :name="__('Name')" for="name"/>
                                <input v-model="form.name" type="text" class="form-control"
                                    :class="{'is-invalid':form.errors.name}" id="name" :placeholder="__('Name')">
                                <ErrorMessage :name="form.errors.name" />
                            </div>
                            <div class="col-lg-6">
                                <Label :name="__('Email address')"  for="email"/>
                                <input v-model="form.email" type="email" class="form-control"
                                    :class="{'is-invalid':form.errors.email}" id="email" :placeholder="__('Email address')">
                                <ErrorMessage :name="form.errors.email" />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-lg-6">
                                <Label :name="__('Country')" for="country"/>
                                <select v-model="form.country" id="country" class="form-control"
                                    :class="{'is-invalid':form.errors.country}">
                                    <option value="">{{ __('Select Country') }}</option>
                                    <option :value="country.id" v-for="country in countries" :key="country.id">
                                        {{ country.name }}
                                    </option>
                                </select>
                                <ErrorMessage :name="form.errors.country" />
                            </div>
                            <div class="col-lg-6">
                                <Label :name="__('Avatar')" :required="false" />
                                <input accept="image/jpeg, image/jpg/ image/png" class="form-control border-0 p-0"
                                    type="file" @input="form.avatar = $event.target.files[0]"
                                    :class="{'is-invalid':form.errors.avatar}" />
                                <ErrorMessage :name="form.errors.avatar" />
                            </div>
                        </div>
                         <div class="mb-3 row">
                            <div class="col-lg-6">
                                <Label :name="__('Change Password')" for="password_confirmation"/>
                                <input v-model="form.password" type="password" class="form-control"
                                    :class="{'is-invalid':form.errors.password}" id="password_confirmation" :placeholder="__('Change Password')">
                                <ErrorMessage :name="form.errors.password" />
                            </div>
                        </div>
                        <button :disabled="form.processing" type="submit" class="btn btn-primary">
                            <Loading v-if="form.processing"/>
                            <span v-else>
                                <i class="fa-solid fa-check mr-1"></i>
                                {{ __('Save') }}
                            </span>
                        </button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        user: {
            type: Object,
            required: true,
        },
        country_id: {
            type: Number,
            required: true,
        },
        countries: {
            type: Array,
            required: true,
        },
    },
    data() {
        return {
            form: this.$inertia.form({
                name: this.user.name,
                email: this.user.email,
                country: this.country_id || '',
                password: null,
                avatar: null,
                _method: "PUT",
            }),
        };
    },
    methods: {
        updateData() {
            this.form.post(route("companies.update", this.user.id));
        },
    },
     mounted(){
        this.checkPagePermission('admin')
    }
};
</script>

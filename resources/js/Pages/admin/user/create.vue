<template>
    <Head :title="__('Admin Create')"/>
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card mt-3">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">{{ __('Admin Create') }}</h3>
                        <Link :href="route('admins.index')" class="btn btn-primary">
                        <i class="fa-solid fa-arrow-left"></i>
                        {{ __('Back') }}
                        </Link>
                    </div>
                </div>
                <div class="card-body row justify-content-center">
                   <div class="col-lg-6">
                     <form @submit.prevent="createData">
                        <div class="mb-3">
                            <Label :name="__('Name')" for="name"/>
                            <input v-model="form.name" type="text" class="form-control" :class="{'is-invalid':form.errors.name}" id="name" :placeholder="__('Name')">
                            <ErrorMessage :name="form.errors.name"/>
                        </div>
                        <div class="mb-3">
                            <Label :name="__('Email address')" for="email"/>
                            <input v-model="form.email" type="email" class="form-control" :class="{'is-invalid':form.errors.email}" id="email" :placeholder="__('Email address')">
                            <ErrorMessage :name="form.errors.email"/>
                        </div>
                        <div class="mb-3">
                            <Label :name="__('Password')" for="password"/>
                            <input v-model="form.password" type="password" class="form-control" :class="{'is-invalid':form.errors.password}" id="password" :placeholder="__('Password')">
                            <ErrorMessage :name="form.errors.password"/>
                        </div>
                        <div class="mb-3">
                            <Label :name="__('Avatar')" :required="false"/>
                            <input accept="image/jpeg, image/jpg/ image/png" class="form-control border-0 p-0" type="file" @input="form.avatar = $event.target.files[0]" :class="{'is-invalid':form.errors.avatar}"/>
                            <ErrorMessage :name="form.errors.avatar"/>
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
    data() {
        return {
            form: this.$inertia.form({
                name: null,
                email: null,
                password: null,
                avatar: null,
            }),
        };
    },
    methods: {
        createData() {
            this.form.post(route("admins.store"), {
                onSuccess: () => {
                    this.form.reset();
                },
            });
        },
    },
     mounted(){
        this.checkPagePermission('admin')
    }
};
</script>

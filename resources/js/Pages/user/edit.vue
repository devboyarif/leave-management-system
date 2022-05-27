<template>
    <Head title="User Edit"/>
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card mt-3">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3>User Edit</h3>
                        <Link :href="route('users.index')" class="btn btn-primary">
                        <i class="fa-solid fa-arrow-left"></i>
                        Back
                        </Link>
                    </div>
                </div>
                <div class="card-body">
                    <form @submit.prevent="updateData">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input v-model="form.name" type="text" class="form-control" :class="{'is-invalid':form.errors.name}" id="name">
                            <ErrorMessage :name="form.errors.name"/>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input v-model="form.email" type="email" class="form-control" :class="{'is-invalid':form.errors.email}" id="email">
                            <ErrorMessage :name="form.errors.email"/>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Change Password</label>
                            <input v-model="form.password" type="password" class="form-control" :class="{'is-invalid':form.errors.password}" id="password">
                            <ErrorMessage :name="form.errors.password"/>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Change Avatar</label>
                            <input accept="image/jpeg, image/jpg/ image/png" class="form-control border-0 p-0" type="file" @input="form.avatar = $event.target.files[0]" :class="{'is-invalid':form.errors.avatar}"/>
                            <ErrorMessage :name="form.errors.avatar"/>
                        </div>
                        <button :disabled="form.processing" type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-check"></i>
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
        user: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            form: this.$inertia.form({
                name: this.user.name,
                email: this.user.email,
                password: null,
                avatar: null,
                _method: "PUT",
            }),
        };
    },
    methods: {
        updateData() {
            this.form.post(route("users.update", this.user.id));
        },
    },
};
</script>

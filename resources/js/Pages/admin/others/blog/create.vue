<template>
    <Head :title="__('Post Create')"/>
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card mt-3">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">{{ __('Employee Create') }}</h3>
                        <Link :href="route('employees.index')" class="btn btn-primary">
                        <i class="fa-solid fa-arrow-left"></i>
                        {{ __('Back') }}
                        </Link>
                    </div>
                </div>
                <div class="card-body row justify-content-center">
                    <div class="col-lg-6">
                        <form @submit.prevent="createData">
                        <div class="mb-3 row">
                           <div class="col-md-6">
                                <Label :name="__('Name')"/>
                                <input v-model="form.title" type="text" class="form-control" :class="{'is-invalid':form.errors.title}" id="name">
                                <ErrorMessage :name="form.errors.title"/>
                            </div>
                            <div class="col-lg-6">
                                <Label :name="__('Thumbnail')" :required="false"/>
                                <input accept="image/jpeg, image/jpg/ image/png" class="form-control border-0 p-0" type="file" @input="form.thumbnail = $event.target.files[0]" :class="{'is-invalid':form.errors.thumbnail}"/>
                                <ErrorMessage :name="form.errors.thumbnail"/>
                            </div>
                        </div>
                        <div class="mb-3">
                            <!-- <Label :name="__('Short Description')" :required="false" />
                            <textarea class="form-control" v-model="form.short_description" :class="{'is-invalid':form.errors.short_description}" rows="5"></textarea>
                            <ErrorMessage :name="form.errors.short_description" /> -->
                        </div>
                        <div class="mb-3">


                            <!-- <Label :name="__('Long Description')" :required="false" />
                            <textarea class="form-control" v-model="form.short_description" :class="{'is-invalid':form.errors.short_description}" rows="5"></textarea>
                            <ErrorMessage :name="form.errors.short_description" /> -->
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-check mr-1"></i>
                            {{ __('Save') }}
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
                title: null,
                thumbnail: null,
                short_description: null,
                long_description: null,
            }),

            teams: [],
        };
    },
    methods: {
        createData() {
            this.form.post(route("employees.store"), {
                onSuccess: () => {
                    this.form.reset();
                },
            });
        },
    },
    mounted() {
        this.checkPagePermission("admin");
    },
};
</script>

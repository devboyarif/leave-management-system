<template>
    <Head :title="__('Theme')"/>

    <div class="row justify-content-center">
            <div class="col-12">
                <div class="card mt-3">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <span>{{ __('Admin Theme') }}</span>
                        </div>
                    </div>
                     <div class="card-body">

                        <div class="mb-3 row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <Label :name="__('Primary Color')" />
                                    <input v-model="form.primary_color" type="color" class="form-control"
                                        id="name">
                                </div>
                            </div>
                            <div class="col-md-4">
                                 <div class="form-group">
                                <Label :name="__('Hover Color')" />
                                <input v-model="form.hover_color" type="color" class="form-control"
                                     id="name">
                                    </div>
                            </div>
                            <div class="col-md-4">
                                 <div class="form-group">
                                <Label :name="__('Secondary Color')" />
                                <input v-model="form.secondary_color" type="color" class="form-control"
                                     id="name">
                                    </div>
                            </div>
                            <div class="col-md-4">
                                 <div class="form-group">
                                <Label :name="__('Success Color')" />
                                <input v-model="form.success_color" type="color" class="form-control"
                                     id="name">
                                    </div>
                            </div>
                            <div class="col-md-4">
                                 <div class="form-group">
                                <Label :name="__('Info Color')" />
                                <input v-model="form.info_color" type="color" class="form-control"
                                     id="name">
                                    </div>
                            </div>
                            <div class="col-md-4">
                                 <div class="form-group">
                                <Label :name="__('Warning Color')" />
                                <input v-model="form.warning_color" type="color" class="form-control"
                                     id="name">
                                    </div>
                            </div>
                            <div class="col-md-4">
                                 <div class="form-group">
                                <Label :name="__('Danger Color')" />
                                <input v-model="form.danger_color" type="color" class="form-control"
                                     id="name">
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
        // languages: Array,
        // langInfos: Array,
    },
    data() {
        return {
            // isEditMode: false,
            // selectedId: "",
            // languageStatus: false,
            form: this.$inertia.form({
                primary_color: "",
                hover_color: "",
                secondary_color: "",
                success_color: "",
                info_color: "",
                warning_color: "",
                danger_color: "",
            }),
        };
    },
    methods: {
        // saveData() {
        //     this.isEditMode ? this.updateData() : this.createData();
        // },
        // createData() {
        //     console.log(this.form);
        //     this.form.post(route("languages.store"), {
        //         onSuccess: () => this.form.reset(),
        //     });
        // },
        // editLanguage(language) {
        //     console.log(language);
        //     this.isEditMode = true;
        //     this.selectedId = language.id;
        //     this.form.name = language.name;
        //     this.form.code = language.code;
        //     this.form.direction = language.direction;
        // },
        // cancelEdit() {
        //     this.isEditMode = false;
        //     this.form.reset();
        // },
        // updateData() {
        //     this.form.put(route("languages.update", this.selectedId), {
        //         onSuccess: () => {
        //             this.isEditMode = false;
        //             this.form.reset();
        //         },
        //     });
        // },
        // deleteData(id) {
        //     this.$swal({
        //         title: "Are you sure?",
        //         text: "You won't be able to revert this!",
        //         icon: "warning",
        //         showCancelButton: true,
        //         confirmButtonColor: "#3085d6",
        //         cancelButtonColor: "#d33",
        //         confirmButtonText: "Yes, delete it!",
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             this.$inertia.delete(route("languages.destroy", id));
        //         }
        //     });
        // },
        // languageStatusUpdate(id) {
        //     this.$inertia.put(route("languages.status.update", id));
        // },
        // statusChange(event) {
        //     this.form.status = event.target.checked;
        // },
    },
};
</script>

<!--
<style scoped>
    .switch {
        position: relative;
        display: inline-block;
        width: 35px;
        height: 19px;
    }

    /* Hide default HTML checkbox */
    .switch input {
        display: none;
    }

    /* The slider */
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 15px;
        width: 15px;
        left: 3px;
        bottom: 2px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input.success:checked+.slider {
        background-color: #28a745;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(15px);
        -ms-transform: translateX(15px);
        transform: translateX(15px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style> -->

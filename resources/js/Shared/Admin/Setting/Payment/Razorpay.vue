<template>
    <div class="card m-0">
        <div class="card-body">
            <form @submit.prevent="updateData">
                <div class="form-group">
                    <Label :name="__('Razorpay Key')" />
                    <input v-model="form.razorpay_key" type="text" class="form-control" :class="{'is-invalid':form.errors.razorpay_key}">
                    <ErrorMessage :name="form.errors.razorpay_key" />
                </div>
                <div class="form-group">
                    <Label :name="__('Razorpay Secret')" />
                    <input v-model="form.razorpay_secret" type="text" class="form-control" :class="{'is-invalid':form.errors.razorpay_secret}">
                    <ErrorMessage :name="form.errors.razorpay_secret" />
                </div>
                 <div class="form-group">
                    <Label :name="__('Razorpay Status')" />
                    <div>
                         <label class="switch ">
                        <input @change="statusChange" v-model="form.razorpay_active" type="checkbox" class="success toggle-switch" :checked="form.razorpay_active">
                        <span class="slider round"></span>
                    </label>
                    </div>
                </div>
                 <button :disabled="form.processing" type="submit" class="btn btn-primary">
                    <Loading v-if="form.processing" message="Saving..."/>
                    <span v-else>
                        <i class="fa-solid fa-check mr-1"></i>
                        {{ __('Save') }}
                    </span>
                </button>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        data: Object,
    },
    data() {
        return {
            form: this.$inertia.form({
                razorpay_key: this.data.razorpay_key,
                razorpay_secret: this.data.razorpay_secret,
                razorpay_active: this.data.razorpay_active ? 1 : 0,
                provider: "razorpay",
            }),
        };
    },
    methods: {
        statusChange(event) {
            if (event.target.checked == true) {
                this.form.razorpay_active = 1;
            } else {
                this.form.razorpay_active = 0;
            }
        },
        updateData() {
            this.form.put(route("settings.payment.update"));
        },
    },
    watch: {
        data: {
            handler() {
                this.form.razorpay_key = this.data.razorpay_key;
                this.form.razorpay_secret = this.data.razorpay_secret;
                this.form.razorpay_active = this.data.razorpay_active ? 1 : 0;
            },
            deep: true,
        },
    },
};
</script>

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
</style>

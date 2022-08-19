<template>
 <div class="card">
    <div class="card-body">
        <h6>{{ __('Twilio Setting') }}</h6>
        <hr>
        <form @submit.prevent="saveData('twilio')">
            <div class="form-group">
                <Label :name="__('Twilio Secret')" />
                <input v-model="twilioForm.twilio_secret" type="text" class="form-control" :class="{'is-invalid':twilioForm.errors.twilio_secret}">
                <ErrorMessage :name="twilioForm.errors.twilio_secret" />
            </div>
            <div class="form-group">
                <Label :name="__('Twilio Token')" />
                <input v-model="twilioForm.twilio_token" type="text" class="form-control" :class="{'is-invalid':twilioForm.errors.twilio_token}">
                <ErrorMessage :name="twilioForm.errors.twilio_token" />
            </div>
            <div class="form-group">
                <Label :name="__('Twilio From Number')">
                    <InfoTip :title="__('Type without + sign')" />
                </Label>
                <input v-model="twilioForm.twilio_from" type="text" class="form-control" :class="{'is-invalid':twilioForm.errors.twilio_from}">
                <ErrorMessage :name="twilioForm.errors.twilio_from" />
            </div>
            <div class="form-group">
                <Label :name="__('Twilio Status')" />
                <div>
                    <label class="switch ">
                        <input v-model="twilioForm.twilio_active" type="checkbox" class="success toggle-switch" :checked="twilioForm.twilio_active">
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
                <button :disabled="twilioForm.processing" type="submit" class="btn btn-primary">
                <Loading v-if="twilioForm.processing" message="Saving..."/>
                <span v-else>
                    <i class="fa-solid fa-check mr-1"></i>
                    {{ __('Save') }}
                </span>
            </button>
        </form>
    </div>
</div>
 <div class="card">
    <div class="card-body">
        <h6>{{ __('Vonage Setting') }}</h6>
        <hr>
        <form @submit.prevent="saveData('vonage')">
            <div class="form-group">
                <Label :name="__('Vonage Key')" />
                <input v-model="vonageForm.vonage_key" type="text" class="form-control" :class="{'is-invalid':vonageForm.errors.vonage_key}">
                <ErrorMessage :name="vonageForm.errors.vonage_key" />
            </div>
            <div class="form-group">
                <Label :name="__('Vonage Secret')" />
                <input v-model="vonageForm.vonage_secret" type="text" class="form-control" :class="{'is-invalid':vonageForm.errors.vonage_secret}">
                <ErrorMessage :name="vonageForm.errors.vonage_secret" />
            </div>
            <div class="form-group">
                <Label :name="__('Vonage From Name')" />
                <input v-model="vonageForm.vonage_from_name" type="text" class="form-control" :class="{'is-invalid':vonageForm.errors.vonage_from_name}">
                <ErrorMessage :name="vonageForm.errors.vonage_from_name" />
            </div>
                <div class="form-group">
                <Label :name="__('Vonage Status')" />
                <div>
                    <label class="switch ">
                        <input v-model="vonageForm.vonage_active" type="checkbox" class="success toggle-switch" :checked="vonageForm.vonage_active">
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
                <button :disabled="vonageForm.processing" type="submit" class="btn btn-primary">
                <Loading v-if="vonageForm.processing" message="Saving..."/>
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
            twilioForm: this.$inertia.form({
                twilio_secret: this.data.twilio_secret,
                twilio_token: this.data.twilio_token,
                twilio_from: this.data.twilio_from,
                twilio_active: this.data.twilio_active,
                provider: "twilio",
                type: "sms",
            }),

            vonageForm: this.$inertia.form({
                vonage_key: this.data.vonage_key,
                vonage_secret: this.data.vonage_secret,
                vonage_from_name: this.data.vonage_from_name,
                vonage_active: this.data.vonage_active,
                provider: "vonage",
                type: "sms",
            }),
        };
    },
    methods: {
        saveData(provider) {
            if (provider == "twilio") {
                this.twilioForm.post(route("settings.general.update"));
            } else {
                this.vonageForm.post(route("settings.general.update"));
            }
        },
        twilioStatusChange(event) {
            if (event.target.checked == true) {
                this.twilioForm.twilio_active = 1;
            } else {
                this.twilioForm.twilio_active = 0;
            }
        },
        vonageStatusChange(event) {
            if (event.target.checked == true) {
                this.vonageForm.vonage_active = 1;
            } else {
                this.vonageForm.vonage_active = 0;
            }
        },
    },
    watch: {
        data: {
            handler() {
                this.twilioForm.twilio_secret = this.data.twilio_secret;
                this.twilioForm.twilio_token = this.data.twilio_token;
                this.twilioForm.twilio_from = this.data.twilio_from;
                this.twilioForm.twilio_active = this.data.twilio_active;

                this.vonageForm.vonage_key = this.data.vonage_key;
                this.vonageForm.vonage_secret = this.data.vonage_secret;
                this.vonageForm.vonage_from_name = this.data.vonage_from_name;
                this.vonageForm.vonage_active = this.data.vonage_active;
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

<template>
    <Head title="Step 5 (5/5)"/>
    <div class="content bg-white step7 py-5 px-5 px-sm-5 mb-5 col-12">
        <div class="text-center mb-4 mb-sm-5">
            <h2>{{ __('Thanks for joining') }} {{ settings.app_name }} – {{ __('you are good to go') }}!</h2>
            <h5>{{ __('Now you can start using the application and manage your leaves') }}.</h5>
        </div>
        <div class="d-flex flex-column flex-md-row align-items-center justify-content-center">
            <div class="cta-btn col-12 col-md-6 col-md-7 p-0 text-center">
                <button @click="goTODashboard" type="button" class="cta-btn bg-primary w-50">
                    {{ __('Go to Dashboard') }}
                </button>
            </div>
        </div>
    </div>
</template>


<script>
    export default {
        data(){
            return {
                settings: {}
            }
        },
        methods:{
            goTODashboard(){
                this.$inertia.post(route("company.account.setup.step5"));
            }
        },
        async mounted(){
            let response = await axios.get(route('app.setting'));
            this.settings = response.data;
        }
    };
</script>


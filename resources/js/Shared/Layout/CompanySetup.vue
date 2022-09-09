<template>
   <div class="onboarding mt-2">
         <div class="container">
             <div class="row mt-5 mb-3 align-items-center">
                <div class="col-lg-6">
                    <div class="text-left">
                        <img :src="settings.app_dark_logo" alt="logo"> <br>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="text-right">
                        <Link :href="route('dashboard')" class="cta-btn bg-secondary w-25" v-if="$page.component == 'company/createnew/index'">
                            {{ __('Back') }}
                        </Link>
                        <Link href="/logout" method="post" class="cta-btn bg-danger w-25" v-else>
                            {{ __('Logout') }}
                        </Link>
                    </div>
                </div>
             </div>
            <slot />
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
        async mounted(){
            let response = await axios.get(route('app.setting'));
            this.settings = response.data;
        },
        watch: {
            pageFlashes: {
                handler(flashes) {
                    if (flashes.success) {
                        this.toastSuccess(flashes.success);
                    }
                    if (flashes.error) {
                        this.toastError(flashes.error);
                    }
                    if (flashes.warning) {
                        this.toastWarning(flashes.warning);
                    }
                },
                deep: true,
            },
        },
    };
</script>

<style>
    body {
        background: #f1f1f1 repeat scroll 0 0;
    }

    .onboarding {
        color: #333c43;
    }

    .onboarding .py-sm-9 {
        padding-bottom: 3rem !important;
    }

    .onboarding .container {
        max-width: 980px;
        padding: 0 1rem;
    }

    .onboarding .container .progress {
        height: 0.313rem;
        background-color: transparent !important;
        -webkit-box-shadow: none;
        box-shadow: none;
    }

    .onboarding .container .progress .progress-bar.bg-progress {
        background-color: #0984e3  !important;
    }

    .onboarding .progress-bar {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        color: #fff;
        text-align: center;
        background-color: #c2c5c7;
        transition: width .6s ease;
    }

    .onboarding .bg-white {
        background-color: #fff !important;
    }

    .onboarding .container .content.step4 {
        height: auto;
    }

    .onboarding .container .content {
        margin-bottom: 7.5rem;
    }

    .onboarding .container .content.step4 {
        height: auto;
    }

    .onboarding .container .content {
        margin-bottom: 7.5rem;
    }

    .onboarding .pt-md-9,
    .onboarding .py-md-9 {
        padding-top: 3rem !important;
    }

    .onboarding .py-sm-9 {
        padding-top: 3rem !important;
    }

    .onboarding .btn {
        -webkit-tap-highlight-color: transparent;
        border-radius: 0.1875rem;
        display: inline-flex;
        align-items: center;
        line-height: 1rem;
        font-weight: 600;
        box-sizing: border-box;
        text-align: center;
        justify-content: center;
        text-transform: uppercase;
        font-size: .875rem;
        padding: 0.6875rem 1rem;
        min-height: 2.5rem;
    }

    .onboarding .btn-secondary {
        color: #475056;
        background-color: #fff;
        border-color: #999DA1;
    }

    .onboarding .btn-lg {
        padding: 0.8125rem 2rem;
        font-size: 1.25rem;
        line-height: 1.25rem;
        min-height: 3rem;
    }




    .onboarding .title {
        text-align: center;
        font-weight: bold;
        margin: 0;
    }

    .onboarding .subtitle {
        text-align: center;
        font-weight: bold;
    }

    .email-login {
        display: flex;
        flex-direction: column;
    }

    .onboarding input[type="text"],
    .onboarding input[type="email"],
    select,
    input[type="password"] {
        padding: 15px 20px;
        margin-bottom: 8px;
        border: 1px solid #ccc;
        border-radius: 8px;
        box-sizing: border-box;
        width: 100%;
    }

    .onboarding .cta-btn {
        padding: 16px 20px !important;
        margin-top: 10px;
        margin-bottom: 20px;
        width: 100%;
        border-radius: 10px;
        border: none;
    }

    .onboarding .mt--10 {
        margin-top: -10px;
    }

    .onboarding .auth-card-width {
        width: 600px !important;
    }
</style>

<template>
    <div class="content bg-white step7 py-5 px-5 px-sm-5 mb-5 col-12">
        <div class="text-center mb-4 mb-sm-5">
            <h2>Thanks for joining {{ settings.app_name }} – you're good to go!</h2>
            <h5>You are awesome. Now you can start using the application and manage your leaves.</h5>
        </div>
        <div class="d-flex flex-column flex-md-row align-items-center justify-content-center">
            <div class="cta-btn col-12 col-md-6 col-md-7 p-0 text-center">
                <a href="https://desktime.com/app/my" class="btn btn-lg btn-primary btn-go-to-dashboard">Go to
                    Dashboard</a>
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
        async mounted(){
            let response = await axios.get(route('app.setting'));
            this.settings = response.data;
        }
    };
</script>


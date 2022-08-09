<template>

    <Head :title="__('Team Leave Balance')" />

    <div class="row justify-content-center mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                     <div class="d-flex justify-content-between">
                        <h3 class="card-title">{{ __('Employee Leave Balance') }}</h3>
                        <Link :href="route('company.reports.index')" class="btn btn-primary">
                            <i class="fa-solid fa-arrow-left"></i>
                            {{ __('Back') }}
                        </Link>
                    </div>
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>

</template>


<script>
    export default {
        data() {
            return {

            };
        },
        methods: {

        },
         mounted(){
            this.checkPagePermission('company')
        }
    };
</script>

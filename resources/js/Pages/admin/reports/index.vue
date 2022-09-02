<template>

    <Head :title="__('Report List')" />

    <div class="row justify-content-center pt-5">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        {{ __('Reports') }}
                    </h3>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        <div class="row">
                            <div class="col-md-6 p-2">
                                <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">{{ __('Employees Leave Balance') }}</h5>
                                    </div>
                                    <p class="mb-1">
                                        {{ __('Click to view the employees leave balance') }}
                                    </p>
                                </a>
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
    data() {
        return {};
    },
    methods: {},
    mounted() {
        this.checkPagePermission("admin");
    },
};
</script>

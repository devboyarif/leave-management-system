<template>
    <Head :title="__('Admin Details')"/>

    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card mt-5">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">{{ __('Admin List') }}</h3>
                    </div>
                </div>

                <div class="card-body">
                    <!--  -->
                </div>
            </div>
        </div>
    </div>
</template>


<script>
export default {
    props: {
        //
    },
    components: {
        //
    },
    data() {
        return {
           //
        };
    },
    methods: {
        //
    },
    mounted() {
        // this.checkPagePermission("admin");
    },
};
</script>

<style scoped>

</style>

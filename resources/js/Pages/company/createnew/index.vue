<template>
    <div>
        <div>{{ __('Step') }} {{ current_step }} / 5</div>
        <div class="progress mt-1 mb-2">
            <template v-for="i in current_step" :key="i">
                <div class="progress-bar bg-progress" role="progressbar" style="width: 20%"></div>
                <div class="progress-bar bg-transparent" role="progressbar" style="width: 1.2%"></div>
            </template>
            <template v-for="i in (5-current_step)" :key="i">
                <div class="progress-bar bg-transparent" role="progressbar" style="width: 1.2%"></div>
                <div class="progress-bar" role="progressbar" style="width: 20%"></div>
            </template>
        </div>
    </div>
    <div class="content bg-white d-flex flex-column justify-content-between step4 py-7 px-3 pt-md-9 px-md-7 pb-md-7 col-12">
        <div class="col-12 p-0 mb-md-7" v-if="current_step == 1">
            <Step1 @step="changeStep"/>
        </div>
        <div class="col-12 p-0 mb-md-7" v-else-if="current_step == 2">
            <Step2 @step="changeStep"/>
        </div>
        <div class="col-12 p-0 mb-md-7" v-else-if="current_step == 3">
            <Step3 @step="changeStep"/>
        </div>
        <div class="col-12 p-0 mb-md-7" v-else-if="current_step == 4">
            <Step4 @step="changeStep"/>
        </div>
        <div class="col-12 p-0 mb-md-7" v-else-if="current_step == 5">
            <Step5 @step="changeStep"/>
        </div>
    </div>
</template>

<script>
    import Step1 from './step1.vue';
    import Step2 from './step2.vue';
    import Step3 from './step3.vue';
    import Step4 from './step4.vue';
    import Step5 from './step5.vue';

    export default {
        layout: "CompanySetup",
        components:{
            Step1,
            Step2,
            Step3,
            Step4,
            Step5,
        },
        data() {
            return {
                current_step: 1,
            };
        },
        methods: {
            changeStep(step){
                this.current_step = step;
                this.updateProgress(step)
            },
            async updateProgress(step) {
                await axios.put(route("company.account.setup.progress.update", step));
            }
        }
    };
</script>

<template>
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">{{ title }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">{{ __('Dashboard') }}</a></li>
                <slot/>
            </ol>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        title: {
            type: String,
            default: "",
        },
    },
};
</script>

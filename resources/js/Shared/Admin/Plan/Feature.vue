<template>
    <div class="mb-2 d-flex align-items-center justify-content-between">
        <div class="d-flex">
            <span class="icon mr-2">
                <svg v-if="checked" xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <svg v-else xmlns="http://www.w3.org/2000/svg" class="me-0 icon icon-tabler icon-tabler-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="#dc3545" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </span>
            <template v-if="spanText">
                <span class="mb-0">{{ __(name) }}</span>
            </template>
            <template v-else>
                <h5 class="mb-0">{{ __(name) }}</h5>
            </template>
        </div>
        <template v-if="spanText">
            <span class="mb-0" v-if="value">{{ value }}</span>
        </template>
        <template v-else>
            <hs class="mb-0" v-if="value">{{ value }}</hs>
        </template>
    </div>
</template>

<script>
export default {
    props: {
        checked: {
            type: Boolean,
            required: true,
        },
        name: {
            type: String,
            required: true,
        },
        value: {
            type: String,
            required: false,
        },
        spanText: {
            type: Boolean,
            default: false,
        },
    },
};
</script>

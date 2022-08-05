<template>
<div class="accordion cursor-pointer mb-3" id="accordionExample" @click="show = !show">
    <div class="card mb-0">
        <div class="card-header p-0 d-flex align-items-center justify-content-between">
            <h4 class="card-title pt-2 w-100 py-3 px-3 pointer" id="heading6">
                <b>{{ __('Question') }}</b>: {{ faq.question }}
            </h4>
            <div class="d-flex align-items-center py-2 pr-3">
                <button v-tooltip="__('Edit')" class="btn btn-sm" @click="editData(faq)">
                    <EditIcon/>
                </button>
                <button v-tooltip="__('Delete')" class="btn btn-sm" @click="deleteData(faq.id)">
                    <DeleteIcon/>
                </button>
            </div>
        </div>
        <div id="collapse6" class="collapse" :class="{'show':show}">
            <div class="card-body">
                <b>{{ __('Answer') }}</b>: {{ faq.answer }}
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props: {
        faq: {
            type: Object,
        },
    },
    data() {
        return {
            show: false,
        };
    },
    methods: {
        deleteData(faq_id) {
            this.$swal({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
            }).then((result) => {
                if (result.isConfirmed) {
                    this.$inertia.delete(route("faqs.destroy", faq_id));
                }
            });
        },
        editData(faq) {
            this.$emit("edit", faq);
        },
    },
};
</script>

<style scoped>
.cursor-pointer {
    cursor: pointer;
}
</style>

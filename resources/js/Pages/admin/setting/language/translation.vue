<template>
    <Head title="Admin List"/>

    <div class="row justify-content-center">
            <div class="col-12">
                <div class="card mt-3">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">Language List</h3>
                            <Link :href="route('languages.index')" class="btn btn-primary">
                            <i class="fa-solid fa-arrow-left"></i>
                                Back
                            </Link>
                        </div>
                    </div>
                     <div class="card-body table-responsive p-0">
                        <form @submit.prevent="saveData" autocomplete="off" class="pb-5">
                            <table class="table table-striped table-bordered mt-0 pt-0" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th width="48%">English Text</th>
                                        <th width="48%">
                                            <span class="d-flex justify-content-between">
                                                <span>Translation Text</span>
                                                <span onclick="AutoTransAll('1')" id="translate_all" class="btn bg-info btn-sm">
                                                    Translate All
                                                </span>
                                            </span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(translation, key) in translations" :key="key">
                                    <td class="text-capitalize">{{ replace(key,'_',' ') }}</td>
                                        <td>
                                            <span class="d-flex">
                                                <input type="text" class="form-control" style="width:100%" v-model="translationsData[key]">
                                                <button type="button" onclick="AutoTrans('dashboard', 'Dashboard', 'en')" class="btn btn-sm ml-1 bg-info">
                                                    Translate
                                                </button>
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <button :disabled="loading" type="submit" class="lang-btn btn btn-primary">
                                <Loading v-if="loading" message="Saving..."/>
                               <span v-else>
                                <i class="fa-solid fa-check"></i>
                                Save
                               </span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</template>


<script>
export default {
    props: {
        lang: Array,
        translations: Array,
    },
    data() {
        return {
            translationsData: this.translations,
            loading: false,
        };
    },
    methods: {
        saveData() {
            this.loading = true;
            this.$inertia.put(
                route("languages.translation.update", this.lang.id),
                {
                    translations: this.translationsData,
                },
                {
                    onSuccess: () => {
                        this.loading = false;
                    },
                }
            );
        },
        replace(st, rep, repWith) {
            const result = st.split(rep).join(repWith);
            return result;
        },
    },
};
</script>

<style scoped>
    .lang-btn {
        position: fixed;
        left: 50%;
        bottom: 50px;
        width: 200px;
        padding: 15px;
        text-align: center;
    }

    @media (max-width: 420px) {
        .btn-custom {
            font-size: 10px;
            padding: 2px 5px;
        }
        .card-title {
            font-size: 15px;
        }
        .btn-custom {
            font-size: 10px;
            padding: 2px 5px;
        }
        .card-title {
            font-size: 15px;
        }
        .lang-btn {
            left: 33%;
            width: 100px;
            padding: 5px;
        }
    }
</style>


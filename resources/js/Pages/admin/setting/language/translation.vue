<template>
    <Head :title="__('Translate Language')"/>

    <div class="row justify-content-center">
            <div class="col-12">
                <div class="card mt-3">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">{{ __('Translate Language') }} <span class="badge badge-pill bg-primary">{{ translations.length }}</span></h3>
                            <Link :href="route('languages.index')" class="btn btn-primary">
                            <i class="fa-solid fa-arrow-left"></i>
                                {{ __('Back') }}
                            </Link>
                        </div>
                    </div>
                     <div class="card-body table-responsive p-0">
                        <form @submit.prevent="saveData" autocomplete="off" class="pb-5">
                            <table class="table table-striped table-bordered mt-0 pt-0" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th width="48%">{{ __('English Text') }}</th>
                                        <th width="48%">
                                            <span class="d-flex justify-content-between">
                                                <span>{{ __('Translation Text') }}</span>
                                                <span @click="translateAll" id="translate_all" class="btn bg-info btn-sm">
                                                    <Loading v-if="allTranslating" :message="__('Translating')"/>
                                                    <span v-else>{{ __('Translate All') }}</span>
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
                                                <button type="button" @click="translateIt(key)" class="btn btn-sm ml-1 bg-info">
                                                    <!-- <Loading  v-if="singleTranslating" message="Translating..."/> -->
                                                    <span >{{ __('Translate') }}</span>
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
                                {{ __('Save') }}
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
            // singleTranslating: false,
            allTranslating: false,
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
        async translateIt(key) {
            try {
                // this.singleTranslating = true;
                let response = await axios.get(route("languages.translate"), {
                    params: {
                        key: key,
                        code: this.lang.code,
                    },
                });

                this.translationsData[key] = response.data;
                // this.singleTranslating = true;
            } catch (error) {
                console.log(error);
                // this.singleTranslating = false;
            }
        },
        async translateAll() {
            this.allTranslating = true;
            try {
                let response = await axios.get(
                    route("languages.translate.all"),
                    {
                        params: {
                            id: this.lang.id,
                        },
                    }
                );

                this.translationsData = response.data;

                // for (let i = 0; i < response.data; i++) {
                //     this.translationsData[i] = response.data[i];
                //     // this.translationsData[response_keys[i]] = response_values[i]
                //     //     ? response_values[i]
                //     //     : response_keys[i];
                // }

                //   $.each(result.data, function(key, value) {
                //         $('input[name=' + key + ']').val(value);
                //     });

                //     setTimeout(() => {
                //         $('#translate_all').text('Translate All');
                //         $('.lang-btn').prop('disabled', false);
                //         toastr.success('Translated Successfully', 'Success');
                //     }, 1000);

                // let response_keys = response.data[0];
                // let response_values = response.data[1];

                // for (let i = 0; i < response_keys.length; i++) {
                //     this.translationsData[response_keys[i]] = response_values[i]
                //         ? response_values[i]
                //         : response_keys[i];
                // }

                this.allTranslating = false;
            } catch (error) {
                console.log(error);
                this.allTranslating = false;
            }
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


<template>
    <div class="ml-4">
        <select v-model="lang" @change="changeLanguage" class="form-control">
            <option v-for="lang in languageList" :key="lang.code" :value="lang.code" :selected="lang.code == lang">
            {{ lang.name }}
            </option>
        </select>
    </div>
</template>

<script>
import Icon from "../../Icons/Icon.vue";

export default {
    components: {
        Icon,
    },
    data() {
        return {
            lang: this.$page.props.locale,
            languageList: this.$page.props.languageList,
        };
    },
    methods: {
        changeLanguage() {
            this.$inertia.get(route("language", [this.lang]));
        },
    },
};
</script>

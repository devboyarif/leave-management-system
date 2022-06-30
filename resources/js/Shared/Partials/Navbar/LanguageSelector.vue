<template>
    <div class="ml-4">
        <select v-model="lang" @change="changeLanguage" class="form-control">
            <option v-for="lang in languages" :key="lang.code" :value="lang.code" :selected="lang.code == lang">
            {{ lang.name }}
            </option>
        </select>

        <!-- {{ $page.props.locale }} -->
        <!--
        {{ selectable_locale }}
        {{ lang }} -->
        <!-- <inertia-link :href="route('language', [selectable_locale])">
            <icon class="w-5 h-5" :name="selectable_locale" />
        </inertia-link> -->
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
            languages: [
                { name: "English", code: "en" },
                { name: "German", code: "de" },
            ],
        };
    },
    methods: {
        changeLanguage() {
            // console.log(this.lang);
            this.$inertia.get(route("language", [this.lang]));
        },
    },
    computed: {
        selectable_locale() {
            if (this.$page.locale == "en") {
                return "en";
            }
            return "en";
        },
    },
};
</script>

module.exports = {
    methods: {
        __(key, replace = {}) {
            var translation = this.$page.props.language[key] ?
                this.$page.props.language[key] :
                key
            Object.keys(replace).forEach(function (key) {
                translation = translation.replace(':' + key, replace[key])
            });
            return translation
        },
        route: window.route,
        toastSuccess(message = 'Action completed successfully') {
            this.$toast.success(message);
        },
        toastError(message = 'Something went wrong') {
            this.$toast.error(message);
        },
        toastWarning(message = 'Something went wrong') {
            this.$toast.warning(message);
        },
        currencyPosition(amount){
            if(this.$page.props.current_currency_symbol_position == 'left'){
                return amount +' '+ this.$page.props.current_currency_symbol;
            }else{
                return this.$page.props.current_currency_symbol + ' '+amount;
            }
        },
        pluralize(val, word, plural = word + "s") {
            const _pluralize = (num, word, plural = word + "s") => [1, -1].includes(Number(num)) ? word : plural;
            if (typeof val === "object")
                return (num, word) => _pluralize(num, word, val[word]);
            return _pluralize(val, word, plural);
        },
        checkPagePermission(role) {
            if (this.$page.props.authenticatedUser.role != role) {
                // this.$router.push('/');
                this.$inertia.get(route("error.403"))
            }
        },
        checkDateValidity(start, end, equal = false) {
            if (equal) {
                if(end >= start) { return true }
            }else{
                if(end > start) { return true }
            }

            return false
        }
    },
    computed: {
        pageFlashes() {
            return this.$page.props.flash
        }
    }
}

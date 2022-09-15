<template>

    <Head title="403" />

    <div class="flex-fill d-flex align-items-center justify-content-center mh-100vh mt-6 mt-5">
        <div class="container-tight mt-6 mt-5">
            <div class="empty mt-6 mt-5">
                <div class="empty-header">403</div>
                <p class="empty-title">{{ __('Unauthorized') }}</p>
                <p class="empty-subtitle text-muted">
                    {{ __('We are sorry but you are not authorized to access this page') }}
                </p>
                <div class="empty-action">
                    <Link :href="route('dashboard')" class="btn btn-primary active-link"><svg
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="icon">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <line x1="5" y1="12" x2="11" y2="18"></line>
                            <line x1="5" y1="12" x2="11" y2="6"></line>
                        </svg>
                        {{ __('Take me home') }}
                    </Link>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        layout: '',
    }
</script>

<style scoped>
body {
  display: flex;
  align-items: center;
}
.container-tight {
    width: 100%;
    padding-right: var(--tblr-gutter-x,1.5rem);
    padding-left: var(--tblr-gutter-x,1.5rem);
    margin-right: auto;
    margin-left: auto;
    max-width: 30rem;
}

.empty {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100%;
    padding: 1rem;
    text-align: center;
}

.empty-header {
    margin: 0 0 1rem;
    font-size: 4rem;
    font-weight: 300;
    line-height: 1;
    color: #656d77;
}

.empty-title {
    font-size: 1.125rem;
    line-height: 1.5555556;
    font-weight: 500;
}

.empty-subtitle, .empty-title {
    margin: 0 0 0.5rem;
}

.empty-action {
    margin-top: 1.5rem;
}
</style>

<template>
    <app-layout>
        <template #header>
            <page-header
                title="Le passe plat"
                subtitle="Le meilleur des traiteurs"
            />
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from './../Layouts/AppLayout'
    import PageHeader from './../Components/PageHeader'

    export default {
        components: {
            AppLayout,
            PageHeader,
        },
    }
</script>

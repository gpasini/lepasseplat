<template>
    <app-layout>
        <template #header>
            <page-header
                title="Services & événements"
                size="small"
            />
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="my-10 font-bold text-xl text-center">
                        Dernières publications
                    </div>
                    <posts :posts="posts" />
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from './../Layouts/AppLayout'
    import PageHeader from './../Components/PageHeader'
    import Posts from './../Components/Posts'

    export default {
        components: {
            AppLayout,
            PageHeader,
            Posts,
        },

        props: ['posts']
    }
</script>

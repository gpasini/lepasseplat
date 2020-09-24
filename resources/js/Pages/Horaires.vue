<template>
    <app-layout>
        <template #header>
            <page-header
                title="Horaires de service"
                size="small"
            />
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <posts :display-post-titles="false" :display-post-publication-dates="false" :posts="posts" />
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
            Posts
        },

        props: ['posts']
    }
</script>

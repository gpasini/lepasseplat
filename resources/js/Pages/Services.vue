<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-3xl py-10 text-white leading-tight text-center">
                Services & événements
            </h2>
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

    export default {
        components: {
            AppLayout,
        },
    }
</script>

<style>
header {
    background: url(/img/bg1.jpeg);
    background-size: cover;
    background-position: center;
}
</style>
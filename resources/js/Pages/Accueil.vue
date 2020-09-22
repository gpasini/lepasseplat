<template>
    <app-layout>
        <template #header>
            <div class="text-center pb-40 pt-64">
                <h2 class="font-semibold text-5xl text-white leading-tight">
                    Le passe plat
                </h2>
                <h3 class="text-white text-sm">
                    Le meilleur des traiteurs
                </h3>
            </div>
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
    background-position: bottom;
}
</style>
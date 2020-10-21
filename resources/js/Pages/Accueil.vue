<template>
    <app-layout>
        <template #header>
            <page-header
                title="Le passe plat"
                subtitle="Les cuisines du monde"
            />
        </template>

        <div class="py-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div v-if="$page.user" class="text-xl text-center mb-6">
                    Pour commander
                    <a class="ml-2 text-xl py-2 px-10 bg-blue-400 text-white rounded shadow-md" href="/commander" :active="$page.currentRouteName == 'commander'">
                        Cliquez ici
                    </a>
                </div>
                <div v-else class="text-xl text-center mb-6">
                    Pour commander vos plats, veuillez créer un compte
                    <a href="/register" class="ml-4 text-xl py-2 px-10 bg-blue-400 text-white rounded shadow-md">Inscription</a>
                </div>

                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <scheduled-meals-of-week
                        :scheduled-meals-of-week="scheduledMealsOfWeek"
                        :week="week"
                        :year="year"
                        :bookable="false"
                        :next-week="true"
                        :previous-week="true"
                        route="accueil"
                    />
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from './../Layouts/AppLayout'
    import PageHeader from './../Components/PageHeader'
    import ScheduledMealsOfWeek from './../Components/ScheduledMealsOfWeek'

    export default {
        components: {
            AppLayout,
            PageHeader,
            ScheduledMealsOfWeek,
        },

        props: ['scheduledMealsOfWeek', 'week', 'year'],
    }
</script>

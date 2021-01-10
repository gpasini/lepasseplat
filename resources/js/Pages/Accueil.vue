<template>
    <app-layout>
        <template #header>
            <page-header
                title="Le passe plat"
                subtitle="Les cuisines du monde"
            />
        </template>

        <div class="py-8">
            <div class="sm:px-20 lg:px-48 px-4">
                <div v-if="$page.user" class="sm:text-xl text-md text-center mb-6">
                    Pour commander
                    <a class="ml-4 sm:inline block sm:text-xl sm:py-2 sm:px-10 text-md p-2 bg-blue-400 text-white rounded shadow-md" href="/commander" :active="$page.currentRouteName == 'commander'">
                        Cliquez ici
                    </a>
                </div>
                <div v-else class="sm:text-xl text-md text-center mb-6">
                    Pour commander vos plats, veuillez créer un compte
                    <a href="/register" class="ml-4 sm:inline block sm:text-xl sm:py-2 sm:px-10 text-md p-2 bg-blue-400 text-white rounded shadow-md">Inscription</a>
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

<template>
    <app-layout>
        <template #header>
            <page-header
                title="Commander"
                size="small"
            />
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                    <div class="flex justify-between">
                        <jet-button @click.native="goPrevious()" type="button">
                            Semaine précédente
                        </jet-button>

                        <jet-button @click.native="goNext()" type="button">
                            Semaine suivante
                        </jet-button>
                    </div>

                    <!-- Menu de la semaine -->
                    <scheduled-meals-of-week :scheduled-meals-of-week="scheduledMealsOfWeek" />

                    <!-- Réservations de la semaine -->
                    <bookings-of-week :bookings-of-week="bookingsOfWeek" v-if="hasBooking" />
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from './../Layouts/AppLayout'
    import PageHeader from './../Components/PageHeader'
    import ScheduledMealsOfWeek from './../Components/ScheduledMealsOfWeek'
    import BookingsOfWeek from './../Components/BookingsOfWeek'
    import Meal from './../Components/Meal'
    import JetButton from './../Jetstream/Button'
    import JetInput from './../Jetstream/Input'
    import JetLabel from './../Jetstream/Label'

    export default {
        components: {
            AppLayout,
            PageHeader,
            JetInput,
            JetLabel,
            JetButton,
            Meal,
            ScheduledMealsOfWeek,
            BookingsOfWeek,
        },

        props: ['scheduledMealsOfWeek', 'bookingsOfWeek', 'week', 'year', 'hasBooking'],

        methods: {
            goNext() {
                console.log('ici');
                this.$inertia.visit('/commander', {
                    data: {
                        week: this.week + 1,
                        year: this.year
                    },
                    preserveScroll: true,
                })
            },

            goPrevious() {
                this.$inertia.visit('/commander', {
                    data: {
                        week: this.week - 1,
                        year: this.year
                    },
                    preserveScroll: true,
                })
            },
        }
    }
</script>

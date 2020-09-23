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

                    <div class="border m-2 p-2">
                        <div>
                            Menu de la semaine
                        </div>

                        <div dusk="week_menu" class="flex">
                            <div
                                v-for="(scheduledMealsOfDay, day) in scheduledMealsOfWeek"
                                :key="day"
                                class="border m-2 p-2 w-1/4"
                            >
                                <div>{{ day }}</div>

                                <div v-if="scheduledMealsOfDay.length > 0">
                                    <meal :meal="scheduledMeal.meal" v-for="scheduledMeal in scheduledMealsOfDay" :key="scheduledMeal.id">
                                        <!-- Boutons spécifiques pour la commande -->
                                        <template #actions>
                                            <jet-button v-if="scheduledMeal.bookable" @click.native="book(scheduledMeal)" dusk="book" type="button">
                                                Commander
                                            </jet-button>
                                        </template>
                                    </meal>
                                </div>

                                <div v-else>
                                    Aucun plat au menu
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="border m-2 p-2" dusk="bookings" v-if="hasBooking">

                        Vos commandes de la semaine :

                        <div v-for="(bookingOfDay, day) in bookingsOfWeek" :key="day">
                            <div class="border m-2 p-2" v-if="bookingOfDay.length > 0">
                                <div>Jour de la commande : {{ day }}</div>
                                <div>Contenu de la commande :</div>

                                <meal :meal="booking.scheduled_meal.meal" v-for="booking in bookingOfDay" :key="booking.id">
                                    <!-- Boutons spécifiques pour gérer la commande -->
                                    <template #actions>
                                        <div>
                                            Nombre de part :
                                            <jet-button @click.native="setQuantity(booking, booking.quantity - 1)" type="button">
                                                -
                                            </jet-button>

                                            <span>{{ booking.quantity }}</span>

                                            <jet-button @click.native="setQuantity(booking, booking.quantity + 1)" type="button">
                                                +
                                            </jet-button>
                                        </div>

                                        <jet-button @click.native="unbook(booking)" type="button">
                                            Annuler
                                        </jet-button>
                                    </template>
                                </meal>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from './../Layouts/AppLayout'
    import PageHeader from './../Components/PageHeader'
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

            book(scheduledMeal) {
                this.$inertia.post('/book', {
                    scheduled_meal_id: scheduledMeal.id
                }, {
                    preserveScroll: true,
                })
            },

            unbook(booking) {
                this.$inertia.post('/unbook', {
                    booking_id: booking.id
                }, {
                    preserveScroll: true,
                })
            },

            setQuantity(booking, quantity) {
                this.$inertia.post('/book/quantity', {
                    booking_id: booking.id,
                    quantity: quantity
                }, {
                    preserveScroll: true,
                })
            }
        }
    }
</script>

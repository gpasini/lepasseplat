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

                    <div class="flex">
                        <div
                            v-for="(scheduledMealsOfDay, day) in scheduledMealsOfWeek"
                            :key="day"
                        >
                            <div>{{ day }}</div>

                            <div v-if="scheduledMealsOfDay.length">
                                <div v-for="scheduledMeal in scheduledMealsOfDay" :key="scheduledMeal.id">
                                    <img :src="`/storage/${scheduledMeal.meal.photo}`" />

                                    <div>
                                        {{ scheduledMeal.meal.title }}
                                    </div>

                                    <div>
                                        {{ scheduledMeal.meal.description }}
                                    </div>
                                    <div>
                                        {{ scheduledMeal.meal.price }} €
                                    </div>

                                    <jet-button type="button">
                                        Commander
                                    </jet-button>
                                </div>
                            </div>

                            <div v-else>
                                Aucun plat au menu
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
    import JetButton from './../Jetstream/Button'

    export default {
        components: {
            AppLayout,
            PageHeader,
            JetButton,
        },

        props: ['scheduledMealsOfWeek']
    }
</script>

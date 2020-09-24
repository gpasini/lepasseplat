<template>
  <div class="border m-2 p-2">
      <div v-if="nextWeek || previousWeek" class="flex justify-between">
          <jet-button v-if="previousWeek" @click.native="goPrevious()" type="button">
              Semaine précédente
          </jet-button>

          <jet-button v-if="nextWeek" @click.native="goNext()" type="button">
              Semaine suivante
          </jet-button>
      </div>

      <div>
          Menu de la semaine
      </div>

      <div dusk="week_menu" class="flex">
          <div
              v-for="(scheduledMealsOfDay, day) in scheduledMealsOfWeek"
              :key="day"
              class="border m-2 p-2 w-1/4"
          >
              <div class="capitalize">{{ day | moment("dddd Do MMMM YYYY") }}</div>

              <div v-if="scheduledMealsOfDay.length > 0">
                  <meal :meal="scheduledMeal.meal" v-for="scheduledMeal in scheduledMealsOfDay" :key="scheduledMeal.id">
                      <!-- Boutons spécifiques pour la commande -->
                      <template #actions>
                          <jet-button v-if="bookable && scheduledMeal.bookable" @click.native="book(scheduledMeal)" dusk="book" type="button">
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
</template>

<script>
import JetButton from './../Jetstream/Button'
import Meal from './Meal'

export default {
  components: {
    JetButton,
    Meal,
  },

  props: {
    scheduledMealsOfWeek: {
      type: Object,
      required: true,
    },

    bookable: {
      type: Boolean,
      default: true
    },

    week: {
      type: Number,
      required: true,
    },

    year: {
      type: Number,
      required: true,
    },

    previousWeek: {
      type: Boolean,
      default: true,
    },

    nextWeek: {
      type: Boolean,
      default: true,
    },

    route: {
      type: String,
      default: 'commander',
    },
  },

  methods: {
    book(scheduledMeal) {
        this.$inertia.post('/book', {
            scheduled_meal_id: scheduledMeal.id
        }, {
            preserveScroll: true,
        })
    },

    goNext() {
        this.$inertia.visit('/change-week', {
            data: {
                week: this.week,
                year: this.year,
                action: 'next',
                route: this.route,
            },
            preserveScroll: true,
        })
    },

    goPrevious() {
        this.$inertia.visit('/change-week', {
            data: {
                week: this.week,
                year: this.year,
                action: 'previous',
                route: this.route,
            },
            preserveScroll: true,
        })
    },
  }
}
</script>

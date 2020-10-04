<template>
  <div class="m-2 p-2">
      <div class="text-center uppercase font-bold text-xl tracking-wide my-4">
          Menu de la semaine
      </div>

      <div dusk="week_menu" class="flex">
          <div
              v-for="(scheduledMealsOfDay, day) in scheduledMealsOfWeek"
              :key="day"
              class="border-2 m-2 p-2 w-1/4 rounded-lg border-yellow-300"
          >
              <div class="font-bold text-center uppercase text-sm my-2">{{ day | moment("dddd Do MMMM") }}</div>

              <div v-if="scheduledMealsOfDay.length > 0" class="my-2">
                  <meal :meal="scheduledMeal.meal" v-for="scheduledMeal in scheduledMealsOfDay" :key="scheduledMeal.id">
                      <!-- Boutons spécifiques pour la commande -->
                      <template #actions>
                        <div  class="text-center my-2">
                          <!-- bookable && scheduledMeal.bookable -->
                          <jet-button class="bg-green-400" v-if="true" @click.native="selected = scheduledMeal" dusk="book" type="button">
                              Commander
                          </jet-button>
                        </div>
                      </template>
                  </meal>
              </div>

              <div v-else class="my-2 p-2">
                  Aucun plat au menu
              </div>
          </div>
      </div>

      <!-- Modale Confirmation de commande -->
      <jet-dialog-modal :show="selected" @close="selected = null">
          <template #title>
              Confirmation de votre commande
          </template>

          <template #content>
              <div>Vous êtes sur le point de commander le plat suivant :</div>
              <div v-if="selected">{{ selected.meal.title }}</div>

              <div class="mt-4">
                  <jet-label for="quantity" value="Nombre de part" />
                  <jet-input id="quantity" type="number" class="mt-1 block w-3/4" placeholder="Nombre de part"
                    v-model="quantity"
                  />
              </div>
          </template>

          <template #footer>
              <jet-secondary-button @click.native="selected = null">
                  Annuler
              </jet-secondary-button>

              <jet-button class="ml-2" @click.native="book()">
                  Confirmer la commande
              </jet-button>
          </template>
      </jet-dialog-modal>
  </div>
</template>

<script>
import JetDialogModal from './../Jetstream/DialogModal'
import JetLabel from './../Jetstream/Label'
import JetInput from './../Jetstream/Input'
import JetSecondaryButton from './../Jetstream/SecondaryButton'
import JetButton from './../Jetstream/Button'
import Meal from './Meal'

export default {
  components: {
    JetButton,
    JetLabel,
    JetInput,
    JetDialogModal,
    JetSecondaryButton,
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

  data() {
    return {
      selected: null,
      quantity: 1
    };
  },

  methods: {
    book() {
        this.$inertia.post('/book', {
            scheduled_meal_id: this.selected.id,
            quantity: this.quantity,
        }, {
            preserveScroll: true,
        })
          .then(() => {
            this.selected = null;
            this.quantity = 1;
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

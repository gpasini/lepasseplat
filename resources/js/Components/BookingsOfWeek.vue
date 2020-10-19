<template>
    <div dusk="bookings">
       <div class="text-center uppercase font-bold text-xl tracking-wide my-4"> 
           Vos commandes de la semaine 
        </div>

        <div class="flex m-2 p-2">
            <div class="border-2 m-2 p-2 w-1/4 rounded-lg border-yellow-300" v-for="(bookingOfDay, day) in bookingsOfWeek" :key="day">
                <div class="border border-gray-200 rounded m-2 p-2" v-if="bookingOfDay.length > 0">
                    <div class="text-center font-bold text-sm uppercase">{{ day | moment("dddd Do MMMM") }}</div>

                    <meal :meal="booking.scheduled_meal.meal" v-for="booking in bookingOfDay" :key="booking.id">
                        <!-- Boutons spécifiques pour gérer la commande -->
                        <template #actions>
                            <div class="text-center my-4" ><!--v-if="editable && booking.editable"-->
                                Nombre de part :
                                <jet-button v-if="booking.quantity > 1" @click.native="setQuantity(booking, booking.quantity - 1)" type="button">
                                    -
                                </jet-button>

                                <span>{{ booking.quantity }}</span>

                                <jet-button @click.native="setQuantity(booking, booking.quantity + 1)" type="button">
                                    +
                                </jet-button>
                            </div>

                            <div class="text-center">
                                <jet-button class="bg-red-600 w-full" @click.native="selected = booking" type="button"><!--v-if="editable && booking.editable"-->
                                    Annuler
                                </jet-button>
                            </div>
                        </template>
                    </meal>
                </div>
            </div>
        </div>

        <!-- Delete Account Confirmation Modal -->
        <jet-dialog-modal :show="selected" @close="selected = null">
            <template #title>
                Annulation de votre commande
            </template>

            <template #content>
                Êtes-vous sur de vouloir annuler votre commande ?
            </template>

            <template #footer>
                <jet-secondary-button @click.native="selected = null">
                    Conserver la commande
                </jet-secondary-button>

                <jet-danger-button class="ml-2" @click.native="unbook()">
                    Annuler la commande
                </jet-danger-button>
            </template>
        </jet-dialog-modal>
    </div>
</template>

<script>
import JetDialogModal from './../Jetstream/DialogModal'
import JetDangerButton from './../Jetstream/DangerButton'
import JetSecondaryButton from './../Jetstream/SecondaryButton'
import JetButton from './../Jetstream/Button'
import Meal from './Meal'

export default {
  components: {
    JetButton,
    JetDialogModal,
    JetDangerButton,
    JetSecondaryButton,
    Meal,
  },

  props: {
    bookingsOfWeek: {
      type: Object,
      required: true,
    },

    editable: {
      type: Boolean,
      default: true
    }
  },

  data() {
      return {
          selected: null
      };
  },

  methods: {
    unbook() {
        this.$inertia.post('/unbook', {
            booking_id: this.selected.id
        }, {
            preserveScroll: true,
        })
            .then(() => this.selected = null)
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

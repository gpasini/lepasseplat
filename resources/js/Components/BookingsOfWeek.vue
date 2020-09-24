<template>
    <div class="border m-2 p-2" dusk="bookings">
        Vos commandes de la semaine :

        <div v-for="(bookingOfDay, day) in bookingsOfWeek" :key="day">
            <div class="border m-2 p-2" v-if="bookingOfDay.length > 0">
                <div>Jour de la commande : <div class="capitalize">{{ day | moment("dddd Do MMMM") }}</div></div>
                <div>Contenu de la commande :</div>

                <meal :meal="booking.scheduled_meal.meal" v-for="booking in bookingOfDay" :key="booking.id">
                    <!-- Boutons spécifiques pour gérer la commande -->
                    <template #actions>
                        <div v-if="editable && booking.editable">
                            Nombre de part :
                            <jet-button @click.native="setQuantity(booking, booking.quantity - 1)" type="button">
                                -
                            </jet-button>

                            <span>{{ booking.quantity }}</span>

                            <jet-button @click.native="setQuantity(booking, booking.quantity + 1)" type="button">
                                +
                            </jet-button>
                        </div>

                        <jet-button v-if="editable && booking.editable" @click.native="selected = booking" type="button">
                            Annuler
                        </jet-button>
                    </template>
                </meal>
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

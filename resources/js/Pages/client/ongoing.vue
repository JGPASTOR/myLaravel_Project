<script setup>
import ClientLayout from "@/Layouts/ClientLayout.vue";
import { ref, defineProps, computed } from "vue";
import { useForm, Head } from "@inertiajs/vue3";
import Swal from "sweetalert2";
import { router } from "@inertiajs/vue3";

const props = defineProps({
  bookings: Object,
});

// Track button state for each booking
const buttonStates = ref({});

// Initialize button states to "start" for all bookings
props.bookings.forEach((booking) => {
  buttonStates.value[booking.id] = "start";
});

// Computed: filter only "accepted" bookings
const filteredBookings = computed(() => {
  return props.bookings.filter((booking) => booking.status === "accepted");
});

// Handle button click to toggle states
const toggleButtonState = (booking) => {
  if (buttonStates.value[booking.id] === "start") {
    buttonStates.value[booking.id] = "done";
    Swal.fire({
      title: "Started!",
      text: "Booking has been started.",
      icon: "success",
    });
  } else if (buttonStates.value[booking.id] === "done") {
    buttonStates.value[booking.id] = "pay";
    Swal.fire({
      title: "Done service!",
      icon: "success",
    });
  }
};

const handlePayNow = (booking) => {
  Swal.fire({
    title: "Pay service!",
    text: "Please confirm payment.",
    icon: "info",
    showCancelButton: true,
    confirmButtonText: "Yes, proceed!",
    cancelButtonText: "Cancel",
  }).then((result) => {
    if (result.isConfirmed) {
      // Redirect to the 'client.completed' route with booking ID
      router.get(route("client.completed", booking.id));
    }
  });
};
</script>

<template>
  <Head title="Ongoing Bookings" />

  <ClientLayout>
    <div
      class="content-container"
      v-for="booking in filteredBookings"
      :key="booking.id"
    >
      <div class="description">Booking Description:</div>
      <div class="description-text">{{ booking.service_user_title }}</div>
      <div class="content">
        <div class="image">
          <img
            :src="'/serviceImage/' + booking.service_user_image"
            alt="Service Image"
            height="300"
            width="400"
          />
        </div>
        <div class="details">
          <div class="booking-detail">
            <h3>Booking Detail</h3>
            <p><span>Provider:</span> {{ booking.service_user_name }}</p>
            <p><span>Location:</span> {{ booking.service_user_address }}</p>
            <p><span>ContactNumber:</span> {{ booking.service_user_phone }}</p>
            <p>
              <span>Status:</span>
              <span class="status">{{ booking.status }}</span>
            </p>
          </div>

          <div class="vertical-line"></div>

          <!-- Conditionally show payment details -->
          <div class="payment-detail" v-if="buttonStates[booking.id] === 'pay'">
            <h3>Payment Detail</h3>
            <p>
              <span>Total:</span>
              <span style="color: #0000ff">₱ {{ booking.service_user_price }}</span>
            </p>
          </div>
        </div>
      </div>
      <!-- Buttons -->
      <div class="buttons">
        <!-- Start/Done Button -->
        <button
          v-if="buttonStates[booking.id] === 'start' || buttonStates[booking.id] === 'done'"
          :class="buttonStates[booking.id] === 'start' ? 'start-button' : 'done-button'"
          @click="toggleButtonState(booking)"
        >
          {{ buttonStates[booking.id] === "start" ? "Start" : "Done" }}
        </button>

        <!-- Pay Now Button -->
        <button
          v-if="buttonStates[booking.id] === 'pay'"
          class="pay-now-button"
          @click="handlePayNow(booking)"
        >
          Pay Now
        </button>
      </div>
    </div>
  </ClientLayout>
</template>


<style scoped>
.content-container {
    width: 90%;
    margin: 40px auto;
    background-color: #FFFFFF;
    border-radius: 10px;
    padding: 40px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}
.description {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 20px;
}
.description-text {
    background-color: #E0E0E0;
    padding: 20px;
    border-radius: 5px;
    font-size: 20px;
}
.content {
    display: flex;
    justify-content: space-between;
    margin-top: 40px;
}
.image {
    flex: 1;
    text-align: center;
}
.image img {
    width: 80%;
    border-radius: 10px;
}
.details {
    flex: 2;
    display: flex;
    justify-content: space-between;
    position: relative;
}
.booking-detail, .payment-detail {
    flex: 1;
    padding: 0 40px;
}
.booking-detail h3, .payment-detail h3 {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 20px;
}
.booking-detail p, .payment-detail p {
    font-size: 20px;
    margin: 10px 0;
}
.booking-detail p span, .payment-detail p span {
    font-weight: bold;
}
.booking-detail .status {
    color: #0abc1c;
}
.vertical-line {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 50%;
    width: 1px;
    background-color: #000;
}
.buttons {
    display: flex;
    color: #FFF;
    justify-content: flex-end;
    margin-top: 20px;
}
.buttons button {
    width: 100px;
    background-color: #0ABC1C;  
    padding: 10px;
    font-size: 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-left: 10px;
}
.done-button {
  background-color: #FFD700;
    color: #FFF;
}
.pay-now-button {
  background-color: #FFD700;
    color: #FFF;
}
</style>

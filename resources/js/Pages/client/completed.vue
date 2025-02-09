<script setup>
import ClientLayout from "@/Layouts/ClientLayout.vue";
import { ref, defineProps, computed } from "vue";
import { useForm, Head } from "@inertiajs/vue3";
import Swal from "sweetalert2";

const props = defineProps({
   bookings: Object,
});

const filteredBookings = computed(() => {
    return props.bookings.filter((booking) => booking.status === "completed");
});


</script>

<template>
    <Head title="Completed Bookings" />

    <ClientLayout>
        <div class="content-container" v-for="booking in filteredBookings" :key="booking.id">
      <div class="description">Booking Description:</div>
      <div class="description-text">
        {{ booking.service_user_title }}</div>
      <div class="content">
        <div class="image">
          <img
          :src="'/serviceImage/' + booking.service_user_image"
            alt="Image of a 1.5 hp window type air conditioner"
            height="300"
           
            width="400"
          />
        </div>
        <div class="details">
          <div class="booking-detail">
            <h3>Booking Detail</h3>
            <p>
              <span> Location: </span>
              {{ booking.service_user_address }}
            </p>
            <p>
              <span> Provider: </span>
              {{ booking.service_user_name }}
            </p>
            <p>
               <span> Contact: </span>
               {{ booking.service_user_phone }}
            </p>
            <p>
              <span> Status: </span>
              <span class="status">{{ booking.status }}</span>
            </p>
          </div>
          <div class="vertical-line"></div>
          <div class="payment-detail">
            <h3>Payment detail</h3>
            <p>
              <span> Total: </span>
              <span style="color: #0000ff"> ₱ {{ booking.service_user_price }} </span>
            </p>
            <p>
              <span class="status">{{ booking.status }}</span>
              -
            </p>
          </div>
        </div>
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
    color: #0ABC1C; 
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
    justify-content: flex-end;
    margin-top: 20px;
}
.buttons button {
    width: 100px;
    padding: 10px;
    font-size: 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-left: 10px;
}
.hold-button {
    background-color: #FFD700;
    color: #000;
}
.done-button {
    background-color: #00C853;
    color: #FFF;
}
.pay-now-button {
    background-color: #0ABC1C;
    color: #FFF;
}
</style>

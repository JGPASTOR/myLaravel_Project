<script setup>
import ProviderLayout from "@/Layouts/ProviderLayout.vue";
import { ref, defineProps, computed } from "vue";
import InputError from "@/Components/InputError.vue";
import { useForm, Head } from "@inertiajs/vue3";
import Swal from "sweetalert2";

const props = defineProps({
    bookings: {
        type: Array,
        required: true,
    },
});

const form = useForm({
  
  status: "",  

});


// Method to dynamically set classes based on the status
const getStatusClass = (status) => {
  switch (status) {
    case 'accepted':
        return 'status-accepted';
    case 'completed':
      return 'status-completed';
    case 'declined':
      return 'status-declined';
    case 'pending':
    default:
      return 'status-pending'; // Default status is 'pending'
  }
};

const accepted = (booking) => {
    form.patch(route("provider.accept", booking.id), {
     
            onSuccess: () => {
                closeModal();
                Swal.fire({
                    title: "Success!",
                    text: "Booked",
                    icon: "success",
                });
            },
        });
};

const declined = (booking) => {
    form.patch(route("provider.decline", booking.id), {
     
            onSuccess: () => {
                closeModal();
                Swal.fire({
                    title: "Success!",
                    text: "Booked",
                    icon: "success",
                });
            },
        });
};
    
const closeModal = () => {
    dialogVisible.value = false;
    form.reset();

};

const filteredBookings = computed(() => {
    return props.bookings.filter((booking) => booking.status === "pending");
});

</script>

<template>
    <Head title="Booking" />

    <ProviderLayout>
        <header class="top-header">
            <h1>New Bookings</h1>
        </header>

        <div class="bookings-container">
            <div class="booking-card" v-for="booking in filteredBookings " :key="booking.id">
                <div class="card-header">
                    <img
                        :src="'/serviceImage/' + booking.service_user_image"
                        alt="SERVIFY"
                        class="card-logo"
                    />
                    <div class="status-price">
                        <span :class="getStatusClass(booking.status)">{{ booking.status }}</span>
                        <span class="price">₱{{ booking.service_user_price }}</span>
                    </div>
                </div>

                <table class="booking-details">
                    <tr>
                        <td class="label">Service</td>
                        <td class="value">
                          {{ booking.service_user_title }}
                        </td>
                    </tr>

                    <tr>
                        <td class="label">Client</td>
                        <td class="value">{{ booking.client_name }}</td>
                    </tr>

                    <tr>
                        <td class="label">Address</td>
                        <td class="value">
                          {{ booking.service_user_address }}
                        </td>
                    </tr>
 
                    <tr>
                        <td class="label">Contact #</td>
                        <td class="value">{{ booking.client_phone }}</td>
                    </tr>

                    <tr>
                        <td class="label">Date & Time</td>
                        <td class="value">{{ booking.date }} {{ booking.time }}</td>
                    </tr>

                    <tr>
                        <td class="label">Message</td>
                        <td class="value">{{ booking.message}}</td>
                    </tr>
                </table>

                <div class="card-actions">
                    <button class="accept"   @click="accepted(booking)">Accept</button>
                    <button class="btn-decline"   @click="declined(booking)" >Decline</button>
                </div>
            </div>
        </div>
    </ProviderLayout>
</template>

<style scoped>
/* Define the styles for each status */
.status-accepted {
  color: rgb(55, 214, 55);
  font-weight: bold;
}

.status-completed {
  color: green;
  font-weight: bold;
}

.status-declined {
  color: red;
  font-weight: bold;
}

.status-pending {
  color: orange;
  font-weight: bold;
}
.content-container {
    width: 90%;
    margin: 40px auto;
    background-color: #ffffff;
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
    background-color: #e0e0e0;
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
.booking-detail,
.payment-detail {
    flex: 1;
    padding: 0 40px;
}
.booking-detail h3,
.payment-detail h3 {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 20px;
}
.booking-detail p,
.payment-detail p {
    font-size: 20px;
    margin: 10px 0;
}
.booking-detail p span,
.payment-detail p span {
    font-weight: bold;
}
.booking-detail .status {
    color: green;
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
    background-color: #ffd700;
    color: #000;
}
.done-button {
    background-color: #00c853;
    color: #fff;
}
.pay-now-button {
    background-color: #0abc1c;
    color: #fff;
}


/* Global Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body {
    background-color: #f5f5f5;
}

/* Header Styles */
.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 30px;
    background-color: white;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.header .logo img {
    height: 70px;
}

.header_profile .profile-pic {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
}

.header .dropdown {
    display: none;
    position: absolute;
    top: 60px;
    right: 0;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
    overflow: hidden;
    z-index: 1;
}
.header .dropdown a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: flex;
    align-items: center;
    border-radius: 10px;
}
.header .dropdown a i {
    margin-right: 10px;
}
.header .dropdown a:last-child {
    border-bottom: none;
}
.header .dropdown a:hover {
    background-color: #f5f5f5;
}

/* Container Layout */
.container {
    display: flex;
    min-height: calc(90vh - 70px); /* Subtract header height */
}

/* Sidebar Styles */
.sidebar {
    width: 250px;
    background-color: white;
    padding: 20px;
    border-right: 1px solid #eee;
}

.sidebar .header_profile {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
    margin-bottom: 30px;
}

.sidebar .email {
    font-size: 14px;
    color: #666;
}

.nav ul {
    list-style: none;
}

.nav ul li {
    padding: 12px 0;
    cursor: pointer;
    color: #333;
}

.nav ul li a {
    text-decoration: none;
    color: inherit;
}

/* Main Content Styles */
.main-content {
    flex: 1;
    padding: 20px;
}

.top-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
}

/* Booking Card Styles */
.booking-card {
    background: white;
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 20px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

.card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.card-logo {
    height: 30px;

}

.status-price {
    text-align: right;
}

.status {
    color: #ff0000;
    background: #ffe5e5;
    padding: 5px 10px;
    border-radius: 15px;
    font-size: 14px;
}

.price {
    display: block;
    color: #0000ff;
    font-size: 14px;
    margin-top: 5px;
}

.booking-details {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

.booking-details tr {
    background: #f0f0ff;
}

.booking-details td {
    padding: 10px;
    border: 1px solid #e0e0ff;
}

.booking-details .label {
    width: 120px;
    color: #666;
}

.booking-details .value {
    color: #333;
}

.card-actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
}
/* Accept Button */
.accept {
    background-color: #0000ff;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-accept:hover {
    background-color: #0000a0; /* Darker blue on hover */
}

/* Decline Button */
.btn-decline {
    background-color: #0000ff;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-decline:hover {
    background-color: #f11010; /* Red color on hover */
}

.popup {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    justify-content: center;
    align-items: center;
}
.popup-content {
    background-color: white;
    padding: 40px;
    border-radius: 10px;
    text-align: center;
}
.popup-content p {
    font-size: 24px;
}
.popup-buttons {
    margin-top: 20px;
    display: flex;
    justify-content: center;
}
.popup-buttons button {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    font-size: 20px;
    cursor: pointer;
    margin: 0 10px;
}
.popup-buttons .ok {
    background-color: #3333cc;
    color: white;
}

/* Footer Styles */ 
footer {
    text-align: center;
    padding: 35px;
    background-color: #fff;
    border-bottom: 2px solid #e0e0e0;
    position: relative;
    bottom: auto;
    width: 100%;
}

</style>

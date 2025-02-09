<template>
    <div>
      <marquee behavior="scroll" direction="left">
        <h1>Service Provider Summary Report</h1>
      </marquee>
  
      <div v-if="completedBookings.length > 0">
        <table class="table">
          <thead>
            <tr>
              <th>Booking ID</th>
              <th>Client Name</th>
              <th>Provider Name</th>
              <th>Provider Address</th>
              <th>Service Type</th>
              <th>Booking Status</th>
              <th>Date</th>
              <th>Time</th>
              <th>Price</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="booking in completedBookings" :key="booking.id">
              <td>{{ booking.id }}</td>
              <td>{{ booking.client_name }}</td>
              <td>{{ booking.service_user_name }}</td>
              <td>{{ booking.service_user_address }}</td>
              <td>{{ booking.service_user_title }}</td>
              <td>{{ booking.status }}</td>
              <td>{{ booking.date }}</td>
              <td>{{ booking.time }}</td>
              <td>{{ booking.service_user_price }}</td>
            </tr>
          </tbody>
        </table>
  
        <div class="total-price">
          <h3>Total Revenue:   {{ totalPrice }}</h3>
        </div>
      </div>
  
      <div v-else>
        <p>No bookings found for the report.</p>
      </div>
    </div>
  </template>
  
  
  <script setup>
import { ref, computed } from 'vue';

const props = defineProps({
  bookings: Array,
});

// Filter completed bookings
const completedBookings = computed(() => {
  return props.bookings.filter(booking => booking.status === 'completed');
});

// Calculate total price of completed bookings and convert to whole integer
const totalPrice = computed(() => {
  const total = completedBookings.value.reduce((sum, booking) => {

    return sum + (booking.service_user_price || 0); 
  }, 0);

  // Return total as a whole number (integer)   
  return total;
});
</script>

  
<style scoped>
.table {
  width: 100%;
  border-collapse: collapse;
}

.table th, .table td {
  padding: 12px;
  text-align: left;
  border: 1px solid #ddd;
}

.table th {
  background-color: #a593ff; /* Set header background color */
  color: black; /* Set header text color */
}

h1 {
  margin-bottom: 20px;
}
</style>

  
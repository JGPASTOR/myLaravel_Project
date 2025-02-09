<script setup>
import ProviderLayout from '@/Layouts/ProviderLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

// Use the props passed from the backend
const props = defineProps({
 
  serviceCount: {
    type: Number,
    required: true
},


bookingCount: {
    type: Number,
    required: true
},

});
</script>


<template>
    <Head title="Dashboard" />
  
    <!-- Pass stats to ProviderLayout as a prop -->
    <ProviderLayout >
      <h1>Provider Dashboard</h1>
      <section class="stats">
        <div  class="stat-box">
          <p class="number"> {{ bookingCount }}</p>
          <p class="label">Total Bookings</p>
        </div>
        <div  class="stat-box">
          <p class="number">    {{ serviceCount }} </p>
          <p class="label">Services</p>
        </div>
        
      </section>
    </ProviderLayout>
  </template>

<style scoped>    
</style>
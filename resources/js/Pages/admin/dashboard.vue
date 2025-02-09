<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

// Use the props passed from the backend
const props = defineProps({
  stats: Array,
});
</script>


<template>
  <Head title="Dashboard" />

  <!-- Pass stats to AdminLayout as a prop -->
  <AdminLayout :stats="stats">
    <h1>Admin Dashboard</h1>
    <section class="stats">
      <div v-for="(stat, index) in stats" :key="index" class="stat-box">
        <p class="number">{{ stat.number }}</p>
        <p class="label">{{ stat.label }}</p>
      </div>

    </section>
  </AdminLayout>
</template>

<style scoped>

</style>




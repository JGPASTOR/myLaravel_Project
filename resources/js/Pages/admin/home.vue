<template>
  <link rel="stylesheet" href="/assets/home_admin.css" />
  <div>
    <header class="header">
      <div class="logo">
        <Link :href="route('admin.dashboard')">
          <img src="/assets/img/logo.png" alt="Logo" />
        </Link>
      </div>
      <div class="header_profile">
        <img src="/assets/img/profile_picture.png" alt="Jester Pastor" class="profile-pic" />
      </div>
    </header>

    <div class="container">
      <Sidebar />

      <main class="content">
        <h1>Admin Home</h1>
        
      </main>
    </div>

    <footer>
      <p>&copy; 2024 All Rights Reserved by BSICT 3B1</p>
    </footer>
  </div>
</template>

<script>
import Sidebar from '@/Components/Sidebar.vue';
import { Link } from '@inertiajs/vue3';

export default {
  components: { Sidebar, Link }
};
</script>

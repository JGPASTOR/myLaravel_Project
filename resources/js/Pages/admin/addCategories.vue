<template>
    <link rel="stylesheet" href="/assets/addcategories.css" />
    <div>
      <header class="header">
        <div class="logo">
          <Link :href="route('Home')">
            <img src="/assets/img/logo.png" alt="Servify Logo" />
          </Link>
        </div>
        <div class="header_profile">
          <img src="/assets/img/profile.png" alt="Jester Pastor" class="profile-pic" />
        </div>
      </header>

      <div class="container">
  
          <Sidebar />
        <div class="main-content">
          <div class="form-container">
            <h2>Add Categories</h2>
            <form @submit.prevent="addCategory">
              <label for="firstName">Service Categories</label>
              <input
                type="text"
                id="firstName"
                v-model="category.name"
                placeholder="Enter category name"
                required
              />
  
              <label for="description">Description field</label>
              <input
                type="text"
                id="description"
                v-model="category.description"
                placeholder="Enter description"
                required
              />
  
              <button type="submit" class="add-button">Add</button>
            </form>
          </div>
        </div>
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
    components: {
      Sidebar,
      Link,
    },
    data() {
      return {
        category: {
          name: "",
          description: "",
        },
      };
    },
    methods: {
      addCategory() {
        console.log("Adding category:", this.category);
        this.category = { name: "", description: "" };
      },
    },
  };
  </script>
  
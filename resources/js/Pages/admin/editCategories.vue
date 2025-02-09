<!-- <template>
    <link rel="stylesheet" href="/assets/editcategories.css"/>
    <div>
      <Sidebar />
      <header class="header">
        <div class="logo">
          <Link :href="route('Home')">
          <img src="img/logo.png" alt="Servify Logo" />
          </Link>
        </div>
        <div class="header_profile">
          <img src="profile.png" alt="Jester Pastor" class="profile-pic" />
        </div>
      </header>
  
      <div class="container">
        <aside class="sidebar">
          <div class="header_profile">
            <img src="profile.png" alt="Jester Pastor" class="profile-pic" />
            <p class="email">jpastor1@ssct.edu.ph</p>
          </div>
          <nav class="nav">
            <ul>
              <li><router-link to="/adminHome/home">Home</router-link></li>
              <li><router-link to="/userManagement/user">Clients</router-link></li>
              <li><router-link to="/serviceProvider/serviceprovider">Service Provider</router-link></li>
              <li><router-link to="/bookingManagement/booking">Bookings</router-link></li>
              <li><router-link to="/serviceCategories/service">Service Categories</router-link></li>
            </ul>
          </nav>
        </aside>
  
        <div class="main-content">
          <div class="form-container">
            <h2>Edit Categories</h2>
            <form @submit.prevent="editCategory">
              <label for="categoryName">Service Categories</label>
              <input
                type="text"
                id="categoryName"
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
  
              <button type="submit" class="edit-button">Edit</button>
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
  export default {
    data() {
      return {
        category: {
          name: "",
          description: "",
        },
      };
    },
    methods: {
      editCategory() {
        // Implement edit category logic here
        console.log("Editing category:", this.category);
        // Reset form fields after submission if needed
      },
    },
  };
  </script> -->
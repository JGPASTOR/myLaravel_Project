<!-- <template>
    <link rel="stylesheet" href="/assets/editsp.css"/>
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
            <h2>Edit Service Provider</h2>
            <form @submit.prevent="submitForm">
              <label for="firstName">First Name</label>
              <input v-model="firstName" type="text" id="firstName" placeholder="Enter first name" />
  
              <label for="lastName">Last Name</label>
              <input v-model="lastName" type="text" id="lastName" placeholder="Enter last name" />
  
              <label for="username">User Name</label>
              <input v-model="username" type="text" id="username" placeholder="Enter username" />
  
              <button type="submit" class="edit-button">Edit</button>
            </form>
          </div>
          <div>
            <img src="service.png" alt="Service Provider Image" class="main-image" />
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
        firstName: '',
        lastName: '',
        username: '',
      };
    },
    methods: {
      submitForm() {
  
        console.log("Form submitted with:", this.firstName, this.lastName, this.username);
      },
    },
  };
  </script> -->
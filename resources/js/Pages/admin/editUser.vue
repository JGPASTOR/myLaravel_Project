<!-- <template>
    <link rel="stylesheet" href="/assets/home.css"/>
      <div>
        <Sidebar />
        <div class="header">
          <div class="logo">
            <router-link to="/adminHome/home">
              <img src="/img/logo.png" alt="Servify Logo" />
            </router-link>
          </div>
          <div class="header_profile">
            <img src="/img/profile_picture.png" alt="Jester Pastor" class="profile-pic" />
          </div>
        </div>
    
        <div class="container">
        <Sidebar />
    
          <main class="content">
  
            <h1>Admin Home Dashboard</h1>
            <section class="stats">
              <div v-for="(stat, index) in stats" :key="index" class="stat-box">
                <p class="number">{{ stat.number }}</p>
                <p class="label">{{ stat.label }}</p>
              </div>
            </section>
          </main>
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
        stats: [
          { number: 2, label: "Total Users" },
          { number: 5, label: "Total Service Providers" },
          { number: 5, label: "Categories" },
          { number: 10, label: "Services" }
        ]
      };
    },
    methods: {
      fetchStats() {
        this.stats = [
          { number: 3, label: "Total Users" },
          { number: 6, label: "Total Service Providers" },
          { number: 6, label: "Categories" },
          { number: 12, label: "Services" }
        ];
      }
    },
    created() {
    
      this.fetchStats();
    }
  };
  </script>
  
   -->
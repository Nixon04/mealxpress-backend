<template>
    <div>
      <!-- Desktop Navbar -->
      <div class="desktop-navbar" v-if="!isMobile">
        <nav class="navbar">
          <ul class="nav-list">
            <li class="nav-item" v-for="item in navItems" :key="item.text">
              <a href="#">{{ item.text }}</a>
            </li>
          </ul>
        </nav>
      </div>
  
      <!-- Mobile Navbar with Hamburger -->
      <div class="mobile-navbar" v-else>
        <button class="hamburger" @click="toggleMenu">
          ☰
        </button>
        <div class="mobile-menu" v-if="menuVisible">
          <ul class="nav-list">
            <li class="nav-item" v-for="item in navItems" :key="item.text">
              <a href="#">{{ item.text }}</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
  watch: {
  },
    data() {
      return {
        isMobile: false,
        menuVisible: false,
        navItems: [
          { text: "Home" },
          { text: "About" },
          { text: "Services" },
          { text: "Contact" },
        ],
      };
    },
    mounted() {
      // Check the screen size on initial load
      this.checkScreenSize();
      // Listen for window resize event to handle screen size changes
      window.addEventListener("resize", this.checkScreenSize);
    },
    beforeDestroy() {
      window.removeEventListener("resize", this.checkScreenSize);
    },
    methods: {
      checkScreenSize() {
        // Update `isMobile` based on window width
        this.isMobile = window.innerWidth < 768;
      },
      toggleMenu() {
        // Toggle visibility of the mobile menu
        this.menuVisible = !this.menuVisible;
      },
    },
  };
  </script>
  
  <style scoped>
  /* General Styles */
body {
    font-family: Arial, sans-serif;
  }
  
  /* Desktop Navbar */
  .desktop-navbar {
    display: flex;
    justify-content: center;
    background-color: #333;
  }
  
  .navbar {
    display: flex;
  }
  
  .nav-list {
    display: flex;
    padding: 0;
    margin: 0;
  }
  

  @media (max-width:768px) {
    .nav-list{
        display: flex;
        flex-direction: column;
    }
    .desktop-navbar {
        display: flex;
        justify-content: center;
        background-color: #12ebb1!important;
      }
      
  }
  
  .nav-item {
    list-style-type: none;
    margin: 0 20px;
  }
  
  .nav-item a {
    color: white;
    text-decoration: none;
    padding: 10px;
  }
  
  .nav-item a:hover {
    background-color: #575757;
  }
  
  /* Mobile Navbar */
  .mobile-navbar {
    display: block; /* Ensure mobile navbar is available */
  }
  
  /* Hamburger Button */
  .hamburger {
    font-size: 30px;
    color: #333;
    background-color: transparent;
    border: none;
    padding: 10px;
    cursor: pointer;
  }
  
  /* Mobile Menu */
  .mobile-menu {
    display: none; /* Hide mobile menu by default */
  }
  
  .mobile-menu ul {
    padding: 0;
    margin: 0;
    list-style-type: none;
  }
  
  .mobile-menu .nav-item {
    padding: 10px;
  }
  
  .mobile-menu .nav-item a {
    color: #333;
    text-decoration: none;
    display: block;
  }
  
  /* Show mobile menu when it's visible */
  .mobile-navbar .mobile-menu {
    display: block;
  }
  
</style>  
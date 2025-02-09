<script setup>
import { onMounted, onBeforeUnmount } from 'vue';  // Import the lifecycle hooks
import '../assets/css/navnew.css';
import { useRefNav } from '../yreact/navstate';
import { storeToRefs } from 'pinia';
import { Link } from '@inertiajs/inertia-vue3';

// Access store state and methods
const navbarcheck = useRefNav();
const { navItems, isVisible, navbarHeight, topPosition, backgroundColor, backdropFilter, boxShadow, color } = storeToRefs(navbarcheck);
const { toggle, handleScroll } = navbarcheck;
const landingimages = (filename) => `https://mealxpress.ng/landingimages/${filename}`;

// Watch for scroll events
onMounted(() => {
  window.addEventListener('scroll', handleScroll);
});

onBeforeUnmount(() => {
  window.removeEventListener('scroll', handleScroll);
});



</script>


<template>
  <div class="navbar-design-container" :style="{ backgroundColor: backgroundColor, boxShadow: boxShadow, transition: 'top 0.3s ease, background-color 0.3s ease, backdrop-filter 0.3s ease' }">
    <div class="navdex" :style="{ top: `${topPosition}px` }">
     <Link href="/">
      <div class="navnewlogo v-flex gap-2 mm">
        <img :src="landingimages('logo.png')" width="30" height="40" alt="">
      </div>
    </Link>

      <div class="navnewcontents">
        <ul class="navnew-dex">
          <li v-for="(item, index) in navItems" :key="index">
            <Link :href="item.linkid" preserve-state>{{ item.name }}</Link>
          </li>
        </ul>
      </div>
      
      <div class="navnewextra">
        <span class="desktopscene">Eatery</span>
        <span class="mobilescene text-white" @click="toggle"> ☰</span>
      </div>
    </div>

    <div class="newmobile" v-if="isVisible">
      <div class="newmobilelaps">
        <li v-for="(item, index) in navItems" :key="index">
          <Link :href="item.linkid" preserve-state>{{ item.name }}</Link>
        </li>
      </div>
    </div>
  </div>
</template>

<style scoped>
/* Basic styling for navbar */
.navbar-design-container {
  position: fixed;
  width: 100%;
  top: 0;
  left: 0;
  z-index: 1000;
}

.navdex {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px 20px;
}

.navnewlogo {
  font-size: 24px;
  font-weight: bold;
}

.navnewcontents ul {
  display: flex;
  list-style: none;
}

.navnew-dex li {
  margin-right: 20px;
}

.navnewextra {
  display: flex;
  align-items: center;
}

.desktopscene {
  display: block;
}

.mobilescene {
  display: none;
  cursor: pointer;
  font-size: 30px;
}

/* Mobile menu styles */
.newmobile {
  display: none;
}

.newmobilelaps ul {
  list-style: none;
  padding: 0;
}

.newmobilelaps li {
  padding: 10px;
}

@media (max-width: 991px) {
  .newmobile {
    display: block;
  }
  .mobilescene{
    display: block;
  }
  .desktopscene{
    display: none;
  }
  
}
</style>

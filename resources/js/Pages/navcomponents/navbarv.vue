<template>
    <div class="bg-height-resolv">
    <div class="bg-navbarcontainer-v" :style="navigationstyle">
        <div class="bg-navbarflex">
                <div class="bg-navbarlogo v-flex">
                    <span>Mealxpress</span>
                </div>
                <div class="v-flex v-navbarcontents-container">
                    <ul class="v-listmodel">
                        <li class="v-listmodel-links" :style="colorbond">Products</li>
                        <li class="v-listmodel-links" :style="colorbond">Solutions</li>
                        <li class="v-listmodel-links" :style="colorbond">Use Cases</li>
                        <li class="v-listmodel-links" :style="colorbond">Pricing</li>
                        <li class="v-listmodel-links" :style="colorbond">Company</li>
                    </ul>
                </div>
                <div class="v-flex">
                    <span>View Store</span>
                </div>
        </div>
    </div>
    </div>
</template>
<script>
import '../assets/css/newlanding.css';
export default{
  data () {
    return {
      topPosition: 0, // initial position of the nav
      backgroundColor: '#2D2942', // default background color
      backdropBlur: 'blur(0px)', // initial backdrop blur
      backdropFilter: 'blur(0px)', // initial backdrop filter
      boxShadow: '0 0 0 rgba(255, 255, 255, 0)', // initial box-shadow
      color: '#fff',
    }
  },
  computed:{
    colorbond(){
        return {
            color: this.color,
        }
    },
    navigationstyle(){
    return{
        top: `${this.topPosition}px`,
        backgroundColor: this.backgroundColor,
        backdropFilter: this.backdropFilter,
        webkitBackdropFilter: this.backdropFilter, // for WebKit browsers
        boxShadow: this.boxShadow,
        border: '1px solid rgba(255, 255, 255, 0)', // Transparent border for aesthetics
        transition: 'top 0.3s ease, background-color 0.3s ease, backdrop-filter 0.3s ease, box-shadow 0.3s ease', // smooth transitions
      };
  },
  },
  methods: {
        handleScroll() {
      const scrollPosition = window.scrollY;
      if (scrollPosition > 100) { // Change on scroll
        this.topPosition = 0; // Move the nav body down
        this.backgroundColor = 'rgba(255, 255, 255, 0.54)!important'; // Increase transparency for glassmorphism
        this.backdropBlur = 'blur(45px)'; // Apply blur
        this.backdropFilter = 'blur(7.9px)'; // Apply blur
        this.boxShadow = '0 4px 30px rgba(0, 0, 0, 0.1)'; // Apply shadow
        this.color = "#2D2942";
      } else {
        this.topPosition = 0; // Reset top position
        this.backgroundColor = '#2D2942'; // Default color (or light color for dark mode)
        this.backdropBlur = 'blur(45px)'; // Remove blur
        this.backdropFilter = 'blur(0px)'; // Remove blur
        this.boxShadow = '0 0 0 rgba(255, 255, 255, 0)'; // Remove shadow
        this.color = "#fff";
      }
    },
    },
    mounted() {
    window.addEventListener('scroll', this.handleScroll);

  },
  beforeDestroy() {
    window.removeEventListener('scroll', this.handleScroll);
  },
 
}
</script>

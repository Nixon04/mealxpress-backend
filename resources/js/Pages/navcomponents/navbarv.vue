<template>
    <div class="bg-height-resolv">
    <div class="bg-navbarcontainer-v" :style="navigationstyle">
        <div class="bg-navbarflex">
                <div class="bg-navbarlogo v-flex">
                   <Link href="/newhome">
                    <img :src="LandingImages('logo.png')" width="30" height="30" alt="">
                  </Link>
                </div>  
                <div class="v-flex v-navbarcontents-container">
                    <ul class="v-listmodel">
                      <Link href="/about" preserve-state preserve-scroll>
                        <li class="v-listmodel-links" :style="colorbond">Products</li>
                      </Link>
                      <Link href="/occupations/drivers" preserve-state preserve-scroll>
                        <li class="v-listmodel-links" :style="colorbond">Drivers</li>
                      </Link>
                      <Link href="/occupations/vendors" preserve-state preserve-scroll>
                        <li class="v-listmodel-links" :style="colorbond">Vendors</li>
                      </Link>
                      <Link href="/support/faqs" preserve-state preserve-scroll >
                        <li class="v-listmodel-links" :style="colorbond">Faqs</li>
                      </Link>
                      <Link href="/support/contact" preserve-state preserve-scroll>
                        <li class="v-listmodel-links" :style="colorbond">Contact</li>
                      </Link>
                       
                    </ul>
                </div>
                <div class="v-flex" @click="NavOpen"
                 style="z-index: 1000; position: relative; cursor:pointer">
                  <i class="fas fa-bars fs-2 text-white"></i>           
               </div>
        </div>
    </div>
    </div>
</template>
<script>
import { Link } from '@inertiajs/inertia-vue3';
import '../assets/css/newlanding.css';

export default{
  components:{
    Link,
  },
  data () {
    return {
      isvisible: false,
      height: '0', // default height
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
       height: this.navbarHeight,
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

    NavOpen() {
      this.navbarHeight = this.navbarHeight === '100vh' ? '30vh' : '100vh'; // Change height on click
    }, 
        LandingImages(filename){
        return `http://192.168.89.149:9000/landingimages/${filename}`;
       },

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

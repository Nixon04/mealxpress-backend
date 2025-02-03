<template>
    <div class="p-6 bg-navigation-body" :style="navigationStyle">
        <nav class="d-flex justify-content-between">
            <Link href="/">
            <ul class="flex flex-direction-row gap-3">
                <li class="menu-link text-white fw-bold">
                    <img src="../../../../../public/landingimages/logo.png"   class="img-logo-mealxpress"/>
                    <span :style="colorbond">MealXpress</span></li>
            </ul>
        </Link>
            <div class="gap-2 bg-center-headers bg-navigation-content" >
                <ul>
                    <li class="menu-link gap-2 bg-navigation-flex">
                        <Link href="/about" class="menu-link bg-footer-link fw-bold" :style="colorbond">
                            About
                        </Link>
                        <Link href="/privacy" class="menu-link bg-footer-link fw-bold">
                             <span :style="colorbond">privacy</span>
                        </Link>
                        <Link href="/contact" class="menu-link bg-footer-link fw-bold">
                           <span :style="colorbond"> Contact</span>
                        </Link>
                    </li>
                </ul>
            </div>
            <div class="d">
                <Link href="/" class="py-3 w-20 c-colorbody "></Link>
            </div>
        </nav>          
    </div>
</template>

<script>
import {Link} from '@inertiajs/vue3';
export default {
    name: 'NavigationOnline',
    
    components:{
        Link,
    },
    data(){
      return {
      topPosition: 10, // initial position of the nav
      backgroundColor: 'transparent', // default background color
      backdropBlur: 'blur(0px)', // initial backdrop blur
      backdropFilter: 'blur(0px)', // initial backdrop filter
      boxShadow: '0 0 0 rgba(255, 255, 255, 0)', // initial box-shadow
      color: '#fff!important',
      };
    },
    computed:{
        colorbond(){
            return {
                color: this.color,
            }
        },
      navigationStyle(){
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
        this.backgroundColor = 'rgba(255, 255, 255, 0.54)'; // Increase transparency for glassmorphism
        this.backdropBlur = 'blur(45px)'; // Apply blur
        this.backdropFilter = 'blur(7.9px)'; // Apply blur
        this.boxShadow = '0 4px 30px rgba(0, 0, 0, 0.1)'; // Apply shadow
        this.color = "#2D2942";
      } else {
        this.topPosition = 0; // Reset top position
        this.backgroundColor = 'transparent'; // Default color (or light color for dark mode)
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


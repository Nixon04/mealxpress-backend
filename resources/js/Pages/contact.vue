<template>
  <Head>
    <title>Mealxpress | About Us </title>
    <meta name="description" content="Discover extreme cheap services on our plattform, Order foods at your home and get it delivered right at your home with no hassle whatsoever, mealxpress is here to stay">
   <link rel="icon" :href="getImageUrl('logo.png')" type="image/*" width="4">
  </Head>
  <div data-aos="zoom-out" data-aos-easing="ease-in-out" data-aos-duration="1000">
    <MainIndex/>
   


    <section class="h-auto bg-corevalues py-5 position-relative top-20">
      <img src="../../../public/landingimages/mx.png" class="pos-first" alt="">
      <img src="../../../public/landingimages/mx.png" class="pos-second" alt="">
      <section class="mealxpress-custompackages">
        <div class="c-header flex-column align-items-center">
          <h1 data-aos="fade-up" data-aos-duration="2000" class="c-colorbody mb-5">Get  <span class="c-italia">Help</span>
          On the Spot
          </h1>
          <div class="d-flex" data-aos="fade-up" data-aos-duration="1000">
            <h1 class="fs-6 text-center">We are more than happy to evaluate your request and give the best.</h1>
          </div>
        </div>
  
      <div class="bg-container-all mb-5">
        <div class="d-flex flex-wrap gap-2 p-3 mb-4">
         <div class="flex-info-left flex-column h-padding-state flex-info-background position-relative" data-aos="fade-up" data-aos-duration="2000">
          <h1 class="fs-1 fw-bold c-colorbody mb-1 py-3 ">Email ReachOut</h1>
            <div class="bg-content-fillable">
              <h4 class="c-colorbody mb-3 text-spacing">For more detailed inquiries or to report an issue, reach out via email. Our team is committed to providing solutions promptly.</h4>
            </div>
            <div class="bg-pad py-3 position-absolute bottom-0">
              <a href="mailto:info@mealxpress.ng" class="cursor-pointer">
                <div class="bg-button-submit text-center rounded-xl py-3" style="width: 150px;">
                  <span class="text-white">Email Us Now</span>
                </div>
              </a>
            </div>
         </div>
         <!-- flex right -->
         <div class="flex-info-right flex-info-background h-padding-state position-relative flex-column" data-aos="fade-up" data-aos-duration="2000">
          <h1 class="fs-1 fw-bold c-colorbody mb-1 py-3 ">Customers ReachOut</h1>
          <div class="bg-content-fillable">
            <h4 class="c-colorbody mb-3 text-spacing">Have issues to report about our staffs or products you intend or situation that may help us better?</h4>
          </div>
          <div class="bg-pad py-3 position-absolute bottom-0">
            <a href="https://wa.me/+2349068225050" target="_blank" class="cursor-pointer">
              <div class="bg-button-submit text-center rounded-xl py-3" style="width: 150px;">
                <span class="text-white">Visit Forum</span>
              </div>
            </a>
          </div>
         </div>
        </div>
      </div>
  
  </section>



    </section>
    <section class="h-auto p-4 bg-info-background " data-aos="fade-up" data-aos-duration="2000">
      <div class="d-flex justify-content-end px-3">
        <div class="bg-white py-3 rounded-xl p-2 my-4">
          <h1 class="c-colorbody fw-bold">Co Values</h1>
        </div>
        </div>

        <div class="bg-corevalues">
         <div class="d-flex flex-wrap">
          <div class="flex-left-state h-auto bg-transparent" data-aos="fade-left" data-aos-anchor-placement="center-center">
            <h1 class="bg-f-1 fw-bold c-colorbody mb-4 ">
              Set up, sell & scale with Quick Shop, it's that easy!
            </h1>
            <h6 class="fw-bold fs-4">
              We make it effortless for you to create an online store, sell to a vast customer base,
               seamlessly accept payments from all corners of the globe, and grow your business.
            </h6>
          </div>

           <div class="flex-right-state h-lv bg-transparent h-auto" data-aos="fade-right">
            <img src="../../../public/landingimages/corevalues.png" class="img-fluid" alt="">
           </div>

         </div>
        </div>
    </section>

    

 <HookStage/>



    

  <Footer/>


  </div>
</template>


<script>
import MainIndex from "./components/frontend_comp/navigation_bar.vue";
import Footer from './components/frontend_comp/footer.vue';
import HookStage from './components/frontend_comp/hookstage.vue';
import { Link } from "@inertiajs/inertia-vue3";
import { Head } from "@inertiajs/vue3";
import { Vue3Marquee } from "vue3-marquee";
import AOS from 'aos';
import 'aos/dist/aos.css'; 

import "./assets/mealxpresscustom/landingapp.css";

AOS.init();

export default {
  name: "Example",
  components: {
    MainIndex,
    HookStage,
    Link,
    Head,
    Vue3Marquee,
    Footer,
  },
  data() {
    return {
      imagesarray: [
      "http://127.0.0.1:9000/landingimages/delivery1.png",
      "http://127.0.0.1:9000/landingimages/delivery2.png",
      "http://127.0.0.1:9000/landingimages/delivery3.png",
      "http://127.0.0.1:9000/landingimages/delivery4.png",
    ],
      items: ["For Vendors  ", "Couriers", "Consumers(You)"],
      // Track the selected item by index
      selectedItem: null,
    };
  },
  computed: {
    // Display content based on the selected item
    selectedItemContent() {
      if (this.selectedItem !== null) {
        return `Content for ${this.items[this.selectedItem]}`;
      }
      return 'Select an eatery to view details.';
    },
  },
  methods: {
    selectItem(index) {
      this.selectedItem = index;
    },
    getImageUrl(filename) {
    return `/landingimages/${filename}`;
  },

     getGeneralImages(filename){
      return `/landingimages/${filename}`;
     },
  beforeEnter(el) {
      el.style.opacity = 0;
    },
    enter(el, done) {
      // Trigger the transition (fade in)
      el.offsetHeight; // trigger reflow
      el.style.transition = "opacity 0.5s ease";
      el.style.opacity = 1;
      done();
    },
    leave(el, done) {
      // Trigger the transition (fade out)
      el.style.transition = "opacity 0.5s ease";
      el.style.opacity = 0;
      done();
    },
  },
};
</script>
<style scoped>
.highlight {
  color: #ff6347; /* Highlight color (e.g., tomato red) */
  font-weight: normal;
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s ease;
}

.fade-enter, .fade-leave-to /* .fade-leave-active in <2.1.8 */ {
  opacity: 0;
}
</style>
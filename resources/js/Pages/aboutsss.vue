<template>
    <Head>
      <title>Mealxpress | About Us </title>
      <meta name="description" content="Discover extreme cheap services on our plattform, Order foods at your home and get it delivered right at your home with no hassle whatsoever, mealxpress is here to stay">
     <link rel="icon" :href="getImageUrl('logo.png')" type="image/*" width="4">
    </Head>
      <MainIndex  class="mb-5"/>
      <section class="hero-section-heade h-auto mb-2 py-40 bg-white">
        <div class="hero-section-container bg-white ">
          <div class="d-flex flex-wrap mb-4 gap-2">
            <div class="flex-right-state flex-2 mb-4 h-auto 
             flex-info-background  bg-white h-bigge position-relative w-auto">
             <div class="p-3 m-1 w-100 d-flex flex-column flex-info-background h-bigger rounded-xl">
               <div class="d-flex flex-column flex-5 w-100">
                  <h1 class="fw-bold text-uppercase mb-5 px-3 text-muted">About Us</h1>
                  <h1 class="c-colorbody bg-f-1 fw-bold px-3">Mealxpress, Reaching out to you on Time</h1>
               </div>

               <div class="mb-4 position-absolute bottom-0">
                <div class="d-flex px-1" style="bottom:20px">
                  <Vue3Marquee :pause-on-hover="true" class="ms-2">
                    <img v-for="(image, index) in imagesarray" :key="index" :src="image" class="me-2 rounded-lg mb-5" style="height:300px!important; width:300px"/>
                  </Vue3Marquee>
                </div>
               </div>

             </div>
          
            </div>

            <div class="flex-left-state py-5 position-relative bg-main-background rounded-xl h-auto p-4 flex-1 mb-3" data-aos="fade-right" data-aos-duration="3000" >
              <div class="shadow-none ">
               <h1 class="text-white bg-f-1 fw-bold  mb-4 py-3 ">
                 The Building Blocks to grow your business
               </h1>
               <h4 class="text-white fw-bold letter-spacing mb-5">We have put together the solutions to grow your business from a startup to a global enterprise. Establish your business with these solutions and services.</h4>
                 <div class="bg-button-submit-secondary cursor-pointer py-4 w-30 text-center rounded-xl mb-4">
                 <span>Get Started</span>
                 </div>
              </div>
             </div> 



          </div>
        </div>
      </section>

      <section class="h-auto bg-corevalues py-5 position-relative">
        <img src="../../../public/landingimages/mx.png" class="pos-first" alt="">
        <img src="../../../public/landingimages/mx.png" class="pos-second" alt="">
        <section class="mealxpress-custompackages">
          <div class="c-header flex-column align-items-center">
            <h1 data-aos="fade-up" data-aos-duration="2000" class="c-colorbody mb-5">Mission <span class="c-italia">Visions & Work ethics</span>
            from us
            </h1>
            <div class="d-flex" data-aos="fade-up" data-aos-duration="1000">
              <h1 class="fs-6 text-center">Getting the best out of yourself to satisfy your edge of taste.</h1>
            </div>
          </div>
   
    
        <div class="bg-container-all ">
          <div class="d-flex flex-wrap gap-2 p-3">
           <div class="flex-info-left flex-column flex-info-background " data-aos="fade-up" data-aos-duration="2000">
            <h1 class="fs-1 fw-bold c-colorbody mb-1 py-3 ">Vision</h1>
            <img  :src="getGeneralImages('mealvision.png')"  class=" mb-5 w-50"/>
              <div class="bg-content-fillable">
                <h4 class="c-colorbody mb-3 text-spacing">Manage your funds efficiently with Payaza's instant payouts, keeping your business fluid and dynamic. With our innovative platform, you can effortlessly manage bulk and instant payouts to your recipients, saving time and streamlining your financial operations.</h4>
              </div>
    
              <div class="bg-pad py-3">
                <Link href="/" class="cursor-pointer">
                  <div class="bg-button-submit text-center rounded-xl py-3" style="width: 150px;">
                    <span class="text-white">Learn more</span>
                  </div>
                </Link>
              </div>
           </div>
           <!-- flex right -->
           <div class="flex-info-right flex-info-background flex-column" data-aos="fade-up" data-aos-duration="2000">
            <h1 class="fs-1 fw-bold c-colorbody mb-1 py-3">Work Ethics</h1>
            <img   :src="getGeneralImages('mealwork.png')"  class=" mb-5 w-50"/>
              <div class="bg-content-fillable">
                <h4 class="c-colorbody mb-3 text-spacing fw-normal">Manage your funds efficiently with Payaza's instant payouts, keeping your business fluid and dynamic. With our innovative platform, you can effortlessly manage bulk and instant payouts to your recipients, saving time and streamlining your financial operations.</h4>
              </div>
              <div class="bg-pad py-3">
                <Link href="/" class="cursor-pointer">
                <div class="bg-button-submit text-center rounded-xl py-3" style="width: 150px;">
                  <span class="text-white">Learn more</span>
                </div>
              </Link>
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
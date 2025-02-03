<template>
    <Head>
      <title>Mealxpress | Rich in content, Deliverying with no hassle </title>
      <meta name="description" content="Discover extreme cheap services on our plattform, Order foods at your home and get it delivered right at your home with no hassle whatsoever, mealxpress is here to stay">
     <link rel="icon" :href="getImageUrl('logo.png')" type="image/*" width="4">
    </Head>
    <div>
      <MainIndex />
      <section class="hero-section-header bg-main-color">
        <div class="hero-section-container">
          <div class="d-flex flex-column text-center bg-flex-medium mb-4">
            <h4 class="bg-bigger bg-big-header text-white mb-3">
              MealXpress<span class="bg-font-note bg-secondarycolor">.ng</span>
            </h4>
            <h6 class="text-white mb-5">
              order that food wey dey sweet you wella make we bring am for your
              doormot
            </h6>
            <Link href="/" class="infobuttonaction py-3"> Get Started</Link>
          </div>
        </div>
  
  
        <div class="card card-mutate-swig">
          <div class="flexwrap-container mb-4">
            <div class="flexleft">
              <div class="px-3">
                <div class="starter-align">
                  <h3 class="bg-largermeal fw-bold c-colorbody">Mealxpress Mobile App</h3>
                  <h6 class="bg-textsmaller">Download the app and get convenient service even better</h6>
                </div>
                  <div class="download-tag ms-4 mb-4">
                    <Link href="/" class="infobuttonaction py-3"> Android App</Link>
                  </div>
              </div>
            </div>
            <div class="flexright">
              <div class="px-3">
                <div class="d-flex justify-content-center">
                  <img :src="getImageUrl('stagereload.png')" alt="No Image" class="bg-dynamic-image">
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
  
  
      <section class="mealxpress-custompackages py-5 mb-12">
         <div class="c-container">
          <div class="c-header">
            <h1 class="c-colorbody">Boost <span class="c-italian">Revenue</span>
            using our suite of seamless & secure payment solution
            </h1>
          </div>
  
          <div class="bg-container-all">
            <div class="d-flex flex-wrap gap-2">
              <div class="flex-right flex-column position-relative bg-flexsecondary">
                <h1 class="text-white fs-3 mb-5">Branches</h1>
                <h1 class="text-white fs-2 mb-2 fw-bold">Multiple outlets, one payment dashboard</h1>
                <h1 class="text-white fs-7 mb-5">Doesn't matter where your business is located,
                   you can manage collections and settlements from a single dashboard</h1>
  
                   <div class="d-flex justify-content-between p-y-7 p-height-suit">
                    <div class="d-flex">
                     <div class="c-hover-card">
                      <span class="c-color">Getting the best of all we </span>
                     </div>
  
                     <div class="c-hover-card-second">
                      <span class="c-color">Getting the best of all we </span>
                     </div>
  
                    </div>
                    <!-- second phase -->
                    <div class="c-rounded-box">
                    <div class="bg-button-submit w-40 align-items-center 
                    justify-content-center d-flex rounded-xl cursor-pointer shadow-inner">
                      <span class="text-white">Get Started</span>
                      </div>
                    </div>
                   </div>
              </div>
              <div class="flex-left bg-flexprimary"></div>
            </div>
          </div>
         </div>
      </section>
      
  
      <section class="mealxpress-custompackages">
        <div class="c-header flex-column align-items-center">
          <h1 class="c-colorbody mb-5">See <span class="c-italia">Packages</span>
          from us
          </h1>
          <div class="d-flex">
            <h1 class="fs-6 text-center">Getting to work along with us a team enjoying exclusive discount working with us</h1>
          </div>
        </div>
  
       <div class="bg-container-all mb-0 p-0" style="margin-bottom:-50px!important;">
        <div class="d-flex flex-wrap gap-2 p-3  ">
         <div class="flex-info-left flex-column flex-info-background ">
          <h1 class="fs-3 fw-bold c-colorbody mb-1 py-3">Payout</h1>
          <img :src="getGeneralImages('fredkitchen.png')" alt="" class=" mb-5 w-50">
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
         <div class="flex-info-right flex-info-background flex-column">
          <h1 class="fs-3 fw-bold c-colorbody mb-1 py-1">Payout</h1>
          <video autoplay loop playsinline  :src="getGeneralImages('checkout.webm')"  class=" mb-5 w-50"/>
            <div class="bg-content-fillable">
              <h4 class="c-colorbody mb-3 text-spacing">Manage your funds efficiently with Payaza's instant payouts, keeping your business fluid and dynamic. With our innovative platform, you can effortlessly manage bulk and instant payouts to your recipients, saving time and streamlining your financial operations.</h4>
            </div>
            <div class="bg-pad py-1">
              <Link href="/" class="cursor-pointer">
                <div class="bg-button-submit text-center rounded-xl py-3" style="width: 150px;">
                  <span class="text-white">Learn more</span>
                </div>
              </Link>
            </div>
         </div>
        </div>
      </div>
  
      <div class="bg-container-all ">
        <div class="d-flex flex-wrap gap-2 p-3">
         <div class="flex-info-left flex-column flex-info-background ">
          <h1 class="fs-3 fw-bold c-colorbody mb-1 py-3">Payout</h1>
          <video autoplay loop playsinline  :src="getGeneralImages('checkout.webm')"  class=" mb-5 w-50"/>
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
         <div class="flex-info-right flex-info-background flex-column">
          <h1 class="fs-3 fw-bold c-colorbody mb-1 py-3">Payout</h1>
          <video autoplay loop playsinline  :src="getGeneralImages('checkout.webm')"  class=" mb-5 w-50"/>
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
  
  
      <!-- <section class="optionview">
        <div class="py-2">
          <div class="flexwrap-container">
            <div class="flexleftcontent">
              <div class="bg-px-space">
                <div class="header-topper mb-3">
                  <h1 class="fs-3">What's your favourite Delicacy</h1>
                  <span>We Make it easier for you to embed on any of our services</span>
                </div>
                <div class="d-flex flex-column">
                  <h1 
                    v-for="(item, index) in items" 
                    :key="index" 
                    class="fs-2 mb-3 cursor-pointer" 
                    :class="{ 'highlight': selectedItem === index }" 
                    @click="selectItem(index)"
                  >
                    {{ item }}
                  </h1>
                </div>
              </div>
            </div>
            <div class="flexrightcontent">
              <div class="px-3">
                <transition name="fade" @before-enter="beforeEnter" @enter="enter" @leave="leave">
                <div class="card bg-card-longivity">
                  <div v-if="selectedItem === 0 ||  selectedItem === null">
                    <div class="bg-px-space padding-top-motion">
                      <h1 class="fw-bold fs-1">For Vendors – Post, Manage, Sell</h1>
                      <h6 class="mb-3">
                        MealXpress makes it incredibly easy for vendors to showcase their culinary offerings. Whether you're a restaurant, a food stall, or a home-based business, our platform provides an intuitive interface where you can:
                      </h6>
                      <h1 class="mb-3">MealXpress makes it incredibly easy for vendors to showcase their culinary offerings. Whether you're a restaurant, a food stall, or a home-based business,
                         our platform provides an intuitive interface where you can:</h1>
  
                         <ul class="d-flex flex-column justify-start">
                          <li>
                            Post Meals: List your delicious meals with descriptions, prices, and images in just a few clicks.
                          </li>
                         </ul>
                         <div class="d-flex justify-content-center py-4">
                          <img :src="getImageUrl('marketbucklist.png')" alt="" class="img-contain">
                         </div>
                    </div>
                  </div>
  
                  <div v-if="selectedItem === 1" >
                    <div class="bg-px-space padding-top-motin">
                      <h1 class="fw-bold fs-1">Couriers</h1>
                      <h6 class="mb-3">
                        MealXpress makes it incredibly easy for vendors to showcase their culinary offerings. Whether you're a restaurant, a food stall, or a home-based business, our platform provides an intuitive interface where you can:
                      </h6>
                      <h1 class="mb-3">MealXpress makes it incredibly easy for vendors to showcase their culinary offerings. Whether you're a restaurant, a food stall, or a home-based business,
                         our platform provides an intuitive interface where you can:</h1>
  
                         <ul class="d-flex flex-column justify-start">
                          <li>
                            Post Meals: List your delicious meals with descriptions, prices, and images in just a few clicks.
                          </li>
                         </ul>
  
                         <div class="d-flex justify-content-center py-4">
                          <img :src="getImageUrl('couriers.png')" alt="" class="img-contain">
                         </div>
                    </div>
                  </div>
  
                  <div v-if="selectedItem === 2" >
                    <div class="bg-px-space padding-top-motion">
                      <h1 class="fw-bold fs-1">Consumers</h1>
                      <h6 class="mb-3">
                        MealXpress makes it incredibly easy for vendors to showcase their culinary offerings. Whether you're a restaurant, a food stall, or a home-based business, our platform provides an intuitive interface where you can:
                      </h6>
                      <h1 class="mb-3">MealXpress makes it incredibly easy for vendors to showcase their culinary offerings. Whether you're a restaurant, a food stall, or a home-based business,
                         our platform provides an intuitive interface where you can:</h1>
  
                         <ul class="d-flex flex-column justify-start">
                          <li>
                            Post Meals: List your delicious meals with descriptions, prices, and images in just a few clicks.
                          </li>
                         </ul>
                         <div class="d-flex justify-content-center py-4">
                          <img :src="getImageUrl('trackrecords.png')" alt="" class="img-contain">
                         </div>
                    </div>
                  </div>
                </div>
              </transition>
              </div>
            </div>
          </div>
        </div>
      </section> -->
    <Footer/>
  
  
    </div>
  </template>
  
  
  <script>
  import MainIndex from "../components/frontend_comp/navigation_bar.vue";
  import Footer from '../components/frontend_comp/footer.vue';
  import { Link } from "@inertiajs/inertia-vue3";
  import { Head } from "@inertiajs/vue3";
  
  import "../assets/mealxpresscustom/landingapp.css";
  
  export default {
    name: "Example",
    components: {
      MainIndex,
      Link,
      Head,
      Footer,
    },
    data() {
      return {
        // images: [
        //   "stagereload.png",
        //   "https://via.placeholder.com/400x300?text=Slide+1",
        //   "https://via.placeholder.com/400x300?text=Slide+2",
        //   "https://via.placeholder.com/400x300?text=Slide+3",
        // ],
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
        return `/mealxpress_storesprofile/${filename}`;
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
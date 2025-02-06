<script setup>
import NavBar from '../navcomponents/navbarv.vue';
import Footer from '../navcomponents/footer.vue';
import { Link } from '@inertiajs/inertia-vue3';
import { usePackageStore } from './supporthelper/changeindex';
import { storeToRefs } from 'pinia';
import Navbarv from '../navcomponents/navbarv.vue';


// Initialize the store inside setup
const packagestore = usePackageStore();
const { activeIndex, packages } = storeToRefs(packagestore);
const { changeIndex } = packagestore;

// Image methods
const getImages = (filename) => `/infosets/${filename}`;
const LandingImages = (filename) => `/landingimages/${filename}`;

defineProps({
    components:{
        Navbarv,
        Footer,
        Link,
    }
})
</script>

<template>
  <div>
    <NavBar />
    <section id="herosectionpage" class="v-herosectionbodyabout position-relative">
      <img :src="LandingImages('fruitsalads.png')" class="v-floating-left" alt="">
      <img :src="LandingImages('userstores.png')" class="v-floating-right" alt="">
      <div class="v-heroheadercompany">
        <span class="v-xtralargeabout-txt text-white text-center">Frequently asked questions.</span>
        <span class="text-white v-stralarge-txt">
          Welcome to Mealxpress FAQ Section
          Find answers to common questions about our payment solutions, services, and support. Our goal is to help you navigate Mealxpress platform with ease and confidence
        </span>
        <Link href="/" class="btn v-btnoutline"><span>Explore Opportunities</span></Link>
      </div>
    </section>

    <section id="herosectionpage2" class="v-herosectionbodymain">
      <div class="bg-circlebody1 position-absolute"></div>
      <div class="bg-circlebody2 position-absolute"></div>
      <div class="bg-circlebody3 position-absolute"></div>
      <div class="hero-paddingtop">
        <div class="d-flex justify-content-center mb-5">
          <div class="patch-circlebody"><span>Faqs</span></div>
        </div>

        <div class="v-col-cente">
          <div class="col-rate-column-twosides">
            <div class="v-column-bridge position-relative">
              <div class="bg-circlebody"></div>
              <div class="v-flex flex-column text-start v-bg-gridcard">
                <h6 class="text-main fs-6 mb-3">Need help immediately?</h6>

                    <a href="mailto:info@mealxpress.ng" class="rx-maildirect mb-4">
                        <span>Contact support</span>
                    </a>

       
                <h6 class="mb-4">
                    <h1 class="fs-1 fw-bold text-main text-main me-2 mb-3">Faqs About Mealxpress</h1>
                    <span>Swap through  👋</span>
                </h6>
                <div class="rx-card-light mb-3 position-relative">
                  <div class="rx-faqs-contents">
                    <div v-for="(item, index) in packages" :key="index"
                        :class="[ activeIndex === null && index === 0 ? 'rx-highlight' : (activeIndex === index ? 'rx-faqscard' : 'rx-highlight')]"
                        @click="changeIndex(index)">
                          <span>{{ item }}</span>
                        </div>
                  </div>
                </div>

                <div class="rx-card-light bg-cards-dismiss">
                  <div class="rx-cardcontainer-light">
                    <div class="rx-cardleft">
                      <h1 class="fs-1 fw-bold text-main">Our Couriers are up to Date</h1>
                    </div>
                    <div class="rx-cardright" data-aos="fade-top" data-aos-duration="3000">
                      <img :src="LandingImages('deliveryride.png')" class="rx-shape-box" alt="">
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="v-column-bridge v-rx-overcolor">
              <div class="v-flex flex-column v-bg-gridcard" data-aos="fade-left" data-aos-anchor-placement="center-bottom">
                <div class="rx-package-details" v-if="activeIndex == null &&  activeIndex == 0 ">
                    <h2 class="fs-1 text-white fw-bold mb-5 py-3">{{ packages[activeIndex] }}</h2>
                    <h4 class="rx-fix-large text-white">Chowdeck wallet is a safe feature on the app where you can put in money for later use.
                         The money in the Chowdeck wallet can be used to make payments for orders placed on the app.
                          When an order gets rejected due to various reasons, the payment made initially when the order was placed 
                        'automatically goes into your Chowdeck wallet which is accessible to make payments for future orders.</h4>
                  </div>
                  <div class="rx-package-details" v-else-if="activeIndex == 0 ">
                    <h2 class="fs-1 text-white fw-bold mb-5 py-3">{{ packages[activeIndex] }}</h2>
                    <h4 class="rx-fix-large text-white">Chowdeck wallet is a safe feature on the app where you can put in money for later use.
                         The money in the Chowdeck wallet can be used to make payments for orders placed on the app.
                          When an order gets rejected due to various reasons, the payment made initially when the order was placed 
                        'automatically goes into your Chowdeck wallet which is accessible to make payments for future orders.</h4>
                  </div>

                  <div class="rx-package-details" v-else-if="activeIndex == 1 ">
                    <h2 class="fs-1 text-white fw-bold mb-5 py-3">{{ packages[activeIndex] }}</h2>
                    <h4 class="rx-fix-large text-white">Chowdeck wallet is a safe feature on the app where you can put in money for later use.
                         The money in the Chowdeck wallet can be used to make payments for orders placed on the app.
                          When an order gets rejected due to various reasons, the payment made initially when the order was placed 
                        'automatically goes into your Chowdeck wallet which is accessible to make payments for future orders.</h4>
                  </div>

                  <div class="rx-package-details" v-else-if="activeIndex == 2 ">
                    <h2 class="fs-1 text-white fw-bold mb-5 py-3">{{ packages[activeIndex] }}</h2>
                    <h4 class="rx-fix-large text-white">Chowdeck wallet is a safe feature on the app where you can put in money for later use.
                         The money in the Chowdeck wallet can be used to make payments for orders placed on the app.
                          When an order gets rejected due to various reasons, the payment made initially when the order was placed 
                        'automatically goes into your Chowdeck wallet which is accessible to make payments for future orders.</h4>
                  </div>

                  <div class="rx-package-details" v-else-if="activeIndex == 3 ">
                    <h2 class="fs-1 text-white fw-bold mb-5 py-3">{{ packages[activeIndex] }}</h2>
                    <h4 class="rx-fix-large text-white">Chowdeck wallet is a safe feature on the app where you can put in money for later use.
                         The money in the Chowdeck wallet can be used to make payments for orders placed on the app.
                          When an order gets rejected due to various reasons, the payment made initially when the order was placed 
                        'automatically goes into your Chowdeck wallet which is accessible to make payments for future orders.</h4>
                  </div>

                  <div class="rx-package-details" v-else-if="activeIndex == 4 ">
                    <h2 class="fs-1 text-white fw-bold mb-5 py-3">{{ packages[activeIndex] }}</h2>
                    <h4 class="rx-fix-large text-white">Chowdeck wallet is a safe feature on the app where you can put in money for later use.
                         The money in the Chowdeck wallet can be used to make payments for orders placed on the app.
                          When an order gets rejected due to various reasons, the payment made initially when the order was placed 
                        'automatically goes into your Chowdeck wallet which is accessible to make payments for future orders.</h4>
                  </div>

              </div>
            </div>
            

          </div>
        </div>
      </div>
    </section>
    <Footer />
  </div>
</template>


<script setup>
import NavBar from '../navcomponents/navbarv.vue';
import Footer from '../navcomponents/footer.vue';
import { Link } from '@inertiajs/inertia-vue3';
import { usePackageStore } from './supporthelper/changeindex';
import { storeToRefs } from 'pinia';

// Initialize the store inside setup
const packagestore = usePackageStore();
const { activeIndex, packages } = storeToRefs(packagestore);
const { changeIndex } = packagestore;

// Image methods
const getImages = (filename) => `/infosets/${filename}`;
const LandingImages = (filename) => `/landingimages/${filename}`;
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
                <h1 class="fs-1 fw-bold text-main mb-3 text-main">Our Vision And Guidelines</h1>
                <h6 class="mb-4">
                  Lorem, ipsum dolor sit amet consectetur adipisicing elit. Deserunt ab sapiente est ipsa unde harum sit, dolor ullam provident quisquam aliquam tempora impedit corporis reiciendis odit pariatur iure vitae id?
                </h6>
                <div class="rx-card-light mb-3 position-relative">
                  <div class="rx-faqs-contents">
                    <div v-for="(item, index) in packages" :key="index"
                    :class="[ activeIndex == index ? 'rx-faqscard' :  'rx-highlight']"
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

            <div class="v-column-bridge">
              <div class="v-flex flex-column v-bg-gridcard" data-aos="fade-left" data-aos-anchor-placement="center-bottom">
                <div class="rx-package-details" v-if="activeIndex == null || activeIndex == 0 ">
                    <h2>{{ packages[activeIndex] }} Details</h2>
                     <h1>Why are we this good</h1>
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


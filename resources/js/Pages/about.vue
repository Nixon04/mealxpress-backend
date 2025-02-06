<template>
    <div>
        <NavBar/>
        <section id="herosectionpage" class="v-herosectionbodyabout position-relative">
              <div class="v-heroheadercompany">
                   <span class="v-xtralargeabout-txt text-white text-center">Mission, Vision & Opportunities</span>
                      <span class=" text-white v-stralarge-txt">Make real impact, grow your skills, and contribute to meaningful projects that shape the fintech industry.</span>
                       <Link href="/" class="btn v-btnoutline">
                      <span>Explore Opportunites</span>
                  </Link>
               </div>
       </section>


     <section id="herosectionpage2" class="v-herosectionbodymain ">
        <div class="bg-circlebody1 position-absolute"></div>
        <div class="bg-circlebody2 position-absolute"></div>
        <div class="bg-circlebody3 position-absolute"></div>
        <div class="hero-paddingtop">
            <div class="d-flex justify-content-center">
                <div class="patch-circlebody">
                    <span>About</span>
                </div>
            </div>
            <div class="hero-contentpad">
                <h1 class="v-large-text text-center">Vendors are the backbond of our products</h1>
            </div>
        <div class="v-col-cente">
            <div class="col-rate-column-twosides">

                <div class="v-column-bridge position-relative">
                    <div class="bg-circlebody"></div>
                    <div class="v-flex flex-column text-start v-bg-gridcard">
                        <div class="bg-icon-body1">
                            <i class="fas fa-home"></i>
                          </div>
                          <div class="d-flex flex-column">
                            <h1 class="fs-1  fw-bold text-main mb-3 text-main">Our Vision And Guidelines</h1>
                            <h6 class="mb-4">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Deserunt ab sapiente est ipsa unde harum sit, dolor ullam provident quisquam aliquam tempora impedit corporis reiciendis odit pariatur iure vitae id?</h6>
                                <div class="rx-card-light mb-3 position-relative">
                                    <div class="rx-cardcontainer-light">
                                        <div class="rx-cardleft">
                                          <h1 class="fs-1 fw-bold text-main">Get Fast Delivery on Time</h1>
                                        </div>
                                        <div class="rx-cardright">
                                            <img :src="LandingImages('clockrecord.png')" class="rx-shape-box"  alt="">
                                        </div>
                                    </div>
                             
                                </div> 

                            <div class="rx-card-light">
                                <div class="rx-cardcontainer-light">
                                    <div class="rx-cardleft">
                                      <h1 class="fs-1 fw-bold text-main">Our Couriers are upto Date</h1>
                                    </div>
                                    <div class="rx-cardright" data-aos="fade-top" data-aos-duration="3000">
                                        <img :src="LandingImages('deliveryride.png')" class="rx-shape-box"  alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="v-column-bridge">
                    <div class="v-flex flex-column v-bg-gridcard" data-aos="fade-left" data-aos-anchor-placement="center-bottom">
                       <img :src="LandingImages('stagereload.png')" alt="">
                    </div>
                </div>

            </div>
        </div>
     </div>
 </section>


       <section id="herosectionpage2" class="v-herosectionbodymain ">
        <div class="bg-circlebody1 position-absolute"></div>
        <div class="bg-circlebody2 position-absolute"></div>
        <div class="bg-circlebody3 position-absolute"></div>
        <div class="hero-paddingtop">
            <div class="d-flex justify-content-center">
                <div class="patch-circlebody">
                    <span>What We Do</span>
                </div>
            </div>
            <div class="hero-contentpad d-flex flex-column">
                <h1 class="v-large-text text-center">What We Do At Mealxpress.ng</h1>
            </div>
        <div class="v-col-cente">
            <div class="col-rate-column-twosides">

                <div class="v-column-bridge position-relative">
                    <div class="bg-circlebody"></div>
                    <div class="v-flex flex-column text-start v-bg-gridcard">
                          <div class="d-flex flex-column">
                            <h1 class="fs-1  fw-bold text-main mb-3 text-main">Join Mealxpress Today 🚀</h1>
                            <h4 class="mb-4">
                                We are at the forefront of the Fintech industry, revolutionising international payments and financial solutions
                            </h4>

                            <h4 class="mb-4">
                                We specialise in simplifying international payments, offering developer-friendly APIs and SDKs for seamless integration, optimising settlements, collections, and delivering versatile payout solutions. We are dedicated to shaping the future of global finance through innovation, efficiency, and excellence.
                            </h4>
                                <div class="rx-card-light mb-3 position-relative">
                                    <div class="rx-cardcontainer-light">
                                        <div class="rx-cardleft">
                                          <h1 class="fs-1 fw-bold text-main">Becoming A Vendor With Us Today</h1>
                                        </div>
                                        <div class="rx-cardright">
                                            <img :src="LandingImages('vendorstores.png')" class="rx-shape-box"  alt="">
                                        </div>
                                    </div>
                             
                                </div> 

                            <div class="rx-card-light">
                                <div class="rx-cardcontainer-light">
                                    <div class="rx-cardleft">
                                      <h1 class="fs-1 fw-bold text-main">Be A Courier With Mealxpress.ng</h1>
                                    </div>
                                    <div class="rx-cardright" data-aos="fade-top" data-aos-duration="3000">
                                        <img :src="LandingImages('deliveryride.png')" class="rx-shape-box"  alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="v-column-bridge">
                    <div class="v-flex flex-column v-bg-gridcard" data-aos="fade-left" data-aos-anchor-placement="center-bottom">
                       <img :src="LandingImages('userinfochecker.png')" alt="">
                    </div>
                </div>

            </div>
        </div>
     </div>
 </section>

<Footer/>

 

    </div>
</template>

<script>
import NavBar from './navcomponents/navbarv.vue';
import {Link} from '@inertiajs/inertia-vue3';
import './assets/css/newlanding.css';
import './assets/css/vmedia.css';
import './assets/css/stageindex.css';
import  Footer from './navcomponents/footer.vue';

export default{
    name: 'Company',
    components:{
      NavBar,
      Footer,
      Link,
   },
   methods:{
    check() {
  const imagePath = this.getImages('logo.png');
  console.log('Image Path:', imagePath);
},
    getImages(filename){
    return `/infosets/${filename}`;
    },
    LandingImages(filename){
    return `/landingimages/${filename}`;
    }
   }
   
   
}
</script>
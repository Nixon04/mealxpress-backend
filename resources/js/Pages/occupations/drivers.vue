<template>
    <div>
        <NavBar/>
        <section id="herosectionpage" class="v-herosectionbodyabout position-relative">
            <img :src="LandingImages('driverway.png')" class="v-floating-left" alt="">
            <img :src="LandingImages('standby.png')" class="v-floating-right" alt="">
              <div class="v-heroheadercompany">
                   <span class="v-xtralargeabout-txt text-white text-center">Grow your
                    Food Business</span>
                      <span class=" text-white v-stralarge-txt">
                        Join over 3,000+ businesses selling daily on Chowdeck. Enjoy a boost in menu item sales, growth in business value, and increased brand awareness. Download our Vendor app to get started.
                      </span>
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
                       <img :src="LandingImages('storeoutlets.png')" alt="">
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
import NavBar from '../navcomponents/navbarv.vue';
import {Link} from '@inertiajs/inertia-vue3';
import '../assets/css/newlanding.css';
import '../assets/css/vmedia.css';
import '../assets/css/stageindex.css';
import  Footer from '../navcomponents/footer.vue';

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
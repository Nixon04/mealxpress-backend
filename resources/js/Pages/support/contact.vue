<template>
    <div>
        <NavBar/>
        <section id="herosectionpage" class="v-herosectionbodyabout position-relative">
            <img :src="LandingImages('fruitsalads.png')" class="v-floating-left" alt="">
            <img :src="LandingImages('userstores.png')" class="v-floating-right" alt="">
              <div class="v-heroheadercompany">
                   <span class="v-xtralargeabout-txt text-white text-center">
                Contact
                   </span>
                      <span class=" text-white v-stralarge-txt">
                        Unlock the full potential of Mealxpress payment solutions with our dedicated integration support. Whether you're setting up Mealxpress for the first time or looking to enhance your current setup, we're here to ensure a seamless integration process
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
            <div class="d-flex justify-content-center mb-5">
                <div class="patch-circlebody">
                    <span>Support</span>
                </div>
            </div>
            <h1 class="fs-1  fw-bold text-main mb-3 text-main text-center">Get Support At No Cost.</h1>
           
        <div class="v-col-cente">
            <div class="col-rate-column-twosides">
                <div class="v-column-bridge position-relative">
                    <div class="bg-circlebody"></div>
                    <div class="v-flex flex-column text-start v-bg-gridcard">
                          <div class="d-flex flex-column">                            
                            <div class="rx-card-light">
                                <div class="rx-cardcontainer-light">
                                    <div class="rx-cardleftsupport">
                                        <div class="d-flex flex-column">
                                            <h1 class="fs-1 fw-bold text-main ">Email Assistance</h1>
                                            <span class="mb-3">For more detailed inquiries or to report an issue, reach out via email. Our team is committed to providing solutions promptly.</span>
                                            <a href="mailto:info@mealxpress.ng" class="rx-maildirect mb-4">
                                                <span>Contact support</span>
                                            </a>
                                        </div>
                                       </div>

                                    
                                    <div class="rx-cardleftsupport" data-aos="fade-top" data-aos-duration="3000">
                                        <img :src="LandingImages('deliveryride.png')" class="rx-shape-box"  alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="v-column-bridge position-relative">
                    <div class="bg-circlebody"></div>
                    <div class="v-flex flex-column text-start v-bg-gridcard">
                          <div class="d-flex flex-column">                            
                            <div class="rx-card-light">
                                <div class="rx-cardcontainer-light">
                                    <div class="rx-cardleftsupport">
                                        <div class="d-flex flex-column">
                                            <h1 class="fs-1 fw-bold text-main ">Report A Case To Us</h1>
                                            <span class="mb-4">Report whatever abusive means from our courier drivers and we will deal with the case appropriately, we advice if an issue arises, please don't involve in any physical means of proving one's self.</span>
                                            <a href="https://wa.me/+2349068225050" target="_blank" ref="noopener noreferrer" class="rx-maildirect mb-4">
                                                <span>Report Abuse</span>
                                            </a>
                                        </div>
                                       </div>

                                    
                                    <div class="rx-cardrightsupport" data-aos="fade-top" data-aos-duration="3000">
                                        <img :src="LandingImages('deliveryride.png')" class="rx-shape-box"  alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
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
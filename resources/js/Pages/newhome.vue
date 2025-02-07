<template>
    <div>
        <NavBar/>
          <section id="herosectionpage" class="v-herosectionbody">
                <div class="v-herohedertop">
                    <span class="v-xtralarge-txt text-white">Mealxpress.<span class="bg-sec-color">ng</span></span>
                    <span class=" text-white v-stralarge-txt">order from any where and lets deliver to your doorstep asap</span>
                    <Link href="/" class="btn v-btnoutline">
                        <span>View Market Records</span>
                    </Link>
                 </div>
                     <div class="v-hero-bottom">
                        <img :src="getImages('info4.png')" class="v-image-stage v-hero-left" alt="_images">
                        <img :src="getImages('info1.png')" class="v-image-stage v-hero-right" alt="_images">
                    </div>
                    <div class="v-hero-leftside">
                        <img :src="getImages('qrcodex.png')" width="40" height="40" alt="">
                    </div>
                    <div class="v-hero-rightside">
                        <div class="position-relative d-flex gap-2 text-center">
                        <div class="btn-activedownload">
                            <div class="v-flex-column d-flex flex-start">
                                <img :src="LandingImages('google.png')" class="me-2" width="30" height="30" alt="">
                                 <div class="d-flex flex-column text-start">
                                    <span class="v-sm-txt">Get on Apple Store</span>
                                    <span>Google Store</span>
                               </div>
                              </div>
                        </div>
                        <div class="btn-activedownload">
                            <div class="v-flex-column d-flex flex-start">
                                <img :src="LandingImages('apple.png')" class="me-2" width="30" height="30" alt="">
                                 <div class="d-flex flex-column text-start">
                                    <span class="v-sm-txt">Get on Apple Store</span>
                                    <span>Apple Store</span>
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
                        <span>Security</span>
                    </div>
                </div>
                <div class="hero-contentpad">
                    <h1 class="v-large-text text-center">Regulated, with the highest security standard</h1>
                </div>
            <div class="v-col-cente">
                <div class="col-rate-column">
                    <div class="v-column-bridge position-relative">
                        <div class="bg-circlebody"></div>
                        <div class="v-flex flex-column text-start v-bg-gridcard">
                            <div class="bg-icon-body1">
                                <i class="fas fa-home"></i>
                              </div>
                              <div class="d-flex flex-column">
                                <h1 class="fs-3 fw-bold text-main mb-3 text-main" data-aos="fade-left" data-aos-anchor-placement="center-bottom">Your assets is insured</h1>
                                <h6>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Deserunt ab sapiente est ipsa unde harum sit, dolor ullam provident quisquam aliquam tempora impedit corporis reiciendis odit pariatur iure vitae id?</h6>
                            </div>
                        </div>
                    </div>

                    <div class="v-column-bridge">
                        <div class="v-flex flex-column v-bg-gridcard">
                            <div class="bg-icon-body2">
                                <i class="fas fa-home"></i>
                              </div>
                              <div class="d-flex flex-column">
                                <h1 class="fs-3 fw-bold text-main mb-3 text-main">We are fully regulated</h1>
                                <h6>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Deserunt ab sapiente est ipsa unde harum sit, dolor ullam provident quisquam aliquam tempora impedit corporis reiciendis odit pariatur iure vitae id?</h6>
                            </div>
                        </div>
                    </div>

                    <div class="v-column-bridge">
                        <div class="v-flex flex-column v-bg-gridcard">
                            <div class="bg-icon-body3">
                                <i class="fas fa-home"></i>
                              </div>
                              <div class="d-flex flex-column">
                                <h1 class="fs-3 fw-bold text-main mb-3 text-main">We deliver intentionally</h1>
                                <h6>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Deserunt ab sapiente est ipsa unde harum sit, dolor ullam provident quisquam aliquam tempora impedit corporis reiciendis odit pariatur iure vitae id?</h6>
                            </div>
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
                    <span>Security</span>
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
                            <h1 class="fs-1  fw-bold text-main mb-3 text-main">Get More from Vendors stores</h1>
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
                       <img :src="getImages('info1.png')" alt="">
                    </div>
                </div>

            </div>
        </div>
     </div>
 </section>



     <section id="herosectionpage2" class="v-herosectionapp mb-5">
        <div class="herosectionappflex">
            <div class="herostagefirst">
                <div class="herostagefirstcontainer">
                <div class="text-center py-1 ">
                    <h1 class="text-white fw-500 fs-1 mb-5">Order with ease</h1>
                    <Link href="/" class="btn v-btnoutline">
                        <span>View Market Records</span>
                    </Link>
                </div>
                <div class="herodowninput">
                    <img :src="getImages('info2.png')" class="img-fluidcontext" alt="">
                </div>
               </div>
            </div>
            <div class="herostagesecond px-3">
                <div class="rx-col-as">
                    <div class="rx-card d-flex justify-content-center align-items-center w-100 mb-3 bg-rx-light">
                       <div class="d-flex align-items-center">
                            <div class="d-flex flex-column text-start px-2">
                                <h1 class="fs-1 fw-bold text-main">Get All Drinks In One List</h1>
                                <h6>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum voluptates, maiores dicta eveniet ex nesciunt alias at ducimus rem, nam doloremque nihil dolorem delectus natus et nisi iusto quos minus!</h6>
                             </div>
                           </div>
                        </div>
                    <div class="rx-card w-100 p-2 bg-bg_main_color">
                       <div class="rx-col-row">
                          <div class="rx-set-card bg-card-lady" :style="{backgroundImage:`url(${LandingImages('delivery3.png')})`,
                           backgroundRepeat: 'no-repeat',
                           backgroundPosition: 'center',
                           backgroundSize: 'cover',
                        }"></div>
                          <div class="rx-set-card-outline">
                                <div class="rx-set-card mb-2">
                                    <div class="rx-setbodycard mb-1">
                                        <div class="rx-notifiercard mb-4">
                                           <div class="d-flex justify-content-between">
                                             <div class="d-flex align-items-center">
                                                <div class="bg-circleround">
                                                    <img :src="LandingImages('logo.png')" width="50" height="50" alt="">
                                                  </div>
                                                   <div class="d-flex flex-column">
                                                    <h1 class="fw-bold text-main fs-5">Hey your goods in close by</h1>
                                                    <h6 class="fs-6">Share your id code with the courier for confirmation of your goods. Thanks.</h6>
                                                  </div>
                                             </div>
                                           </div>
                                        </div>

                                        <div class="rx-notifiercard">
                                            <div class="d-flex justify-content-between">
                                              <div class="d-flex align-items-center">
                                                 <div class="bg-circleround">
                                                     <img :src="LandingImages('logo.png')" width="50" height="50" alt="">
                                                   </div>
                                                    <div class="d-flex flex-column">
                                                     <h1 class="fw-bold text-main fs-5">Hey your goods in close by</h1>
                                                     <h6 class="fs-6">Share your id code with the courier for confirmation of your goods. Thanks.</h6>
                                                   </div>
                                              </div>
                                            </div>
                                         </div>

                                    </div>
                                    <div class="rx-setbodycard position-relative">
                                        <h1 class="text-white fw-bold text-center  mb-0">We are just a few steps away</h1>
                                        <img :src="LandingImages('frontcar.png')" class="position-absolute bg-rx-bottom" alt="">
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
import NavBar from './navcomponents/navbarv.vue';
import {Link} from '@inertiajs/inertia-vue3';
import  './assets/css/newlanding.css';
import   './assets/css/vmedia.css';
import  Footer from './navcomponents/footer.vue';
import './assets/css/stageindex.css';

export default{
    name: 'HomePage',
    components:{
      NavBar,
      Link,
      Footer,
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
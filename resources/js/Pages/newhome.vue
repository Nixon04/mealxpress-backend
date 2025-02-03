<template>
    <div>
        <NavBar/>
        <section id="herosectionpage" class="v-herosectionbody">
                <div class="v-herohedertop">
                    <span class="v-xtralarge-txt text-white">Mealxpress.<span class="bg-sec-color">ng</span></span>
                    <span class="fs-3 text-white v-stralarge-txt">order from any where and lets deliver to your doorstep asap</span>
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
                        <div class="position-relative d-flex gap-1 text-center">
                        <div class="btn-activedownload">
                            <div class="v-flex-column d-flex flex-start">
                                <img :src="LandingImages('google.png')" class="me-2" width="30" height="30" alt="">
                                 <div class="d-flex flex-column text-start">
                                    <span class="v-sm-txt">Get on Apple Store</span>
                                    <span>Google Playstore</span>
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

         <section id="herosectionpage2" class="v-herosectionbody"></section>
        
    </div>
</template>

<script>
import NavBar from './navcomponents/navbarv.vue';
import {Link} from '@inertiajs/inertia-vue3';
import './assets/css/newlanding.css';
import './assets/css/vmedia.css';
import './assets/css/stageindex.css';

export default{
    name: 'HomePage',
    components:{
      NavBar,
      Link,
   },
   methods:{
    getImages(filename){
    return `/infosets/${filename}`;
    },
    LandingImages(filename){
    return `/landingimages/${filename}`;
    }
   }
   
   
}
</script>
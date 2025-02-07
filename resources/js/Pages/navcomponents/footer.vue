<template>
    <div>
        <section id="herosectionpage2" class="v-herosectionbodymainv3">
            <div class="v3-cardlookout">
                 <div class="d-flex flex-column justify-content-center align-items-center w-50">
                    <h1 class="fs-1 text-white fw-bold text-center mb-3">Join Millions to order Today</h1>
                    <h6 class="text-white mb-3">Start today, buy as much as you intend to go for with mealxpress</h6>
                    <Link href="/" class="btn v-btnoutline py-3">
                     <span>View Market Records</span>
                 </Link>
                 </div>
            </div>
          </section>
     
     
     
            <section id="herosectionpage2" class="v-herosectionbodymainv4">
               <div class="bg-flexsection-v1">
                 <div class="flexsectionleft flexleftpad">
                   <div class="d-flex mb-3">
                     <img :src="LandingImages('logo.png')" class="me-2" width="30" alt="">
                      <span class="text-main fs-5 text-main">Mealxpress.ng </span>
                   </div>
                   <div class="d-flex flex-column">
                     <span>
                      Mealxpress.ng is a verse platform giving users the leverage to pay for different sorts of foods at the users will.
                     </span>
                  </div>
     
                 </div>
                 <div class="flexsectionright">
                     <div class="d-flex mb-3">
                          <div class="footer-v-cron">
                             <div class="p-4 d-flex flex-column gap-2">
                                 <h1>Products</h1>
                                  <Link href="/occupations/drivers" class="footer-autolink">Drivers</Link>
                                  <Link href="/occupations/vendors" class="footer-autolink">Vendors</Link>
                                  <Link href="/store/home" class="footer-autolink">Live stocks</Link>
                             </div>
                             <div class="p-4 d-flex flex-column gap-2">
                                 <h1>Resources</h1>
                                  <Link href="/about" class="footer-autolink">About</Link>
                                  <Link href="/" class="footer-autolink">Careers</Link>
                                  <Link  class="footer-autolink">Our team</Link>
                             </div>
                             <div class="p-4 d-flex flex-column gap-2">
                                 <h1>Follow us</h1>
                                 <a  href="/">
                                  <span>Facebook</span>
                                   </a>
                                  <a  href="/">
                                    <span>Twitter</span>
                                     </a>
                                     <a  href="/">
                                      <span>Instagram</span>
                                       </a>
                             </div>
                          </div>
                       </div>
                 </div>
               </div>
            </section>
            <hr class="text-brake">
     
            <section id="herosectionpage2" class="herosectionbodymainv5">
             <div class="footer-container">
                 <div class="vconleft mb-3">
                     copyright 2025 Mealxpress, Inc, All rights Reserved.
                 </div>
                 <div class="vconright">
                     <Link href="/">
                       Privacy
                     </Link>
                     <Link href="/">
                         Terms of use
                       </Link>
                 </div>
             </div>
     
            </section>
             
    </div>
</template>

<script>
import NavBar from '../navcomponents/navbarv.vue';
import {Link} from '@inertiajs/inertia-vue3';
import '../assets/css/newlanding.css';
import '../assets/css/vmedia.css';
import '../assets/css/stageindex.css';

export default{
    name: 'Footer',
    components:{
      NavBar,
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

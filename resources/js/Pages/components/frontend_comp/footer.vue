<template>
    <section class="bg-footer">
        <div class="d-flex flex-wrap">
         <div class="d-flex-1">
           <div class="bg-px-space mb-0">
                <div class="d-flex mb-4">
                    <img src="../../../../../public/landingimages/logo.png"  class="img-logo-mealxpress"/>
                  <h1 class="fs-3 fw-bold text-white ">Mealxpress<span>.ng</span></h1>
                </div>
               <h5 class="text-white">
                Mealxpress your goto Market Area for Good shopping a
            </h5>
           </div>
           <div class="bg-px-space mealxpress-email rounded-lg">
            <div class="mealx-container">
                <h2 class="mb-3">Join our exclusive newsletter to recieve latest update on our food delivery services and much more that entails about mealxpress.ng</h2>
              <div class="d-flex justify-content-between">
                <div class="d-flex flex-1">
                    <input type="text" class="form-control py-3" placeholder="Enter your mail address">
                </div>
                 <div class="bg-button-submit w-20 align-items-center d-flex justify-content-center rounded-md py-2 cursor-pointer ms-3">Submit</div>
              </div>
            </div>
           </div>
         </div>


         <div class="d-flex-2">
           <div class="d-flex flex-column text-start align-items-start  bg-px-space">
             <ul class="d-flex flex-column text-start">
               <li class="menu-link cursor-pointer mb-3 fw-bold text-white">Company</li>
               <li class="menu-link cursor-pointer mb-3">
                 <Link href="/about" class="bg-footer-link">
                   About 
                   </Link>
               </li>
               <li class="menu-link cursor-pointer mb-3">
                 <Link href="/about" class="bg-footer-link">
                   Careers 
                   </Link>
               </li>
               <li class="menu-link cursor-pointer mb-3">
                 <Link href="/contact" class="bg-footer-link">
                   Contact 
                   </Link>
               </li>
               <li class="menu-link cursor-pointer mb-3">
                 <Link href="/faqs" class="bg-footer-link">
                   Faqs 
                   </Link>
               </li>
              
              
               <li class="menu-link cursor-pointer mb-3">
                 <Link href="/terms" class="bg-footer-link">
                   Terms of Use 
                   </Link>
               </li>
   
               <li class="menu-link cursor-pointer mb-3">
                 <Link href="/privacy" class="bg-footer-link">
                   Privacy Policy 
                   </Link>
               </li>
              
              
             </ul>
           </div>
         </div>
         <div class="d-flex-2">
           <div class="d-flex flex-column text-start align-items-start bg-px-space">
             <ul class="d-flex flex-column">
               <li class="menu-link cursor-pointer mb-3 fw-bold text-white">Services</li>
               <li class="menu-link cursor-pointer mb-3">
                 <Link href="/about" class="bg-footer-link">
                   Couriers
                   </Link>
                
                 </li>
               <li class="menu-link cursor-pointer mb-3">
                 <Link href="/about" class="bg-footer-link">
                   Riders
                   </Link>
                 </li>
               <li class="menu-link cursor-pointer mb-3">
                 <Link href="/about" class="bg-footer-link">
                   Partnerships
                   </Link>
                 </li>
             </ul>
           </div>
         </div>
         <div class="d-flex-2">
           <div class="d-flex flex-column text-start align-items-start bg-px-space">
             <ul class="d-flex flex-column">
               <li class="menu-link cursor-pointer mb-3 fw-bold text-white">Company</li>
               <li class="menu-link cursor-pointer mb-3">
                 <Link href="/" class="bg-footer-link">
                 Telegram 
                 </Link>
               </li>
               <li class="menu-link cursor-pointer mb-3">
                 <Link href="/" class="bg-footer-link">
                   Facebook 
                   </Link>
               </li>
               <li class="menu-link cursor-pointer mb-3">
                 <Link href="/" class="bg-footer-link">
                   Instagram 
                   </Link>
               </li>
               <li class="menu-link cursor-pointer mb-3">
                 <a href="mailto:nixonsampson04@gmail.com" class="bg-footer-link">
                   Email 
                 </a>
               </li>
             </ul>
           </div>
         </div>

       </div>
       <!-- <hr>
       <div class="d-flex justify-content-between p-2">
         <span><Link>Privacy policy</Link></span>
       </div>
       <hr> -->
       <hr>
       <div class="div padding-bottom-motion p-4 ">
         <h4 class="text-white fs-7 text-center text-small">
            Mealxpress is fully Certified in Nigeria         </h4>
       </div>
       </section>
    
</template>


<script>
import {Link} from '@inertiajs/inertia-vue3';

export default{
    components:{
        Link,
    }
}

</script>
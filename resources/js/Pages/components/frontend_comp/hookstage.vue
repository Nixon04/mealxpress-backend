<template>
  <section class="h-auto bg-corevalues py-5 position-relative bg-main-color" >
    <section class="mealxpress-custompackages">
    <div class="bg-container-all " data-aos="fade-up" data-aos-duration="2000">
      <div class="d-flex flex-wrap gap-2 p-0">
       <div class="flex-info-left flex-column flex-info-background ">
        <h1 class="bg-f-1 fw-bold c-colorbody mb-1 py-3 ">Get Started With Us</h1>

          <div class="bg-pad py-3">
            <Link href="/" class="cursor-pointer mb-5">
              <div class="bg-button-submit  rounded-lg w-50 align-items-center d-flex gap-1 py-2" style="width: auto">
               <img :src="getGeneralImages('google.png')" alt="" width="40">
                <span class="text-white">Google Playstore</span>
              </div>
            </Link>
          </div>

          <div class="bg-pad ">
            <Link href="/" class="cursor-pointer mb-5">
              <div class="bg-button-submit  rounded-lg w-50 align-items-center d-flex gap-1 py-4" style="width: auto">
               <img :src="getGeneralImages('apple.png')" alt="" width="20">
                <span class="text-white">Google Playstore</span>
              </div>
            </Link>
          </div>

       </div>
       <!-- flex right -->
       <div class="flex-info-right bg-footer-connect flex-column position-relative h-bigger-footer">
          <div class="bg-content-fillable">
          </div>
         <!--  -->
       </div>


      </div>
    </div>
</section>
</section>
</template>

<script>
import { Link } from '@inertiajs/vue3';
export default{
  components:{
   Link,
  },
  methods:{
    getGeneralImages(filename){
      return `landingimages/${filename}`;
    }
  }
}
</script>
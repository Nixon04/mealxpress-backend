<template>
  <div class="mealxpress-header">
    <div class="d-flex justify-content-between">
      <div class="d-flex gap-3">
        <div class="button-state cursor-pointer d-flex" @click="showitem">
          <i class="fas fa-bars-staggered bg-toggle" style="font-size: 24px;"></i>
        </div>
        <h1>{{ userid }}</h1>
      </div>
      <div class="d-flex gap-3">
        <img src="https://mdbcdn.b-cdn.net/img/new/avatars/2.webp" alt="" class="rounded-circle w-10 h-10 border-standard cursor-pointer">
      </div>
    </div>
  </div>

  <aside class="aside-mealxpress">
    <div class="flex-wrap-container">
        <div class="aside-header">
            <h1 class="text-white fs-5">Mealxpress</h1>
        </div>
        <div class="aside-navigation">
            <ul class="ul-flex">
                <Link href="/vendorspath/dashboard/home" class="mb-3">
                    <li :class="['mealxpress-navlink', { active: $page.url === '/vendorspath/dashboard/home' } ]">
                        <i class="fas fa-home mealxpress-icons" ></i>
                        Dashboard
                    </li>
                </Link>

                <Link href="/vendorspath/dashboard/addcategories" class="mb-3">
                    <li :class="['mealxpress-navlink', { active: $page.url === '/vendorspath/dashboard/addcategories' } ]">
                        <i class="fa-solid fa-feather-pointed mealxpress-icons" ></i>
                        Add categories
                    </li>
                </Link>

                <Link href="/vendorspath/dashboard/listproducts" class="mb-3">
                    <li :class="['mealxpress-navlink', { active: $page.url === '/vendorspath/dashboard/listproducts' } ]">
                        <i class="fas fa-paper-plane mealxpress-icons" ></i>
                        Products
                    </li>
                </Link>

                <Link href="/vendorspath/dashboard/orders" class="mb-4" replace>
                    <li :class="['mealxpress-navlink', { active: $page.url === '/vendorspath/dashboard/orders' } ]">
                        <i class="fa fa-store mealxpress-icons" ></i>
                        Orders
                    </li>
                </Link>

                <Link href="/vendorspath/dashboard/payouts" class="mb-4">
                    <li :class="['mealxpress-navlink', { active: $page.url === '/vendorspath/dashboard/payouts' } ]">
                        <i class="fa-regular fa fa-file-lines mealxpress-icons" ></i>
                        Payouts
                    </li>
                </Link>

                <Link href="/vendorspath/dashboard/settings" class="mb-4">
                    <li :class="['mealxpress-navlink', { active: $page.url === '/vendorspath/dashboard/settings' } ]">
                        <i class="fa fa-cog mealxpress-icons" ></i>
                       settings
                    </li>
                </Link>


            </ul>
        </div>
        <div class="aside-footer">
            <div class="aside-centered">
                <h1 class=" fs-2 text-white">Having troubles</h1>
                <h6 class="fs-7 text-white">We are active 24/7</h6>
            </div>
        </div>
    </div>
  </aside>


  <aside class="aside-mealxpresscontent" :class="{ 'is-visible': isSidebarVisible }" >
    <div class="flex-wrap-container">
        <div class="aside-header d-flex justify-content-between">
            <h1 class="text-white fs-5">Mealxpress</h1>
            <i class="bx bx-chevrons-left p-2 cursor-pointer" @click="dismissNav"></i>
        </div>
        <div class="aside-navigation">
            <ul class="ul-flex">
                <Link href="/vendorspath/dashboard/home" class="mb-3">
                    <li :class="['mealxpress-navlink', { active: $page.url === '/vendorspath/dashboard/home' } ]">
                        <i class="fas fa-home mealxpress-icons" ></i>
                        Dashboard
                    </li>
                </Link>

                <Link href="/vendorspath/dashboard/addcategories" class="mb-3">
                    <li :class="['mealxpress-navlink', { active: $page.url === '/vendorspath/dashboard/addcategories' } ]">
                        <i class="fa-solid fa-feather-pointed mealxpress-icons" ></i>
                        Add categories
                    </li>
                </Link>

                <Link href="/vendorspath/dashboard/listproducts" class="mb-3">
                    <li :class="['mealxpress-navlink', { active: $page.url === '/vendorspath/dashboard/listproducts' } ]">
                        <i class="fas fa-paper-plane mealxpress-icons" ></i>
                        Products
                    </li>
                </Link>

                <Link href="/vendorspath/dashboard/orders" class="mb-4" replace>
                    <li :class="['mealxpress-navlink', { active: $page.url === '/vendorspath/dashboard/orders' } ]">
                        <i class="fa fa-store mealxpress-icons" ></i>
                        Orders
                    </li>
                </Link>

                <Link href="/vendorspath/dashboard/payouts" class="mb-4">
                    <li :class="['mealxpress-navlink', { active: $page.url === '/vendorspath/dashboard/payouts' } ]">
                        <i class="fa-regular fa fa-file-lines mealxpress-icons" ></i>
                        Payouts
                    </li>
                </Link>

                <Link href="/vendorspath/dashboard/settings" class="mb-4">
                    <li :class="['mealxpress-navlink', { active: $page.url === '/vendorspath/dashboard/settings' } ]">
                        <i class="fa fa-cog mealxpress-icons" ></i>
                       settings
                    </li>
                </Link>


            </ul>
        </div>
        <div class="aside-footer">
            <div class="aside-centered">
                <h1 class=" fs-2 text-white">Having troubles</h1>
                <h6 class="fs-7 text-white">We are active 24/7</h6>
            </div>
        </div>
    </div>
  </aside>

  <!-- Sidebar Section -->
  <!-- <aside class="aside-mealxpresscontent" :class="{ 'is-visible': isSidebarVisible }">
    <p>Sidebar Content</p>
  </aside> -->
</template>

<script>
import { Link } from '@inertiajs/vue3';
export default {
  props: {
    userid: {
      type: String,
      required: false,
    }
  },
  components:{
    Link,
  },
  data() {
    return {
      isSidebarVisible: false,  // To control the visibility of the sidebar
    };
  },
  methods: {
    showitem() {
      // Toggle sidebar visibility
      this.isSidebarVisible = !this.isSidebarVisible;
    },
    dismissNav(){
      this.isSidebarVisible = false;
      console.log((`information ${this.isSidebarVisible}`));
    }
  }
};
</script>


<style scoped>
.aside-mealxpresscontent {
  width: 250px;
  background-color: var(--bg-primary-main);
  color: #fff;
  height: 100vh;
  position: fixed;
  top: 0;
  left: 0;
  overflow: auto;
  z-index: 9999;
  transform: translateX(-100%);  /* Initially hidden */
  transition: transform 0.3s ease;  /* Smooth transition */
}


.aside-mealxpresscontent.is-visible {
  transform: translateX(0);  /* When visible, slide in */
}
</style>

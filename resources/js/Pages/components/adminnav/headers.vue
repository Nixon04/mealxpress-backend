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
  
    <aside class="aside-mealxpress" :class="{ 'is-visible': isSidebarVisible }">
      <div class="flex-wrap-container">
          <div class="aside-header d-flex justify-content-between">
              <h1 class="text-white fs-5">Mealxpress</h1>
          </div>
          <div class="aside-navigation">
              <ul class="ul-flex">
                  <Link href="/prisent/dashboard/home" class="mb-3">
                      <li :class="['mealxpress-navlink', { active: $page.url === '/prisent/dashboard/home' } ]">
                          <i class="fas fa-home mealxpress-icons" ></i>
                          Dashboard
                      </li>
                  </Link>
  
                  <Link href="/prisent/dashboard/currentsales" class="mb-3">
                      <li :class="['mealxpress-navlink', { active: $page.url === '/prisent/dashboard/currentsales' } ]">
                          <i class="fas fa-signal mealxpress-icons" ></i>
                         history
                      </li>
                  </Link>
  
                  <Link href="/prisent/dashboard/category" class="mb-4" replace>
                    <li :class="['mealxpress-navlink', { active: $page.url === '/prisent/dashboard/category' } ]">
                        <i class="fa fa-droplet mealxpress-icons" ></i>
                       Category
                    </li>
                </Link>
  

                <Link href="/prisent/dashboard/ads" class="mb-4" replace>
                  <li :class="['mealxpress-navlink', { active: $page.url === '/prisent/dashboard/ads' } ]">
                      <i class="fa-solid fa-volume-high mealxpress-icons" ></i>
                     Ads
                  </li>
              </Link>

  
  
                  <Link href="/prisent/dashboard/payouts" class="mb-4" replace>
                      <li :class="['mealxpress-navlink', { active: $page.url === '/prisent/dashboard/payouts' } ]">
                          <i class="fa fa-store mealxpress-icons" ></i>
                         Payouts
                      </li>
                  </Link>
  
  
                  <Link href="/prisent/dashboard/drinks" class="mb-4" replace>
                    <li :class="['mealxpress-navlink', { active: $page.url === '/prisent/dashboard/drinks' } ]">
                        <i class="fa-solid fa-mug-saucer mealxpress-icons" ></i>
                       Add Drinks
                    </li>
                </Link>
  
                  <Link href="/prisent/dashboard/sendappnotification" class="mb-4" replace>
                    <li :class="['mealxpress-navlink', { active: $page.url === '/prisent/dashboard/sendappnotification' } ]">
                        <i class="fa fa-bell mealxpress-icons" ></i>
                       App Notification
                    </li>
                </Link>
  
                  <Link href="/prisent/dashboard/regusers" class="mb-4">
                      <li :class="['mealxpress-navlink', { active: $page.url === '/prisent/dashboard/regusers' } ]">
                          <i class="fas fa-users mealxpress-icons" ></i>
                         Reg Users
                      </li>
                  </Link>
  
                  <Link href="/prisent/dashboard/vendors" class="mb-4">
                    <li :class="['mealxpress-navlink', { active: $page.url === '/prisent/dashboard/vendors' } ]">
                        <i class="fas fa-store mealxpress-icons" ></i>
                       Vendors
                    </li>
                </Link>
  
                <Link href="/prisent/dashboard/drivers" class="mb-4">
                    <li :class="['mealxpress-navlink', { active: $page.url === '/prisent/dashboard/drivers' } ]">
                        <i class="fas fa-car mealxpress-icons" ></i>
                      Drivers
                    </li>
                </Link>
  
                  <Link href="/prisent/auth/login" class="mb-4">
                      <li :class="['mealxpress-navlink', { active: $page.url === '/prisent/dashboard/logout' } ]">
                          <i class="fa fa-cog mealxpress-icons" ></i>
                         LogOut
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
  
  
    <aside class="aside-mealxpresscontent" :class="{ 'is-visible': isSidebarVisible }">
      <div class="flex-wrap-container mb-5">
          <div class="aside-header d-flex justify-content-between">
              <h1 class="text-white fs-5 ">Mealxpress</h1>
              <i class="bx bx-chevrons-left p-2 cursor-pointer" @click="dismissNav"></i>
          </div>
          <div class="aside-navigation">
              <ul class="ul-flex">
                  <Link href="/prisent/dashboard/home" class="mb-3">
                      <li :class="['mealxpress-navlink', { active: $page.url === '/prisent/dashboard/home' } ]">
                          <i class="fas fa-home mealxpress-icons" ></i>
                          Dashboard
                      </li>
                  </Link>
  
                  <Link href="/prisent/dashboard/currentsales" class="mb-3">
                      <li :class="['mealxpress-navlink', { active: $page.url === '/prisent/dashboard/currentsales' } ]">
                          <i class="fas fa-signal mealxpress-icons" ></i>
                         Current Sales
                      </li>
                  </Link>
  
                  <Link href="/prisent/dashboard/category" class="mb-4" replace>
                    <li :class="['mealxpress-navlink', { active: $page.url === '/prisent/dashboard/category' } ]">
                        <i class="fa fa-droplet mealxpress-icons" ></i>
                       Category
                    </li>
                </Link>

                
                <Link href="/prisent/dashboard/ads" class="mb-4" replace>
                  <li :class="['mealxpress-navlink', { active: $page.url === '/prisent/dashboard/ads' } ]">
                      <i class="fa-solid fa-volume-high mealxpress-icons" ></i>
                     Ads
                  </li>
              </Link>
  
  
  
                  <Link href="/prisent/dashboard/payouts" class="mb-4" replace>
                      <li :class="['mealxpress-navlink', { active: $page.url === '/prisent/dashboard/payouts' } ]">
                          <i class="fa fa-store mealxpress-icons" ></i>
                         Payouts
                      </li>
                  </Link>
  
  
                  <Link href="/prisent/dashboard/drinks" class="mb-4" replace>
                    <li :class="['mealxpress-navlink', { active: $page.url === '/prisent/dashboard/drinks' } ]">
                        <i class="fa-solid fa-mug-saucer mealxpress-icons" ></i>
                       Add Drinks
                    </li>
                </Link>
  
                  <Link href="/prisent/dashboard/sendappnotification" class="mb-4" replace>
                    <li :class="['mealxpress-navlink', { active: $page.url === '/prisent/dashboard/sendappnotification' } ]">
                        <i class="fa fa-bell mealxpress-icons" ></i>
                       App Notification
                    </li>
                </Link>
  
                  <Link href="/prisent/dashboard/regusers" class="mb-4">
                      <li :class="['mealxpress-navlink', { active: $page.url === '/prisent/dashboard/regusers' } ]">
                          <i class="fas fa-users mealxpress-icons" ></i>
                         Reg Users
                      </li>
                  </Link>
  
                  <Link href="/prisent/dashboard/vendors" class="mb-4">
                    <li :class="['mealxpress-navlink', { active: $page.url === '/prisent/dashboard/vendors' } ]">
                        <i class="fas fa-store mealxpress-icons" ></i>
                       Vendors
                    </li>
                </Link>
  
                <Link href="/prisent/dashboard/drivers" class="mb-4">
                    <li :class="['mealxpress-navlink', { active: $page.url === '/prisent/dashboard/drivers' } ]">
                        <i class="fas fa-car mealxpress-icons" ></i>
                      Drivers
                    </li>
                </Link>
  
                  <Link href="/prisent/auth/login" class="mb-4">
                      <li :class="['mealxpress-navlink', { active: $page.url === '/prisent/dashboard/logout' } ]">
                          <i class="fa fa-cog mealxpress-icons" ></i>
                         LogOut
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
  
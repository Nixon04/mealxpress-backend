<template>
  <div>

    
    
    <div class="mealxpress-header">
      <div class="d-flex justify-content-between">
        <div class="d-flex gap-3">
          <div class="button-state cursor-pointer d-flex" @click="showitem">
            <i class="fas fa-bars-staggered bg-toggle" style="font-size: 24px;"></i>
          </div>
        </div>
        <div class="d-flex gap-3">
          <label class="switch-label">
            <input
              type="checkbox"
              v-model="isActive"
              ref="toggleSwitch"
              :disable="isLoading"
              @change="updateStatus"
            />
            <span class="slider round"></span>
          </label>

          <Link href="/vendorspath/dashboard/settings">
            <img
              :src="imageref"
              alt=""
              class="rounded-circle w-10 h-10 border-standard cursor-pointer"
            />
          </Link>
        </div>
      </div>


      <aside class="aside-mealxpress" :class="{ 'is-visible': isSidebarVisible }">
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


                    <!-- <Link href="/vendorspath/dashboard/menu" class="mb-3">
                      <li :class="['mealxpress-navlink', { active: $page.url === '/vendorspath/dashboard/menu' } ]">
                          <i class="fas fa-paper-plane mealxpress-icons" ></i>
                          Menu
                      </li>
                  </Link> -->

  
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


                    <Link href="/vendorspath/dashboard/logout" class="mb-4">
                      <li :class="['mealxpress-navlink', { active: $page.url === '/vendorspath/dashboard/logout' } ]">
                        <i class="fa fa-sign-out-alt mealxpress-icons" ></i>
                        Logout
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
        <div class="flex-wrap-container">
          <div class="aside-header d-flex justify-content-between">
            <h1 class="text-white fs-5 ">Mealxpress</h1>
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

                    <Link href="/vendorspath/dashboard/logout" class="mb-4">
                      <li :class="['mealxpress-navlink', { active: $page.url === '/vendorspath/dashboard/logout' } ]">
                        <i class="fa fa-sign-out-alt mealxpress-icons" ></i>
                        Logout
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

    </div>

 
  
  </div>
</template>

<script>
import { Link } from '@inertiajs/vue3';
import axios from 'axios';
import { useToast } from 'vue-toastification';

export default {
  props: {
    userid: {
      type: String,
      required: false,
    },
    imageref: {
      type: String,
      required: false,
    },
  },
  components: {
    Link,
  },
  data() {
    return {
      isActive: false, // Keeps track of the toggle switch state
      isSidebarVisible: false, // Controls the sidebar visibility
      isLoading:true,
    };
  },
  mounted() {
    this.fetchinitialStatus(); // Fetch the initial status when the component is mounted
  },
  methods: {
    // Fetch current status from the backend
    async fetchinitialStatus() {
      try {
        const response = await axios.get('/vendorspath/dashboard/getcurrentsatus');
        if (response.status === 200) {
          this.isActive = response.data.status === 'active'; // Set isActive based on the backend status
        }
      } catch (error) {
        console.error('Error fetching initial status:', error);
      }
    },

    // Update status when the toggle switch changes
    updateStatus() {
      const status = this.isActive  ? 'active' : 'inactive'; // Update status based on the toggle state
      this.updateDatabase(status); // Send updated status to backend
    },

    // Send the updated status to the backend
    async updateDatabase(status) {
      try {
        const response = await axios.post('/vendorspath/dashboard/updatestoreactivity', { status });
        if (response.status === 200) {
           const toast = useToast();
           toast.info(`Store ${status}`,{
            timeout:3000,
            hideProgressBar:true,
           });
          console.log('Status updated successfully!');
        }
      } catch (error) {
        console.error('Error updating status:', error);
      }
    },

    showitem() {
      this.isSidebarVisible = !this.isSidebarVisible; // Toggle sidebar visibility
      console.log('active status');
    },
    dismissNav() {
      this.isSidebarVisible = false; // Close the sidebar
    },
  },
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

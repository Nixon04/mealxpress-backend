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
    },
    dismissNav() {
      this.isSidebarVisible = false; // Close the sidebar
    },
  },
};
</script>
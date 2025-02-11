<template>
  <div class="bg-drawer-center" v-if="addVisible">
    <div class="bg-drawer-center-container">
      <div class="d-flex justify-content-between overlay-topcardspad">
        <h1 class="fs-5 text-main fw-bold">Add Category</h1>
        <div class="bg-circle" @click="$emit('close')">
          <i class="fas fa-x"></i>
        </div>
      </div>
      <div class="container-scrollable overlay-topcardspad">
        <!-- PrimeMultiSelect Dropdown for Categories -->
        <PrimeMultiSelect 
          :options="options" 
          display="chip"
          :maxSelectedLabels="3"
           placeholder="Choose your own category"
          v-model="value" 
          optionLabel="name"
          filter
          class="rx-primecard"
        />

      </div>

      <!-- Submit Button -->
      <div class="py-4 px-5">
        <button class="bg-button-submit btn py-3" @click="submitProduct">
          {{ isLoadingProduct ? '....' : 'Add Category' }}
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import PrimeMultiSelect from 'primevue/multiselect';
import axios from 'axios';
import { ref, watch } from 'vue';
import { useToast } from 'vue-toastification';
import { Inertia } from '@inertiajs/inertia';


const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

export default {
  props: {
    addVisible: Boolean,
    data: Array,
    isLoadingProduct: Boolean,
  },
  components: {
    PrimeMultiSelect,
  },

  setup(props) {
    const toast = useToast();
    const value = ref([]);
    const options = ref([]);

    // Watch for changes in props.data and update options accordingly
    watch(() => props.data, (newData) => {
      // Map over the new data and create an array with only the category name and other required properties
      options.value = newData.map(category => ({
        name: category.categoryname,  // Extract the category name
      }));
      
      // Log the transformed options to verify their structure
      console.log('Updated options:', options.value);
    }, { immediate: true });

    // Handle form submission for adding categories
    const submitProduct = async () => {
      if (value.value.length === 0) {
        toast.error('Please select at least one category!');
        return;
      }

      const formData = new FormData();
      formData.append('value', JSON.stringify(value.value));

      try {
        const response = await axios.post('/vendorspath/addcategory', formData, {
          headers: {
            'X-CSRF-TOKEN': csrfToken,
          }
        });

        if (response.status === 200) {
          toast.success(response.data.message, { hideProgressBar: true, timeout: 3000 });
          Inertia.reload();  // Reload the page
        } else {
          toast.error('Couldn\'t update category', { hideProgressBar: true, timeout: 3000 });
        }
      } catch (error) {
        console.error(error);
        toast.error('An error occurred. Please try again later.', { hideProgressBar: true, timeout: 3000 });
      }
    };

    return {
      value,
      options,
      submitProduct,
    };
  },
};
</script>

<style scoped>
/* Custom styles for the multiselect tags */
.multiselect__tag {
  background-color: #2D2942 !important;
  color: white;
  border-radius: 20px;
  padding: 5px 10px;
  font-size: 14px;
  margin-right: 5px;
}

/* Optional: Add hover effect to tags */
.multiselect__tag:hover {
  background-color: #2980b9 !important;
}

.multiselect__element:hover {
  background-color: #3498db;
  color: white;
  cursor: pointer;
}

.multiselect__tag:hover {
  background-color: #2980b9 !important;
  color: white;
}

.multiselect__tag__remove:hover {
  color: #e74c3c !important;
}
</style>

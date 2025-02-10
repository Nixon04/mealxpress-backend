<template>
  <div class="card flex justify-center">
    <MultiSelect
      v-model="selectedCities"
      display="chip"
      :options="cities"
      optionLabel="name"
      filter
      placeholder="Select Category"
      :maxSelectedLabels="3"
      class="rx-multicard"
    />
  </div>
 
</template>

<style>
.rx-multicard{
  background: #f1f1f1;
}
.rx-multicard .maxSelectedLabels{
 background: red;
}
</style>

<script setup>
import MultiSelect from 'primevue/multiselect';
import { ref } from 'vue';

const selectedCities = ref([]); // Initialize as an empty array for multi-select
const cities = ref([
  { name: 'New York', code: 'NY' },
  { name: 'Rome', code: 'RM' },
  { name: 'London', code: 'LDN' },
  { name: 'Istanbul', code: 'IST' },
  { name: 'Paris', code: 'PRS' }
]);
</script>
<template>
    <div class="bg-drawer-center" v-if="addVisible">
      <div class="bg-drawer-center-container">
        <div class="d-flex justify-content-between p-y-2">
          <h1 class="fs-5 px-3 fw-bold">Add Category</h1>
           <div class="bg-circle" @click="$emit('close')">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><!-- Icon from Solar by 480 Design - https://creativecommons.org/licenses/by/4.0/ --><path fill="currentColor" fill-rule="evenodd" d="M12 22c-4.714 0-7.071 0-8.536-1.465C2 19.072 2 16.714 2 12s0-7.071 1.464-8.536C4.93 2 7.286 2 12 2s7.071 0 8.535 1.464C22 4.93 22 7.286 22 12s0 7.071-1.465 8.535C19.072 22 16.714 22 12 22M8.97 8.97a.75.75 0 0 1 1.06 0L12 10.94l1.97-1.97a.75.75 0 0 1 1.06 1.06L13.06 12l1.97 1.97a.75.75 0 1 1-1.06 1.06L12 13.06l-1.97 1.97a.75.75 0 1 1-1.06-1.06L10.94 12l-1.97-1.97a.75.75 0 0 1 0-1.06" clip-rule="evenodd"/></svg>
          </div>
        </div>
        <div class="container-scrollable px-5">

          <div class="form-input mb-3">
            <select name="" class="form-select py-3" v-model="categoryitem">
              <option value="" disabled selected>--Select Category--</option>
              <option value="localmarket">LocalMarket</option>
              <!-- <option value="supermarket">SuperMarket</option> -->
            </select>
          </div>

          <div class="form-input mb-3">
            <label for="business">Category Name</label>
            <div class="float-t-right">
                <input
                type="text"
                v-model="categoryname"
                id="state"
                class="form-control py-3"
                placeholder="Add Category Name"
              />
              <span class="t-top fw-bold" @click="AddMore">Add Options</span>
            </div>
          </div>

           <div class="bg-label-warning p-3 mb-2" v-if="selectedEvent ==  'Meal'">
            <span class="fw-bold">Each items can be decided if its needed or not, choose your choice for your vendors</span>
           </div>

           <div class="bg-label-warning p-3 mb-2" v-if="selectedEvent ==  'FastFood'">
            <span class="fw-bold">Only Drinks is active on this category by default</span>
           </div>
          

          <div v-if="count == 1"  class="visi-label">
          <div  v-for="(item,index) in subCategories" :key="index" class="form-input mb-3" >
             <div class="bg-card-space">
              <div class="d-flex justify-content-between"> 
                <!-- <label :for="'subcategory-' + index">{{item.label}}</label> -->
                <label for="" class="bg-textmain fw-bold">Options</label>
                <span class="x-remove mb-3 bg-textmain x-bold" @click="RemoveItem(index)">Remove</span>
                   </div>
                   <select class="form-select py-3 mb-3" name="" @change="optionSelect($event)" v-model="optionOrg" >
                    <option value="" selected disabled>Select Option</option>
                    <option value="Meal" >Meal</option>
                    <option value="FastFood">FastFood</option>
                   </select>



                   <div class="mealxpress-meal-list" v-if="selectedEvent == 'Meal'">
                    <div class="card p-2 mb-3">
                      <div  class="justify-content-between d-flex align-items-center">
                        <span class="bg-textmain fw-bold">Protein</span>
                         <label class="switch-label">
                          <input
                            type="checkbox"
                            v-model="isActiveProtein"
                            ref="toggleSwitch"
                            :disable="isLoading"
                            @change="updateProtein"
                          />
                          <span class="slider round"></span>
                        </label>
                      </div>
                    </div>


                    <div class="card p-2 mb-3">
                      <div  class="justify-content-between d-flex align-items-center">
                        <span class="bg-textmain fw-bold">Wraps(Eba/FuFu/Powered Yam)</span>
                         <label class="switch-label">
                          <input
                            type="checkbox"
                            v-model="isActiveWrap"
                            ref="toggleSwitch"
                            :disable="isLoading"
                            @change="updateWrap"
                          />
                          <span class="slider round"></span>
                        </label>
                      </div>
                    </div>


                   </div>
             </div>
          </div>
        </div>
        </div>



  
        <!-- Submit Button -->
        <div class="py-4 px-5">
          <button :class="[ isOptionLoading ? 'bg-button-submit btn py-3 cursor-not-allowed' : 'bg-button-submit btn py-3'] " @click="submitProduct">
            {{ isOptionLoading ? 'Loading...' : 'Add Category' }}
          </button>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import { useToast } from 'vue-toastification';
  import axios from 'axios';
import { select } from 'underscore';
  const toast = useToast();
  export default {
    
    props: {
      addVisible: Boolean, // Modal visibility
      cat:Array,
      isOptionLoading:Boolean,
    },
    data() {
      return {
        categoryname: '',
        image: null,
        subCategories: [],
        count: 0,
        selectedEvent: '',
        isActiveWrap: false,
        isActiveProtein: false,
        infowrap: 'inactive',
        optionOrg: '',
        infoprotein: 'inactive',
      };
    },
    methods: {

      updateWrap (){
      this.infowrap =  this.isActiveWrap == false ? 'inactive' : 'active';
      console.log('Wrap info', this.infowrap);
      },

      updateProtein (){
        this.infoprotein =  this.isActiveProtein == false ? 'inactive' : 'active';
        console.log('Wrap info', this.infoprotein);
      },

      optionSelect(event){
         this.selectedEvent = event.target.value;
        console.log('Index function is',selectedEvent);
      },

      AddMore(){
        if(this.categoryname == ''){
          toast.info('Please Add a Category Name', {
            hideProgressBar:true,
            timeout:3000,
          })
          return;
        }
        if(this.count > 0){
          return;
        }
        this.count++;
        // this.subCategories.push([]);
       this.subCategories.push({label: `SubCategory ${this.count}`, value: ''});

      },

      RemoveItem(index){
        this.subCategories.splice(index,1);
        this.count = 0;
        this.selectedEvent = '';
      },

      // Handle the file drop
      HandleFileDrop(event) {
        event.preventDefault();

        const file = event.dataTransfer.files[0];
        if(file){
            this.file  = file;
        }
        this.previewImage(file);
      },
  
                triggerFileInput() {
                if (!this.$refs || !this.$refs.fileInput) {
                    console.error("File input element not found.");
                    return;
                }
                this.$refs.fileInput.click();
            },

      // Handle file selection (manual file input)
      HandleFileChange(event) {
        const file = event.target.files[0];
        this.previewImage(file);
        if(file){
            this.file = file;
        }
      },
  
      // Preview the selected image
      previewImage(file) {
        const reader = new FileReader();
        reader.onload = () => {
          this.image = reader.result; // Store the image URL for preview
        };
        reader.readAsDataURL(file);
      },
  
      // Handle the form submission
      submitProduct() {
        if (!this.categoryname || !this.infowrap || !this.optionOrg   ) {
          console.log('Please fill out all necessary information');
          toast.info('Required fields still empty',{
            timeout: 2000,
            hideProgressBar:true,
          });
          return;
        }
        // Prepare the form data to send to the backend
        const formData = new FormData();
        formData.append('categoryname', this.categoryname)
        formData.append('categoryitem', this.categoryitem)
        formData.append('optionselect', this.optionOrg)
        formData.append('protein', this.infoprotein)
        formData.append('wraps', this.infowrap)
        this.$emit('submitmodal', formData);
      },
    },
  };
  </script>
  
  <style scoped>
  .uploaded-image {
    max-width: 100%;
    max-height: 100px;
    margin-top: 10px;
  }
  </style>
  
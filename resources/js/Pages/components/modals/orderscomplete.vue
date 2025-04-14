<template>
    <div v-if="isVisible" class="bg-dialog-modal-container">
        <div class="bg-dialog-pad m-1">
            <div class="bg-scrollable">
            <div class="header ms-2 me-2 py-3 d-flex justify-content-between">
                <h1 class="fs-3 fw-bold text-main">Product List</h1>
                <div class="bg-circle" @click="$emit('close')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><!-- Icon from Solar by 480 Design - https://creativecommons.org/licenses/by/4.0/ --><path fill="currentColor" fill-rule="evenodd" d="M12 22c-4.714 0-7.071 0-8.536-1.465C2 19.072 2 16.714 2 12s0-7.071 1.464-8.536C4.93 2 7.286 2 12 2s7.071 0 8.535 1.464C22 4.93 22 7.286 22 12s0 7.071-1.465 8.535C19.072 22 16.714 22 12 22M8.97 8.97a.75.75 0 0 1 1.06 0L12 10.94l1.97-1.97a.75.75 0 0 1 1.06 1.06L13.06 12l1.97 1.97a.75.75 0 1 1-1.06 1.06L12 13.06l-1.97 1.97a.75.75 0 1 1-1.06-1.06L10.94 12l-1.97-1.97a.75.75 0 0 1 0-1.06" clip-rule="evenodd"/></svg>                    </div>
            </div>
            <div class="bg-scrollable-meal mb-4">
                <div  v-if="loading" class="d-flex ">
                    <div style="background:#f1f1f1; height:12px; width:100%"></div>
                    <div class="rounded">
                        <div class="flex mb-4 w-100">
                            <Skeleton shape="circle" size="4rem" class="mr-2 shimmer-color"></Skeleton>
                            <div>
                                <Skeleton width="10rem" class="mb-2 shimmer-color p-4" style="background-color: #f1f1f1"></Skeleton>
                                <Skeleton width="5rem" class="mb-2 p-4 shimmer-padding"  style="background-color: #f1f1f1"></Skeleton>
                                <Skeleton height=".5rem" class="p-4"  style="background-color: #f1f1f1"></Skeleton>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-else-if="ModalData" class="meal-details mb-5">
                    <div v-for="(item, index) in ModalData" :key="index.id" class="mb-4">
                        <div class="d-flex justify-content-between mb-3 align-items-center">
                            <span>Meal:</span>
                            <div class="d-flex gap-3 align-items-center">
                                <img :src="item.cartimage" alt="Meal Image" style="width:40px;height:40px" class="mb-2 "/>
                                <h2 class="fw-bold fs-5 text-main">{{ item.productname }}</h2>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Price:</span>
                            <p class="fw-bold fs-5 text-main">₦{{ formattedPrice(item.price) }}</p>
                        </div>

                        <div class="d-flex justify-content-between mb-3">
                            <span>Total:</span>
                            <p class="fw-bold fs-5 text-main">₦{{ formattedPrice(item.ntotal) }}</p>
                        </div>

                        <div class="d-flex justify-content-between mb-3">
                            <span>Weight:</span>
                            <p class="fw-bold fs-5 text-main">{{ item.cartweight }}</p>
                        </div>

                        <div class="d-flex justify-content-between mb-3">
                            <span>Drink </span>
                          <div v-if="item.option != ''">
                            <img :src="item.option" alt="Meal Image" style="width:40px;height:40px" class="mb-2 "/>
                          </div>
                          <div v-else>
                            <span class="fw-bold fs-5 text-main">No Drinks Selected</span>
                          </div>
                        </div>
                        <hr />
                      </div>
                  </div>
            </div>
      <!-- button -->

      <div :class="[loadingstate ? 'bg-lazyloading text-center  p-3 cursor-not-allowed mb-3 opacityloading' : 'bg-button-submit-secondary text-center p-3 cursor-pointer mb-3']"  @click=" !loadingstate && approveOrder(approveOrder(ModalData[0]?.cartrefcode))">
        <span class="text-white">{{loadingstate ? 'Loading....' : 'Accept Order'}}</span>
      </div>

      <div :class="[isLoading ? 'bg-lazyloading  text-center p-3  cursor-not-allowed' : 'bg-button-light text-center  p-3 cursor-pointer']"  @click="submitrequest( !isLoading &&  submitrequest(ModalData[0]?.cartrefcode))" :disable="loadingstate">
        <span class="text-white">{{isLoading ? 'Loading....' : 'Reject If Not Available'}}</span>
      </div>
      <!-- end of button -->
        </div>
       </div>
    </div>
</template>

<script>

import {ref} from 'vue';
import axios from 'axios';
import { useToast } from 'vue-toastification';
import { Inertia } from '@inertiajs/inertia';
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

export default{
    props:{
        isVisible:Boolean,
        ModalData:Array,
        loading:Boolean,
    },
    methods:{
        closeModal(){
            this.$emit('close');
        },
        formattedPrice(price){
         if(price == ""  ||  price == undefined) return;
         return parseFloat(price).toLocaleString('en-NG', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
         });
        }
    },
   setup(props, {emit}){
    const isLoading = ref(false);
    const loadingstate = ref(false);
    const toast = useToast();
    const delay = (ms) => new Promise(resolve => setTimeout(resolve, ms));
    const closeModal = () =>{
      emit('close');
    };

    const approveOrder =  async (cartrefcode) => {
        if(loadingstate.value){
            console.log('function already in loading state');
            return;
        }
        loadingstate.value = true;
        await delay(3000);
        const payload  = {
           cartstatusreport: 'accepted',   
           cartrefparam:  cartrefcode
        }
       try{
        const response = await axios.post('/vendorspath/updatetrackgoods', payload,{
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json',
            },
        });
        if(response.status){
            const toast = useToast();
            toast.success(response.data.message,{
                hideProgressBar:true,
                timeout:3000,
            });

            await delay(1000);
            console.log(response.status);
            Inertia.reload();
        }else{
            toast.info(response.data.message,{
                hideProgressBar:true,
                timeout:3000,
            });
        }
       }catch(error){
        console.log('Error', error);
       }
        finally{
            loadingstate.value = false;
        }

    };

    const submitrequest = async (cartrefcode) => {
    try {
        if(isLoading.value) return null; 
      isLoading.value = true;
        const payload = {
            itemupdate: "pending",
            cartref: cartrefcode, // Use the first cartrefcode
        };
        const response = await axios.post('/vendorspath/rejectorder', payload, {
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json',
            },
        });

        if (response.status === 200) {
            if (response.data.status === "success") {
                toast.success(response.data.message, {
                    timeout: 2000,
                    hideProgressBar: true,
                });
                closeModal();
            } else {
                toast.info(response.data.message, {
                    timeout: 2000,
                    hideProgressBar: true,
                });
                closeModal();
            }
            Inertia.reload();
        } else {
            console.log('Unexpected status code:', response.status);
        }
    } catch (error) {
        console.error('Error occurred:', error);
        toast.error('An error occurred while processing your request.');
    } finally {
        isLoading.value = false;
    }
};
    return {
        isLoading,
        submitrequest,
        closeModal,
        approveOrder,
        loadingstate
    }
   }
}
</script>


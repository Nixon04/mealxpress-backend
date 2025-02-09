<script setup>
import './assets/css/navnew.css';
import {useRefNav} from './yreact/navstate';
import {storeToRefs} from 'pinia';
import { Link } from '@inertiajs/inertia-vue3';


const navbarcheck = useRefNav();
const {navItems,isVisible} = storeToRefs(navbarcheck)
const {toggle} =  navbarcheck;

defineProps({
Link,
})
</script>

<template>
    <div class="navbar-design-container">
        <div class="navdex">
            <div class="navnewlogo">
                <span>Mealxpress</span>
            </div>
            <div class="navnewcontents">
                <ul class="navnew-dex" v-for="(item, index) in navItems" :key="index.index">
                    <li><Link href="">{{item.index}}</Link></li>
                 </ul>
            </div>
            <div class="navnewextra">
                <span class="desktopscene">Eatery</span>
                <span class="mobilescene" @click="toggle"> ☰</span>
            </div>
        </div>


        <div class="newmobile" v-if="isVisible">
           <div class="newmobilelaps">
            <ul class="navnew-dex" v-for="(item, index) in navItems" :key="index.index">
                <li><Link href="">{{item.index}}</Link></li>
             </ul>
         </div>
        </div>
    </div>

   

</template>


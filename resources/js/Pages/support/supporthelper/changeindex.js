import {defineStore} from 'pinia';
import {ref} from 'vue';


export const usePackageStore = defineStore('package', () => {
   const activeIndex = ref(null);
   const packages = ref(
    [
        'Who are we?',
        'What services do we offer?',
        'How can you contact us?',
        'What is our mission?',
        'How to join our team?',
    ]
   );
   const changeIndex = (index) => {
    activeIndex.value = index;
    console.log(` items count ${packages.value[activeIndex.value]}`);
   }

   return  {changeIndex, activeIndex, packages};
});
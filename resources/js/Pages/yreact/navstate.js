import { defineStore } from 'pinia';
import { ref } from 'vue';

export const useRefNav = defineStore('store', () => {
  // Navbar state
  const isVisible = ref(false);
  const navbarHeight = ref('0');
  const topPosition = ref(0);
  const backgroundColor = ref('#2D2942');
  const backdropBlur = ref('blur(0px)');
  const backdropFilter = ref('blur(0px)');
  const boxShadow = ref('0 0 0 rgba(255, 255, 255, 0)');
  const color = ref('#fff');
  const navItems = ref([
    {
      name: 'Products',
      linkid: '/about',
    },
    {
      name: 'Drivers',
      linkid: '/occupations/drivers',
    },
    {
      name: 'Vendors',
      linkid: '/occupations/vendors',
    },
    {
      name: 'Faqs',
      linkid: '/support/faqs',
    },
    {
      name: 'Contact',
      linkid: '/support/contact',
    },
  ]);
  

  const toggle = () => {
    isVisible.value = !isVisible.value;
  };

  const handleScroll = () => {
    const scrollPosition = window.scrollY;
    if (scrollPosition > 100) {
      topPosition.value = 0;
      backgroundColor.value = 'transparent';
      backdropBlur.value = 'blur(45px)';
      backdropFilter.value = 'blur(7.9px)';
      boxShadow.value = '0 4px 30px rgba(0, 0, 0, 0.1)';
      color.value = "#2D2942";
    } else {
      topPosition.value = 0;
      backgroundColor.value = '#2D2942';
      backdropBlur.value = 'blur(45px)';
      backdropFilter.value = 'blur(0px)';
      boxShadow.value = '0 0 0 rgba(255, 255, 255, 0)';
      color.value = "#fff";
    }
  };

  return {
    isVisible,
    navbarHeight,
    topPosition,
    backgroundColor,
    backdropBlur,
    backdropFilter,
    boxShadow,
    color,
    navItems,
    toggle,
    handleScroll
  };
});

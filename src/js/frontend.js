console.log("test");
// core version + navigation, pagination modules:
import Swiper from 'swiper';
import { Navigation, Pagination, Scrollbar } from 'swiper/modules';
// import Swiper and modules styles
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'swiper/css/scrollbar';

// Initialize Swiper when DOM is ready
document.addEventListener('DOMContentLoaded', function() {

  
  // Configure Swiper to use modules
  Swiper.use([Navigation, Pagination, Scrollbar]);
  
  const swiperElement = document.querySelector('.swiper');
  console.log("Swiper Element:", swiperElement);
  if (swiperElement) {
    const swiper = new Swiper('.swiper', {
      // Optional parameters
      loop: true,
      
      // Configure modules
      modules: [Navigation, Pagination, Scrollbar],

      // Items per slide
      slidesPerView: 3, // Show 3 slides at once
      spaceBetween: 20, // Space between slides in px
      
      // Responsive breakpoints
      breakpoints: {
        // when window width is >= 320px
        320: {
          slidesPerView: 1,
          spaceBetween: 10
        },
        // when window width is >= 768px
        768: {
          slidesPerView: 2,
          spaceBetween: 15
        },
        // when window width is >= 1024px
        1024: {
          slidesPerView: 3,
          spaceBetween: 20
        }
      },

      // If we need pagination
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
        dynamicBullets: false, // Dynamic pagination bullets
      },

      // Navigation arrows
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
    console.log(swiper);
  }
});

// core version + navigation, pagination modules:
import Swiper from 'swiper';
import { Navigation, Pagination, Scrollbar } from 'swiper/modules';
// import Swiper and modules styles
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'swiper/css/scrollbar';


import languageSwitcher from './componetns/language-switcher';

// Initialize Swiper when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
  // Configure Swiper to use modules
  Swiper.use([Navigation, Pagination, Scrollbar]);
  
  // Initialize all swiper elements
  const swiperElements = document.querySelectorAll('.swiper');
  
  swiperElements.forEach((swiperElement) => {

    // Get configuration from data attribute
    let config = {
      // Default configuration
      loop: true,
      modules: [Navigation, Pagination, Scrollbar],
      slidesPerView: 1,
      spaceBetween: 20,
      breakpoints: {
        768: {
          slidesPerView: 2,
          spaceBetween: 20
        },
        1024: {
          slidesPerView: 3,
          spaceBetween: 30
        }
      },
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
        dynamicBullets: false,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    };

    // Override with custom configuration if provided
    const customConfig = swiperElement.getAttribute('data-swiper-config');
    if (customConfig) {
      try {
        const parsedConfig = JSON.parse(customConfig);
        config = { ...config, ...parsedConfig };
        
        // Merge breakpoints properly
        if (parsedConfig.breakpoints) {
          config.breakpoints = { ...config.breakpoints, ...parsedConfig.breakpoints };
        }
        
        console.log("Using custom Swiper config:", config);
      } catch (e) {
        console.error("Error parsing Swiper config:", e);
      }
    }

    // Always scope navigation and pagination to this specific slider
    const nextButton = swiperElement.querySelector('.swiper-button-next');
    const prevButton = swiperElement.querySelector('.swiper-button-prev');
    const pagination = swiperElement.querySelector('.swiper-pagination');
    
    // Only add navigation if elements exist
    if (nextButton && prevButton) {
      config.navigation = {
        nextEl: nextButton,
        prevEl: prevButton,
      };
    } else {
      // Remove navigation if elements don't exist
      delete config.navigation;
    }
    
    // Only add pagination if element exists
    if (pagination) {
      config.pagination = {
        el: pagination,
        clickable: true,
        dynamicBullets: false
        
      };
    } else {
      // Remove pagination if element doesn't exist
      delete config.pagination;
    }
    
    config.on ={
       init: function () {
       
       swiperElement.querySelectorAll(':scope > .swiper-wrapper > div').forEach(child => {
          if (!child.classList.contains('swiper-slide')) {
            console.log(child)
            child.classList.add('swiper-slide');
          }
        });
    },
    }

    // Initialize Swiper with the configuration
    const swiper = new Swiper(swiperElement, config);
    
    // Force show navigation arrows if they exist and ensure they stay visible
    if (nextButton && prevButton) {
      // Make sure navigation is visible immediately
      nextButton.style.display = 'flex';
      prevButton.style.display = 'flex';
      
      // Add custom event listeners to ensure navigation stays visible
      swiper.on('init', function() {
        console.log("Swiper initialized with custom navigation for:", swiperElement.id);
       
        
        if (nextButton) nextButton.style.display = 'flex';
        if (prevButton) prevButton.style.display = 'flex';
      });
      
      swiper.on('slideChange', function() {
        if (nextButton) nextButton.style.display = 'flex';
        if (prevButton) prevButton.style.display = 'flex';
      });
      
      swiper.on('reachEnd', function() {
        if (nextButton) nextButton.style.display = 'flex';
        if (prevButton) prevButton.style.display = 'flex';
      });
      
      swiper.on('reachBeginning', function() {
        if (nextButton) nextButton.style.display = 'flex';
        if (prevButton) prevButton.style.display = 'flex';
      });
    }
    
    
  });

  languageSwitcher();
  
});
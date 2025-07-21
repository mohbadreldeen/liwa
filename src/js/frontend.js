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
    initializeSingleSwiper(swiperElement);
  });

  languageSwitcher();
  
  // Initialize hamburger menu
  initHamburgerMenu();
  
  // Initialize extended tabs
  // initLiwaTabs();
  // initExtendedNativeTabs();
  
  // Initialize simple tabs
  initSimpleLiwaTabs();
  
});

/**
 * Extended Tabs with Images Functionality
 * Handles initialization and interaction for Liwa extended tabs
 */
function initLiwaTabs() {
  const tabContainers = document.querySelectorAll('.liwa-tabs-container');
  
  tabContainers.forEach(container => {
    liwaInitTabs(container);
  });
}

// Global function to initialize a single tab container
window.liwaInitTabs = function(container) {
  if (!container) return;
  
  const tabPanes = container.querySelectorAll('.liwa-tab-pane');
  const tabNav = container.querySelector('.liwa-tabs-nav');
  const imageSize = container.dataset.imageSize || '24';
  const activeTabIndex = parseInt(container.dataset.activeTab || '1') - 1;
  const animateIcons = container.dataset.animateIcons === 'yes';
  
  // Clear existing navigation
  tabNav.innerHTML = '';
  
  // Create tab navigation
  tabPanes.forEach((pane, index) => {
    const li = document.createElement('li');
    const a = document.createElement('a');
    
    a.href = 'javascript:void(0)'; // Prevent page jumping
    a.dataset.tabIndex = index;
    
    // Add active class to the specified tab
    if (index === activeTabIndex) {
      a.classList.add('active');
      pane.classList.add('active');
    }
    
    // Create tab content structure
    const title = pane.dataset.tabTitle || `Tab ${index + 1}`;
    const imageId = pane.dataset.tabImage;
    const iconClass = pane.dataset.tabIcon;
    
    // Add image if provided
    if (imageId) {
      const img = document.createElement('img');
      img.classList.add('liwa-tab-image');
      img.style.width = imageSize + 'px';
      img.style.height = imageSize + 'px';
      img.src = imageId; // imageId now contains the full URL
      img.alt = title;
      img.onerror = function() {
        // Hide image if it fails to load
        this.style.display = 'none';
      };
      
      a.appendChild(img);
    }
    // Add icon if provided and no image
    else if (iconClass) {
      const icon = document.createElement('i');
      icon.className = iconClass + ' liwa-tab-icon';
      icon.style.fontSize = imageSize + 'px';
      a.appendChild(icon);
    }
    
    // Add title
    const titleSpan = document.createElement('span');
    titleSpan.classList.add('liwa-tab-title');
    titleSpan.textContent = title;
    a.appendChild(titleSpan);
    
    // Add click event listener
    a.addEventListener('click', function(e) {
      e.preventDefault();
      activateTab(container, index);
    });
    
    // Add keyboard navigation
    a.addEventListener('keydown', function(e) {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        activateTab(container, index);
      } else if (e.key === 'ArrowLeft' || e.key === 'ArrowRight') {
        e.preventDefault();
        const currentIndex = Array.from(tabNav.querySelectorAll('a')).indexOf(this);
        let newIndex;
        
        if (e.key === 'ArrowLeft') {
          newIndex = currentIndex > 0 ? currentIndex - 1 : tabPanes.length - 1;
        } else {
          newIndex = currentIndex < tabPanes.length - 1 ? currentIndex + 1 : 0;
        }
        
        tabNav.querySelectorAll('a')[newIndex].focus();
      }
    });
    
    // Set accessibility attributes
    a.setAttribute('role', 'tab');
    a.setAttribute('aria-selected', index === activeTabIndex ? 'true' : 'false');
    a.setAttribute('aria-controls', pane.id || `tab-pane-${index}`);
    a.setAttribute('tabindex', index === activeTabIndex ? '0' : '-1');
    
    li.appendChild(a);
    tabNav.appendChild(li);
  });
  
  // Set up tab panes with proper accessibility
  tabPanes.forEach((pane, index) => {
    pane.setAttribute('role', 'tabpanel');
    pane.setAttribute('aria-labelledby', `tab-${index}`);
    if (!pane.id) {
      pane.id = `tab-pane-${index}`;
    }
  });
  
  // Set tablist role on navigation
  tabNav.setAttribute('role', 'tablist');
};

// Function to activate a specific tab
function activateTab(container, index) {
  const tabPanes = container.querySelectorAll('.liwa-tab-pane');
  const tabLinks = container.querySelectorAll('.liwa-tabs-nav a');
  
  // Remove active class from all tabs and panes
  tabLinks.forEach(link => {
    link.classList.remove('active');
    link.setAttribute('aria-selected', 'false');
    link.setAttribute('tabindex', '-1');
  });
  
  tabPanes.forEach(pane => {
    pane.classList.remove('active');
  });
  
  // Add active class to selected tab and pane
  if (tabLinks[index]) {
    tabLinks[index].classList.add('active');
    tabLinks[index].setAttribute('aria-selected', 'true');
    tabLinks[index].setAttribute('tabindex', '0');
  }
  
  if (tabPanes[index]) {
    tabPanes[index].classList.add('active');
  }
  
  // Trigger custom event
  const event = new CustomEvent('liwaTabChanged', {
    detail: {
      container: container,
      activeIndex: index,
      activePane: tabPanes[index],
      activeLink: tabLinks[index]
    }
  });
  container.dispatchEvent(event);
}

// Handle hash-based tab activation
window.addEventListener('hashchange', function() {
  const hash = window.location.hash;
  if (hash.startsWith('#tab-')) {
    const tabId = hash.substring(1);
    const targetPane = document.getElementById(tabId);
    if (targetPane && targetPane.classList.contains('liwa-tab-pane')) {
      const container = targetPane.closest('.liwa-tabs-container');
      const panes = Array.from(container.querySelectorAll('.liwa-tab-pane'));
      const index = panes.indexOf(targetPane);
      if (index !== -1) {
        activateTab(container, index);
      }
    }
  }
});

 
 
// Advanced Tabs Functionality
// ============================

/**
 * Simple Liwa Tabs Functionality
 * Handles initialization and interaction for simple Liwa tabs
 */
function initSimpleLiwaTabs() {
  const tabContainers = document.querySelectorAll('.liwa-tabs');
  
  tabContainers.forEach(container => {
    initSimpleTabContainer(container);
  });
}

// Function to initialize a single simple tab container
function initSimpleTabContainer(container) {
  if (!container || container.hasAttribute('data-tabs-initialized')) return;
  
  const navItems = container.querySelectorAll('.liwa-tab-nav-item');
  const contentItems = container.querySelectorAll('.liwa-tab-content-item');
  
  if (navItems.length === 0 || contentItems.length === 0) return;
  
  // Mark as initialized
  container.setAttribute('data-tabs-initialized', 'true');
  
  // Add global click prevention for any links in tab navigation
  container.addEventListener('click', function(e) {
    if (e.target.closest('.liwa-tabs-nav')) {
      // If clicked element is a link or inside a link
      const link = e.target.tagName === 'A' ? e.target : e.target.closest('a');
      if (link && (link.getAttribute('href') === '#' || link.getAttribute('href') === '')) {
        e.preventDefault();
        e.stopPropagation();
      }
    }
  });
  
  // Set up accessibility attributes
  setupSimpleTabsAccessibility(container, navItems, contentItems);
  
  // Add click event listeners
  navItems.forEach((navItem, index) => {
    navItem.addEventListener('click', function(e) {
      e.preventDefault();
      e.stopPropagation();
      // Prevent any default behavior that could cause scrolling
      if (e.target.tagName === 'A') {
        e.target.blur();
      }
      activateSimpleTab(container, index, navItems, contentItems);
    });
    
    // Also prevent clicks on any child links
    navItem.addEventListener('click', function(e) {
      if (e.target.tagName === 'A' || e.target.closest('a')) {
        e.preventDefault();
        e.stopPropagation();
      }
    }, true); // Use capture phase
    
    // Add keyboard navigation
    navItem.addEventListener('keydown', function(e) {
      handleSimpleTabKeydown(e, container, index, navItems, contentItems);
    });
  });
  
  // Initialize with the first active tab or default to first tab
  let activeIndex = 0;
  navItems.forEach((item, index) => {
    if (item.classList.contains('active')) {
      activeIndex = index;
    }
  });
  
  activateSimpleTab(container, activeIndex, navItems, contentItems);
  
  // Handle hash-based navigation
  handleSimpleTabHashNavigation(container, navItems, contentItems);
}

// Set up accessibility attributes for simple tabs
function setupSimpleTabsAccessibility(container, navItems, contentItems) {
  const navContainer = container.querySelector('.liwa-tabs-nav');
  if (navContainer) {
    navContainer.setAttribute('role', 'tablist');
  }
  
  navItems.forEach((navItem, index) => {
    navItem.setAttribute('role', 'tab');
    navItem.setAttribute('aria-controls', `liwa-tabpanel-${index}`);
    navItem.setAttribute('id', `liwa-tab-${index}`);
    navItem.setAttribute('tabindex', '-1');
  });
  
  contentItems.forEach((contentItem, index) => {
    contentItem.setAttribute('role', 'tabpanel');
    contentItem.setAttribute('aria-labelledby', `liwa-tab-${index}`);
    contentItem.setAttribute('id', `liwa-tabpanel-${index}`);
    contentItem.setAttribute('tabindex', '0');
  });
}

// Activate a specific simple tab
function activateSimpleTab(container, index, navItems, contentItems) {
  if (index < 0 || index >= navItems.length) return;
  
  // Add loading state
  container.classList.add('liwa-tabs-loading');
  
  // Remove active classes from all items
  navItems.forEach((item, i) => {
    item.classList.remove('active');
    item.setAttribute('aria-selected', 'false');
    item.setAttribute('tabindex', '-1');
  });
  
  contentItems.forEach((item) => {
    item.classList.remove('active');
  });
  
  // Add active class to selected items
  navItems[index].classList.add('active');
  navItems[index].setAttribute('aria-selected', 'true');
  navItems[index].setAttribute('tabindex', '0');
  
  // Use setTimeout to allow for smooth animation
  setTimeout(() => {
    contentItems[index].classList.add('active');
    container.classList.remove('liwa-tabs-loading');
    
    // Reinitialize Swiper sliders in the newly active tab
    reinitializeSwiperInTab(contentItems[index]);
    
    // Focus management for accessibility - but prevent scrolling
    if (document.activeElement === navItems[index]) {
      contentItems[index].focus({ preventScroll: true });
    }
    
    // Dispatch custom event
    const event = new CustomEvent('liwaSimpleTabChanged', {
      detail: {
        container: container,
        activeIndex: index,
        activeNavItem: navItems[index],
        activeContentItem: contentItems[index]
      }
    });
    container.dispatchEvent(event);
  }, 50);
}

// Handle keyboard navigation for simple tabs
function handleSimpleTabKeydown(e, container, currentIndex, navItems, contentItems) {
  let newIndex = currentIndex;
  e.preventDefault();
  e.stopPropagation();
  
  switch (e.key) {
    case 'ArrowLeft':
    case 'ArrowUp':
      
      newIndex = currentIndex > 0 ? currentIndex - 1 : navItems.length - 1;
      break;
    case 'ArrowRight':
    case 'ArrowDown':
      newIndex = currentIndex < navItems.length - 1 ? currentIndex + 1 : 0;
      break;
    case 'Home':
      newIndex = 0;
      break;
    case 'End':
      newIndex = navItems.length - 1;
      break;
    case 'Enter':
    case ' ':
      activateSimpleTab(container, currentIndex, navItems, contentItems);
      return;
    default:
      return false; // Ignore other keys
  }
  navItems[newIndex].focus();
}

// Handle hash-based navigation for simple tabs
function handleSimpleTabHashNavigation(container, navItems, contentItems) {
  const hash = window.location.hash;
  if (hash) {
    const targetPanel = container.querySelector(hash);
    if (targetPanel && targetPanel.classList.contains('liwa-tab-content-item')) {
      const index = Array.from(contentItems).indexOf(targetPanel);
      if (index !== -1) {
        activateSimpleTab(container, index, navItems, contentItems);
      }
    }
  }
}

// Global function to programmatically activate a tab
window.liwaActivateSimpleTab = function(containerId, tabIndex) {
  const container = document.getElementById(containerId);
  if (!container) return;
  
  const navItems = container.querySelectorAll('.liwa-tab-nav-item');
  const contentItems = container.querySelectorAll('.liwa-tab-content-item');
  
  activateSimpleTab(container, tabIndex, navItems, contentItems);
};

// Handle responsive behavior
function handleSimpleTabsResponsive() {
  const tabContainers = document.querySelectorAll('.liwa-tabs');
  
  tabContainers.forEach(container => {
    const isSmallScreen = window.innerWidth <= 480;
    
    if (isSmallScreen) {
      container.classList.add('accordion-mobile');
      
      // Add data-title attributes for accordion headers
      const navItems = container.querySelectorAll('.liwa-tab-nav-item');
      const contentItems = container.querySelectorAll('.liwa-tab-content-item');
      
      contentItems.forEach((item, index) => {
        const title = navItems[index] ? navItems[index].textContent.trim() : `Tab ${index + 1}`;
        item.setAttribute('data-title', title);
      });
    } else {
      container.classList.remove('accordion-mobile');
    }
  });
}

// Add resize listener for responsive behavior
window.addEventListener('resize', handleSimpleTabsResponsive);

// Initialize responsive behavior on load
document.addEventListener('DOMContentLoaded', handleSimpleTabsResponsive);

class LiwaAdvancedTabs {
  constructor(container) {
    this.container = container;
    this.tabLinks = container.querySelectorAll('.liwa-tab-item a');
    this.tabContents = container.querySelectorAll('.liwa-tab-content');
    this.autoRotate = container.dataset.autoRotate === 'Enable';
    this.interval = parseInt(container.dataset.interval) || 5000;
    this.activeIndex = parseInt(container.dataset.activeIndex) - 1 || 0;
    this.animation = container.dataset.animation || 'Slide';
    this.responsiveType = container.dataset.responsiveType || 'Tabs';
    this.responsiveWidth = parseInt(container.dataset.responsiveWidth) || 768;
    this.smoothScroll = container.dataset.smoothScroll === 'on';
    this.autoRotateTimer = null;
    
    this.init();
  }
  
  init() {
    this.setupInitialState();
    this.bindEvents();
    this.setupResponsive();
    
    if (this.autoRotate) {
      this.startAutoRotate();
    }
  }
  
  setupInitialState() {
    // Set initial active tab
    this.setActiveTab(this.activeIndex);
    
    // Setup hover effects for icons
    this.tabLinks.forEach(link => {
      const icon = link.querySelector('.liwa-tab-icon');
      if (icon) {
        const normalColor = icon.dataset.normalColor;
        const hoverColor = icon.dataset.hoverColor;
        
        link.addEventListener('mouseenter', () => {
          if (hoverColor) icon.style.color = hoverColor;
        });
        
        link.addEventListener('mouseleave', () => {
          if (!link.closest('.liwa-tab-item').classList.contains('active')) {
            if (normalColor) icon.style.color = normalColor;
          }
        });
      }
    });
  }
  
  bindEvents() {
    this.tabLinks.forEach((link, index) => {
      link.addEventListener('click', (e) => {
        e.preventDefault();
        this.setActiveTab(index);
        
        if (this.autoRotate) {
          this.restartAutoRotate();
        }
        
        if (this.smoothScroll) {
          this.scrollToContent();
        }
      });
    });
    
    // Keyboard navigation
    this.container.addEventListener('keydown', (e) => {
      if (e.key === 'ArrowLeft' || e.key === 'ArrowRight') {
        e.preventDefault();
        const direction = e.key === 'ArrowLeft' ? -1 : 1;
        const newIndex = (this.activeIndex + direction + this.tabLinks.length) % this.tabLinks.length;
        this.setActiveTab(newIndex);
      }
    });
  }
  
  setActiveTab(index) {
    if (index < 0 || index >= this.tabLinks.length) return;
    
    // Remove active class from all tabs and contents
    this.tabLinks.forEach(link => {
      link.closest('.liwa-tab-item').classList.remove('active');
      link.classList.remove('active');
    });
    this.tabContents.forEach(content => {
      content.classList.remove('active');
    });
    
    // Add active class to selected tab and content
    const activeTabItem = this.tabLinks[index].closest('.liwa-tab-item');
    const activeLink = this.tabLinks[index];
    const activeContent = this.tabContents[index];
    
    if (activeTabItem) activeTabItem.classList.add('active');
    if (activeLink) activeLink.classList.add('active');
    if (activeContent) {
      activeContent.classList.add('active');
      
      // Apply animation
      this.applyAnimation(activeContent);
    }
    
    // Update hover states
    this.updateHoverStates(activeLink);
    
    this.activeIndex = index;
    
    // Dispatch custom event
    const event = new CustomEvent('liwa-tab-changed', {
      detail: { activeIndex: index, activeContent, activeLink }
    });
    this.container.dispatchEvent(event);
  }
  
  applyAnimation(content) {
    content.style.opacity = '0';
    content.style.transform = this.getAnimationTransform();
    
    requestAnimationFrame(() => {
      content.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
      content.style.opacity = '1';
      content.style.transform = 'translateX(0) translateY(0)';
    });
  }
  
  getAnimationTransform() {
    switch (this.animation) {
      case 'Fade':
        return 'translateX(0) translateY(0)';
      case 'Slide-Zoom':
        return 'translateX(20px) translateY(10px) scale(0.95)';
      default: // Slide
        return 'translateX(20px) translateY(0)';
    }
  }
  
  updateHoverStates(activeLink) {
    const icon = activeLink.querySelector('.liwa-tab-icon');
    if (icon) {
      const hoverColor = icon.dataset.hoverColor;
      if (hoverColor) icon.style.color = hoverColor;
    }
  }
  
  startAutoRotate() {
    this.autoRotateTimer = setInterval(() => {
      const nextIndex = (this.activeIndex + 1) % this.tabLinks.length;
      this.setActiveTab(nextIndex);
    }, this.interval);
  }
  
  stopAutoRotate() {
    if (this.autoRotateTimer) {
      clearInterval(this.autoRotateTimer);
      this.autoRotateTimer = null;
    }
  }
  
  restartAutoRotate() {
    this.stopAutoRotate();
    this.startAutoRotate();
  }
  
  scrollToContent() {
    const contentContainer = this.container.querySelector('.liwa-tabs-content');
    if (contentContainer) {
      contentContainer.scrollIntoView({ 
        behavior: 'smooth', 
        block: 'nearest' 
      });
    }
  }
  
  setupResponsive() {
    const checkResponsive = () => {
      const isResponsive = window.innerWidth <= this.responsiveWidth;
      
      if (isResponsive && this.responsiveType === 'Accordion') {
        this.convertToAccordion();
      } else {
        this.convertToTabs();
      }
    };
    
    checkResponsive();
    window.addEventListener('resize', checkResponsive);
  }
  
  convertToAccordion() {
    // Add accordion behavior
    this.tabContents.forEach((content, index) => {
      const title = this.tabLinks[index].textContent;
      content.setAttribute('data-title', title);
    });
  }
  
  convertToTabs() {
    // Remove accordion attributes
    this.tabContents.forEach(content => {
      content.removeAttribute('data-title');
    });
  }
  
  destroy() {
    this.stopAutoRotate();
    // Remove event listeners and cleanup
  }
}

/**
 * Reinitialize Swiper sliders in a newly active tab
 * This fixes the issue where Swiper can't calculate proper dimensions when initially hidden
 */
function reinitializeSwiperInTab(tabContent) {
  if (!tabContent) return;
  
  // Find all Swiper instances in this tab content
  const swiperElements = tabContent.querySelectorAll('.swiper');
  
  swiperElements.forEach((swiperElement) => {
    // Check if this Swiper already has an instance
    if (swiperElement.swiper) {
      // Update the Swiper to recalculate dimensions
      swiperElement.swiper.update();
      swiperElement.swiper.updateSize();
      swiperElement.swiper.updateSlides();
      swiperElement.swiper.updateProgress();
      swiperElement.swiper.updateSlidesClasses();
      
      // Force a resize event to make sure everything is properly sized
      setTimeout(() => {
        if (swiperElement.swiper) {
          swiperElement.swiper.update();
        }
      }, 100);
      
      console.log('Swiper updated for newly active tab:', swiperElement.id);
    } else {
      // If no Swiper instance exists, create one
      initializeSingleSwiper(swiperElement);
    }
  });
}

/**
 * Initialize a single Swiper instance
 * Extracted from the main initialization logic for reuse
 */
function initializeSingleSwiper(swiperElement) {
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
  
  config.on = {
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
  
  return swiper;
}

/**
 * Initialize Hamburger Menu Functionality
 * Handles the mobile menu toggle
 */
function initHamburgerMenu() {
  const menuToggle = document.querySelector('.menu-toggle');
  const mainNavigation = document.querySelector('.main-navigation');
  const hamburgerIcon = document.querySelector('.hamburger-icon');
  
  if (!menuToggle || !mainNavigation) return;
  
  // Handle menu toggle click
  menuToggle.addEventListener('click', function(e) {
    e.preventDefault();
    
    const isExpanded = menuToggle.getAttribute('aria-expanded') === 'true';
    const newState = !isExpanded;
    
    // Update aria-expanded attribute
    menuToggle.setAttribute('aria-expanded', newState);
    
    // Toggle the navigation class
    if (newState) {
      mainNavigation.classList.add('toggled');
      hamburgerIcon.classList.add('active');
    } else {
      mainNavigation.classList.remove('toggled');
      hamburgerIcon.classList.remove('active');
    }
  });
  
  // Close menu when clicking outside
  document.addEventListener('click', function(e) {
    if (!mainNavigation.contains(e.target) && mainNavigation.classList.contains('toggled')) {
      mainNavigation.classList.remove('toggled');
      hamburgerIcon.classList.remove('active');
      menuToggle.setAttribute('aria-expanded', 'false');
    }
  });
  
  // Handle escape key to close menu
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && mainNavigation.classList.contains('toggled')) {
      mainNavigation.classList.remove('toggled');
      hamburgerIcon.classList.remove('active');
      menuToggle.setAttribute('aria-expanded', 'false');
      menuToggle.focus(); // Return focus to toggle button
    }
  });
  
  // Close menu on window resize if it becomes desktop size
  window.addEventListener('resize', function() {
    if (window.innerWidth >= 768 && mainNavigation.classList.contains('toggled')) {
      mainNavigation.classList.remove('toggled');
      hamburgerIcon.classList.remove('active');
      menuToggle.setAttribute('aria-expanded', 'false');
    }
  });
}

// Initialize Advanced Tabs
document.addEventListener('DOMContentLoaded', function() {
  const advancedTabsContainers = document.querySelectorAll('.liwa-advanced-tabs');
  
  advancedTabsContainers.forEach(container => {
    new LiwaAdvancedTabs(container);
  });
});
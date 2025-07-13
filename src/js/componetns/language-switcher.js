// Language Switcher Dropdown Functionality
export default function languageSwitcher(){ 
	console.log('Language Switcher Initialized');
  const languageSwitcher = document.querySelector('.header-language-switcher');
  if (languageSwitcher) {
    const dropdownToggle = languageSwitcher.querySelector('.dropdown-toggle');
    const dropdownMenu = languageSwitcher.querySelector('.dropdown-menu');
    
    if (dropdownToggle && dropdownMenu) {
      // Toggle dropdown on button click
      dropdownToggle.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        const isExpanded = dropdownToggle.getAttribute('aria-expanded') === 'true';
        
        // Close all other dropdowns first
        document.querySelectorAll('.dropdown-toggle[aria-expanded="true"]').forEach(toggle => {
          if (toggle !== dropdownToggle) {
            toggle.setAttribute('aria-expanded', 'false');
            const menu = toggle.nextElementSibling;
            if (menu) menu.classList.remove('show');
          }
        });
        
        // Toggle current dropdown
        dropdownToggle.setAttribute('aria-expanded', !isExpanded);
        dropdownMenu.classList.toggle('show', !isExpanded);
      });
      
      // Close dropdown when clicking outside
      document.addEventListener('click', function(e) {
        if (!languageSwitcher.contains(e.target)) {
          dropdownToggle.setAttribute('aria-expanded', 'false');
          dropdownMenu.classList.remove('show');
        }
      });
      
      // Close dropdown on escape key
      document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
          dropdownToggle.setAttribute('aria-expanded', 'false');
          dropdownMenu.classList.remove('show');
          dropdownToggle.focus();
        }
      });
      
      // Keyboard navigation
      dropdownToggle.addEventListener('keydown', function(e) {
        if (e.key === 'ArrowDown' || e.key === 'Enter' || e.key === ' ') {
          e.preventDefault();
          dropdownToggle.setAttribute('aria-expanded', 'true');
          dropdownMenu.classList.add('show');
          // Focus first menu item
          const firstItem = dropdownMenu.querySelector('a');
          if (firstItem) firstItem.focus();
        }
      });
      
      // Handle arrow key navigation in dropdown
      const dropdownItems = dropdownMenu.querySelectorAll('a');
      dropdownItems.forEach((item, index) => {
        item.addEventListener('keydown', function(e) {
          if (e.key === 'ArrowDown') {
            e.preventDefault();
            const nextIndex = (index + 1) % dropdownItems.length;
            dropdownItems[nextIndex].focus();
          } else if (e.key === 'ArrowUp') {
            e.preventDefault();
            const prevIndex = index === 0 ? dropdownItems.length - 1 : index - 1;
            dropdownItems[prevIndex].focus();
          } else if (e.key === 'Escape') {
            e.preventDefault();
            dropdownToggle.setAttribute('aria-expanded', 'false');
            dropdownMenu.classList.remove('show');
            dropdownToggle.focus();
          }
        });
      });
    }
  }
}
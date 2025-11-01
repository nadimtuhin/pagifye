/**
 * Navigation Component
 *
 * Handles mobile menu toggle and dropdown functionality
 */

import Alpine from 'alpinejs';

Alpine.data('pagifyeNavigation', () => ({
  mobileMenuOpen: false,
  dropdownOpen: null,

  init() {
    // Close mobile menu on escape
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && this.mobileMenuOpen) {
        this.mobileMenuOpen = false;
      }
    });
  },

  toggleMobileMenu() {
    this.mobileMenuOpen = !this.mobileMenuOpen;

    // Prevent body scroll when menu is open
    if (this.mobileMenuOpen) {
      document.body.style.overflow = 'hidden';
    } else {
      document.body.style.overflow = '';
    }
  },

  toggleDropdown(index) {
    this.dropdownOpen = this.dropdownOpen === index ? null : index;
  },

  isDropdownOpen(index) {
    return this.dropdownOpen === index;
  },
}));

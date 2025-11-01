/**
 * FAQ Component
 *
 * Handles accordion functionality
 */

import Alpine from 'alpinejs';

Alpine.data('pagifyeFaq', (openByDefault = null) => ({
  openItem: openByDefault,

  toggle(index) {
    this.openItem = this.openItem === index ? null : index;
  },

  isOpen(index) {
    return this.openItem === index;
  },
}));

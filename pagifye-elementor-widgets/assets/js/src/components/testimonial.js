/**
 * Testimonial Component
 *
 * Handles testimonial switching
 */

import Alpine from 'alpinejs';

Alpine.data('pagifyeTestimonial', (defaultIndex = 0) => ({
  activeIndex: defaultIndex,

  setActive(index) {
    this.activeIndex = index;
  },

  isActive(index) {
    return this.activeIndex === index;
  },
}));

/**
 * Pagifye Elementor Widgets - Main JavaScript
 *
 * This file initializes Alpine.js and loads all interactive components.
 */

import Alpine from 'alpinejs';

// Import Alpine.js components
import './components/navigation';
import './components/pricing';
import './components/faq';
import './components/testimonial';

// Make Alpine available globally
window.Alpine = Alpine;

// Start Alpine
Alpine.start();

/**
 * Initialize widgets when document is ready
 */
document.addEventListener('DOMContentLoaded', function() {
  console.log('Pagifye Elementor Widgets loaded');
});

/**
 * Pricing Component
 *
 * Handles billing period toggle (monthly/annual)
 */

import Alpine from 'alpinejs';

Alpine.data('pagifyePricing', () => ({
  billingPeriod: 'monthly',

  toggleBillingPeriod() {
    this.billingPeriod = this.billingPeriod === 'monthly' ? 'annual' : 'monthly';
  },

  isMonthly() {
    return this.billingPeriod === 'monthly';
  },

  isAnnual() {
    return this.billingPeriod === 'annual';
  },

  getPrice(monthlyPrice, annualPrice) {
    return this.billingPeriod === 'monthly' ? monthlyPrice : annualPrice;
  },
}));

/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './widgets/**/*.php',
    './includes/**/*.php',
    './assets/js/**/*.js',
  ],
  theme: {
    extend: {
      colors: {
        // Pagifye Color Palette
        'pgfy-primary': {
          500: '#8FE35F',
          600: '#7DD44E',
        },
        'pgfy-gray': {
          50: '#F5F7F6',
          400: '#1A2E27',
          500: '#0F2C24',
        },
        'pgfy-neutral-white': '#E8F0ED',
        'pgfy-wireframe': {
          100: '#E8E8E8',
        },
      },
      fontFamily: {
        sans: ['Inter', 'system-ui', 'sans-serif'],
      },
      container: {
        center: true,
        padding: {
          DEFAULT: '1rem',
          sm: '1rem',
          lg: '2rem',
          xl: '2rem',
          '2xl': '2rem',
        },
        screens: {
          sm: '640px',
          md: '768px',
          lg: '1024px',
          xl: '1280px',
          '2xl': '1280px', // Max container width
        },
      },
      spacing: {
        '18': '4.5rem',
        '112': '28rem',
        '128': '32rem',
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('@tailwindcss/typography'),
  ],
}

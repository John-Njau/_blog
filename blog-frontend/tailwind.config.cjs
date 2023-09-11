// /** @type {import('tailwindcss').Config} */

module.exports = {
    // tell tailwind to purge unused css
    content: [
      // Examole content paths
      './index.html',
       './src/**/*.{vue,js,ts,jsx,tsx}'],
  
    theme: {
      extend: {},
    },
    plugins: [],
  };
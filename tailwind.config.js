/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",],
  theme: {
    extend: {
      gridTemplateColumns: {
        // autofill column grid
        'autofill-5': 'repeat(auto-fit, minmax(5rem, 1fr))',
        'autofill-6': 'repeat(auto-fit, minmax(6rem, 1fr))',
        'autofill-7': 'repeat(auto-fit, minmax(7rem, 1fr))',
        'autofill-8': 'repeat(auto-fit, minmax(8rem, 1fr))',
        'autofill-9': 'repeat(auto-fit, minmax(9rem, 1fr))',
      }
    },
  },
  plugins: [],
}


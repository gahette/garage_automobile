/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
      "./assets/Services/**/*.{js,jsx}",
      "./assets/react/**/*.{js,jsx}",
      "./templates/**/*.html.twig"
  ],
    mode: "jit",
  theme: {
    extend: {},
  },
  plugins: [],
}


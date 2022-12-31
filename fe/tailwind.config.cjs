/** @type {import('tailwindcss').Config} */
module.exports = {
  mode: "jit",
  content: [
    "./src/**/*.{js,jsx,ts,tsx}",
  ],
  screenes: {
    sm: "640px",
    md: "768px",
    lg: "1024px",
    xl: "1280px",
  },
  theme: {
    extend: {},
  },
  plugins: [],
}

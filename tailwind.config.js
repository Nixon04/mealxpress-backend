/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {

    fontFamily: {
     sans: ['DM Sans', 'sans-serif'],
    },
   
    extend: {
      colors: {
        bg_main_color: "#2D2942",
        bg_action_color: "#E26900"
      }
    },
  },
  plugins: [],
}


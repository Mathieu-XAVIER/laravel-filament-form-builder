/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./resources/**/*.{js,vue}"],
  prefix: "lnfb-",
  theme: {
    extend: {},
  },
  plugins: [
    require("@tailwindcss/forms")({
      strategy: 'class',
    }),
  ],
}

/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['./resources/**/*.{js,vue}'],
  darkMode: ['selector', '[class~="dark"]'],
  prefix: 'lnfb-',
  theme: {
    extend: {},
  },
  plugins: [
    require('@tailwindcss/forms')({
      strategy: 'class',
    }),
  ],
}

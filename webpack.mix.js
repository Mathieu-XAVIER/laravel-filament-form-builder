let mix = require('laravel-mix')
let tailwindcss = require("tailwindcss")
const path = require('path')

require('./nova.mix')

mix.webpackConfig({
  resolve: {
    alias: {
      '@': path.resolve(__dirname, 'resources/js/'),
    },
  },
});

mix.setPublicPath('dist')
  .js('resources/js/tool.js', 'js')
  .vue({ version: 3 })
  .postCss("resources/css/tool.css", "dist/css", [tailwindcss("tailwind.config.js")])
  .nova('laravel-form-builder');

//mix.copyDirectory('./node_modules/element-plus/lib/theme-chalk/fonts', './dist/assets/fonts');

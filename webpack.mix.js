let mix = require('laravel-mix')
let NovaExtension = require('laravel-nova-devtool')
let tailwindcss = require("tailwindcss")
const path = require('path')

mix.extend('nova', new NovaExtension())

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
  .nova('laravel-form-builder')
  .version();


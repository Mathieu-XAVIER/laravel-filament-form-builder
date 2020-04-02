let mix = require('laravel-mix');

mix.setPublicPath('dist')
  .js('resources/js/tool.js', 'js')
  .sass('resources/sass/tool.scss', 'css')
  .webpackConfig({
    resolve: {
      alias: {
        '@': path.resolve(__dirname, 'resources/js/'),
      },
    },
  });

mix.copyDirectory('./node_modules/element-ui/lib/theme-chalk/fonts', './dist/assets/fonts');

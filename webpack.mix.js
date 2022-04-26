let mix = require('laravel-mix');
let path = require('path');

mix.setPublicPath('dist')
  .js('resources/js/tool.js', 'js').vue({ version: 3 })
  .postCss('resources/css/tool.css', 'dist/css')
  .options({ processCssUrls: false})
  .sourceMaps()
  .webpackConfig({
    externals: {
      vue: 'Vue',
    },
    output: {
      uniqueName: 'vendor/package',
    },
    resolve: {
      alias: {
        '@': path.resolve(__dirname, 'resources/js/'),
      },
    },
  });

//mix.copyDirectory('./node_modules/element-plus/lib/theme-chalk/fonts', './dist/assets/fonts');

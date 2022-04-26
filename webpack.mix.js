const mix = require('laravel-mix');
const path = require('path');

// Stop webpack emmiting .LICENSE.txt files
// See https://webpack.js.org/plugins/terser-webpack-plugin/#extractcomments
mix.options({ terser: { extractComments: false } });

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

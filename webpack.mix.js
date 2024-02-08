const mix = require('laravel-mix');



/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */


mix.js('resources/js/app.js', 'public/js')
  .version()
  .vue({ version: 3 })
  .sass('resources/sass/app.scss', 'public/css')
  .webpackConfig((webpack) => {
    return {
      plugins: [
        new webpack.DefinePlugin({
          VUE_OPTIONS_API: true,
          VUE_PROD_DEVTOOLS: false,
        }),
      ],
    };
  });

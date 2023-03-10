let mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');

mix
  .setPublicPath('public')
  .js('resources/js/tool.js', 'js')
  .sass('resources/sass/tool.scss', 'css').options({
    processCssUrls: false,
    postCss: [ tailwindcss('./tailwind.config.js') ],
});

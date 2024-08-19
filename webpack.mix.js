const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');

mix.js('resources/js/app.js', 'public/js')
   .postCss('resources/css/tailwind.css', 'public/css', [
      tailwindcss('./tailwind.config.js'),
   ]);


   
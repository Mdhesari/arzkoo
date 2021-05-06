const mix = require("laravel-mix");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.disableNotifications();

mix.js("resources/js/app.js", "public/assets/js")
    /*.postCss("resources/css/app.css", "public/css", [
        require("postcss-import"),
        require("autoprefixer"),
    ]) */
    // TODO: autoprefix support for sass (old browsers)
    .sass("resources/sass/app.scss", "public/assets/css")
    .sass("resources/sass/admin-app.scss", "public/assets/css");

if (mix.inProduction()) {
    mix.version();
}

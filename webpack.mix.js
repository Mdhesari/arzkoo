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

mix.js("resources/js/app.js", "public/js")
    .js("./node_modules/swiper/swiper-bundle.min.js", "public/js")
    .postCss("./node_modules/swiper/swiper-bundle.min.css", "public/css")
    .postCss("resources/css/font-awesome.css", "public/css", [
        require("postcss-import"),
        require("autoprefixer"),
    ])
    // TODO: autoprefix support for sass (old browsers)
    .sass("resources/sass/app.scss", "public/css")
    .sass("resources/sass/bootstrap.scss", "public/css")
    .sass("resources/sass/fonts.scss", "public/css")
    .sass("resources/sass/arzkoo.scss", "public/css")
    .sass("resources/sass/tools.scss", "public/css")

if (mix.inProduction()) {
    mix.version();
}

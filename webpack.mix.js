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

mix.options({
        processCssUrls: true
    });

mix.copy('resources/img', 'public/img')
    .copy('resources/fonts', 'public/fonts')
    .js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');

if (mix.inProduction()) {
    mix.webpackConfig({
        module: {
            rules: [
                {
                    test: /\.js?$/,
                    use: [
                        {
                            loader: 'babel-loader',
                            options: mix.config.babel(),
                        },
                    ],
                },
            ],
        },
    });

    mix.disableNotifications();
    mix.version();
} else {
    mix.sourceMaps(false, 'source-map');
}

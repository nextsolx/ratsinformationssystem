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

mix.webpackConfig({
    output: {
        filename: '[name].js',
        chunkFilename: mix.inProduction() ? 'js/[name].[chunkhash].app.js'
            : 'js/[name].app.js',
        publicPath: '/',
    },
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
                // don't exclude node_modules it generate IE11 syntax error
                // exclude /node_modules/
            },
        ],
    },
});

if (mix.inProduction()) {
    mix.disableNotifications();
    mix.version();
} else {
    mix.sourceMaps(false, 'source-map');
}

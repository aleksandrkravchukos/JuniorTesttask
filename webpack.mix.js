const mix = require('laravel-mix');
const path = require('path');

mix.sass('resources/scss/app.sass', 'public/css')
    .js('resources/js/app.js', 'public/js/app.js')
    .webpackConfig({
        module: {
            rules: [
                {
                    test: /\.js$/,
                    exclude: /node_modules/,
                    use: {
                        loader: 'babel-loader',
                        options: {
                            presets: ['@babel/preset-env'],
                            plugins: ['@babel/plugin-proposal-class-properties']
                        }
                    }
                }
            ]
        },
        resolve: {
            alias: {
                '@': path.resolve('resources/js')
            }
        }
    })
    .autoload({
        jquery: ['$', 'window.jQuery', 'jQuery']
    });

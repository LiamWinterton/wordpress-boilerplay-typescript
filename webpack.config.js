var webpack = require('webpack');
var path = require('path');
var ExtractTextPlugin = require('extract-text-webpack-plugin');
var UglifyJsPlugin = require('uglifyjs-webpack-plugin');

var extractPlugin = new ExtractTextPlugin({
    filename: 'stylesheet.css'
});

module.exports = {
    entry: ["babel-polyfill", "./wp-content/themes/boilerplate/lib/js/index.js"],
    devtool: 'cheap-module-source-map',
    output: {
        path: path.resolve('./wp-content/themes/boilerplate/'),
        filename: 'bundle.js',
        publicPath: "/"
    },
    module: {
        rules: [
            {
                test: /\.js$/,
                use: [
                    {
                        loader: 'babel-loader',
                        options: {
                            presets: ['babel-preset-env']
                        }
                    }
                ]
            },
            {
                test: /\.sass$/,
                use: extractPlugin.extract({
                    use: [
                        {
                            loader: 'css-loader'
                        },
                        {
                            loader: 'postcss-loader',
                            options: {
                                sourceMap: false
                            }
                        },
                        {
                            loader: 'resolve-url-loader',
                            options: {
                                sourceMap: false
                            }
                        }, 
                        {
                            loader: 'sass-loader',
                            options: {
                                sourceMap: true,
                                includePaths: ['node_modules']
                            }
                        }
                    ]
                })
            },
            {
                test: /\.(png|jpe?g|svg)$/,
                use: ['url-loader?limit=100000', 'img-loader']
            },
            {
                test: /\.(woff|woff2|eot|ttf)$/,
                use: [
                    {
                        loader: 'url-loader?limit=100000'
                    }
                ]
            }
        ]
    },
    plugins: [
        extractPlugin,
        new webpack.DefinePlugin({ 'process.env.NODE_ENV': '"production"' }),
        new webpack.optimize.UglifyJsPlugin({
            test: /\.js($|\?)/i,
            mangle: true,
            compress: {
                warnings: false,
                pure_getters: true,
                unsafe: true,
                unsafe_comps: true,
                screw_ie8: true
            },
            output: {
                comments: false,
            },
            exclude: [/\.min\.js$/gi] // skip pre-minified libs
        })
    ]
};
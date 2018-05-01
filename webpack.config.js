var path = require('path');
var ExtractTextPlugin = require('extract-text-webpack-plugin');

var extractPlugin = new ExtractTextPlugin({
    filename: 'stylesheet.css'
});

module.exports = {
    entry: "./wp-content/themes/boilerplate/lib/js/index.ts",
    devtool: 'inline-source-map',
    output: {
        path: path.resolve('./wp-content/themes/boilerplate/'),
        filename: 'bundle.js',
        publicPath: "/sites/wordpress-boilerplate/"
    },
    resolve: {
        extensions: ['.tsx', '.ts', '.js']
    },
    module: {
        rules: [
            {
                test: /\.ts$/,
                use: [
                    {
                        loader: 'ts-loader',
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
                                sourceMap: true
                            }
                        },
                        {
                            loader: 'resolve-url-loader',
                            options: {
                                sourceMap: true
                            }
                        }, 
                        {
                            loader: 'sass-loader',
                            options: {
                                sourceMap: true
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
        extractPlugin
    ]
};
const webpack = require('webpack')
const path = require('path')
const ExtractTextPlugin = require('extract-text-webpack-plugin')
const UglifyJsPlugin = require('uglifyjs-webpack-plugin')

module.exports = (env, options) => {
    const isProduction = options.mode === 'production'
    const themeName = 'boilerplate'

    return {
        entry: {
            bundle: path.resolve(__dirname, `./wp-content/themes/${themeName}/lib/js`)
        },
        output: {
            path: path.resolve(__dirname, `./wp-content/themes/${themeName}`),
            filename: 'bundle.js',
            publicPath: '/'
        },
        devServer: {
            compress: false,
            port: 8080
        },
        module: {
            rules: [
                {
					test: /\.js$/,
					exclude: /node_modules/,
					use: {
						loader: 'babel-loader'
					}
                },
                {
					test: /\.sass$/,
					use: ExtractTextPlugin.extract({
						fallback: 'style-loader',
						use: [
							{
								loader: 'css-loader'
							},
							{
								loader: 'postcss-loader',
								options: {
									ident: 'postcss',
									sourceMap: isProduction
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
									sourceMap: isProduction,
									includePaths: ['node_modules']
								}
							}
						]
					})
                },
                {
					test: /\.(png|jpe?g|svg|gif)$/,
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
        optimization: isProduction ? {
			minimizer: [
				new UglifyJsPlugin({
					cache: true,
					parallel: true,
					uglifyOptions: {
					compress: false,
					ecma: 6,
					mangle: true
					},
					sourceMap: true
				})
			]
		} : {},
		plugins: [
			new webpack.DefinePlugin({ 'process.env.NODE_ENV': '"' + options.mode + '"' }),
			new ExtractTextPlugin({ filename: 'stylesheet.css' })
		]
    }
}
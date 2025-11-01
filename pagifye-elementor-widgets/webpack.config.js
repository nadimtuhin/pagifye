const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = (env, argv) => {
  const isProduction = argv.mode === 'production';

  return {
    entry: {
      'pagifye-widgets': './assets/js/src/main.js',
    },
    output: {
      path: path.resolve(__dirname, 'build/js'),
      filename: isProduction ? '[name].min.js' : '[name].js',
    },
    module: {
      rules: [
        {
          test: /\.css$/,
          use: [
            MiniCssExtractPlugin.loader,
            'css-loader',
            'postcss-loader',
          ],
        },
      ],
    },
    plugins: [
      new MiniCssExtractPlugin({
        filename: isProduction
          ? '../css/pagifye-widgets.min.css'
          : '../css/pagifye-widgets.css',
      }),
    ],
    devtool: isProduction ? false : 'source-map',
  };
};

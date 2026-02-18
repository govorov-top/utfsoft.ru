const path = require("path");

const TerserPlugin = require("terser-webpack-plugin");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");

const { merge } = require("webpack-merge");
const common = require("../webpack.common");

// Папка где всё творим
common.context = path.resolve(__dirname, "../../gutenberg-blocks");

// Устанавливаем входные точки
common.entry = {
    gutenberg: "../assets/js/gutenberg.js",
    blocks: "../assets/js/gutenberg-blocks.js",
};

// Настройка файлов на выходе
common.output = {
    clean: true,
    filename: "js/[name].min.js",
    path: path.resolve(__dirname, "../../gutenberg-blocks/assets/min"),
    publicPath: "/wp-content/themes/utfsoft.ru/gutenberg-blocks/min/",
};

// Модули обработчики
const modules = {
    rules: [
        {
            test: /\.(mjs|jsx|js)$/,
            use: ["babel-loader"],
        },
        {
            test: /\.(sa|sc|c)ss$/,
            use: [
                {
                    loader: MiniCssExtractPlugin.loader,
                    options: {
                        publicPath: "/wp-content/themes/utfsoft.ru/assets/min/",
                    },
                },
                { loader: "css-loader" },
                { loader: "postcss-loader" },
                { loader: "resolve-url-loader" },
                {
                    loader: "sass-loader",
                    options: {
                        sourceMap: true,
                    },
                },
            ],
        },
        {
            test: /\.(?:ico|svg|gif|png|jpg|jpeg)$/i,
            type: "asset/resource",
            generator: {
                filename: "img/[hash][ext][query]",
            },
        },
    ],
};

// Плагины
const plugins = [
    new MiniCssExtractPlugin({
        filename: "css/[name].min.css",
        chunkFilename: "css/[id].css",
    }),
];

// Модули для оптимизации
const optimization = {
    minimize: true,
    minimizer: [new TerserPlugin()],
};

module.exports = merge(common, {
    mode: "production",
    target: "browserslist",
    module: modules,
    plugins,
    optimization,
});

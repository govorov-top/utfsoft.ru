const path = require("path");

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
    publicPath: "/wp-content/themes/govorov.top/gutenberg-blocks/min/",
};

// Модули обработчики
const modules = {
    rules: [
        {
            test: /\.(mjs|jsx|js)$/,
            exclude: /(node_modules|bower_components)/,
            use: ["babel-loader"],
        },
        {
            test: /\.(sa|sc|c)ss$/,
            use: [
                MiniCssExtractPlugin.loader,
                "css-loader",
                "resolve-url-loader",
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
                filename: "img/[name][ext][query]",
            },
        },
    ],
};

// Плагины
const plugins = [
    new MiniCssExtractPlugin({
        filename: "css/[name].min.css",
        chunkFilename: "css/[id].css",
        ignoreOrder: false,
    }),
];

// Модули для оптимизации
const optimization = {
    minimize: false,
};

module.exports = merge(common, {
    watch: true,
    mode: "development",
    devtool: "eval",
    module: modules,
    plugins,
    optimization,
});

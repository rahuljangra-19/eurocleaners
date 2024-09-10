const mix = require("laravel-mix");

mix.webpackConfig({
    stats: {
        children: true,
    },
});

mix.scripts(
    [
        "public/assets/js/jquery.js",
        "public/assets/js/bootstrap.bundle.min.js",
        "public/assets/js/jquery-plugin-collection.js",
        "public/assets/js/modernizr.custom.js",
        "public/assets/js/style.js",
    ],
    "public/js/app.js"
).postCss("resources/css/app.css", "public/css", []);

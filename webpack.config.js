const { resolve } = require("path");

const Encore = require("@symfony/webpack-encore");
const sveltePreprocess = require("svelte-preprocess");

// Manually configure the runtime environment if not already configured yet by the "encore" command.
// It's useful when you use tools that rely on webpack.config.js file.
if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || "dev");
}

Encore
    // directory where compiled assets will be stored
    .setOutputPath("public/build/")
    // public path used by the web server to access the output path
    .setPublicPath("/build")
    // only needed for CDN's or sub-directory deploy
    // .setManifestKeyPrefix('build/')

    /*
     * ENTRY CONFIG
     *
     * Each entry will result in one JavaScript file (e.g. register.js)
     * and one CSS file (e.g. app.scss) if your JavaScript imports CSS.
     */
    .addEntry("registerComponents", "./assets/registerComponents.ts")
    .addEntry("swup", "./assets/swup.ts")
    .addEntry("base", "./assets/base.ts")
    .addEntry("header", "./assets/header.ts")
    .addEntry("navbar", "./assets/navbar.ts")
    .addEntry("trends", "./assets/trends.ts")

    /**
     * LAYOUTS
     */
    .addEntry("layout", "./assets/layout.ts")
    .addEntry("layout-auth", "./assets/layout-auth.ts")

    /**
     * PAGES
     */
    .addEntry("login", "./assets/login.ts")
    .addEntry("register", "./assets/register.ts")

    /**
     * CUSTOM ELEMENTS
     */
    .addEntries({
        HashtagOptionDropdown: "./assets/components/lit/HashtagOptionDropdown.ts",
        NotificationDropdown: "./assets/components/lit/NotificationDropdown.ts",
        NotificationIcon: "./assets/components/lit/NotificationIcon.ts",
        ProfileDropdown: "./assets/components/lit/ProfileDropdown.ts",
        TrendingPeriodDropdown: "./assets/components/lit/TrendingPeriodDropdown.ts",
        FormInput: "./assets/components/lit/FormInput.ts",
        CustomAlert: "./assets/components/lit/CustomAlert.ts",
    })

    // .enableVueLoader()

    // When enabled, Webpack "splits" your files into smaller pieces for greater optimization.
    .splitEntryChunks()

    // will require an extra script tag for runtime.js
    // but, you probably want this, unless you're building a single-page app
    .enableSingleRuntimeChunk()

    /*
     * FEATURE CONFIG
     *
     * Enable & configure other features below. For a full
     * list of features, see:
     * https://symfony.com/doc/current/frontend.html#adding-more-features
     */
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    // enables hashed filenames (e.g. app.abc123.css)
    .enableVersioning(Encore.isProduction())

    .configureBabel((config) => {
        config.plugins.push("@babel/plugin-proposal-class-properties");
    })

    // .addRule({
    //     test: /\.(html|svelte)$/,
    //     use: [
    //         {
    //             loader: "svelte-loader",
    //             options: {
    //                 emitCss: true,
    //                 customElement: true,
    //                 preprocess: sveltePreprocess({}),
    //             },
    //         },
    //     ],
    // })
    // .addRule({
    //     // required to prevent errors from Svelte on Webpack 5+, omit on Webpack 4
    //     test: /node_modules\/svelte\/.*\.mjs$/,
    //     resolve: {
    //         fullySpecified: false,
    //     },
    // })

    .addAliases({
        "@": resolve(__dirname, "assets/"),
    })

    // enables @babel/preset-env polyfills
    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = "usage";
        config.corejs = 3;
    })

    // enables Sass/SCSS support
    .enableSassLoader()

    // uncomment if you use TypeScript
    .enableTypeScriptLoader()
    .enableForkedTypeScriptTypesChecking();

// uncomment if you use React
// .enableReactPreset()

// uncomment to get integrity="..." attributes on your script & link tags
// requires WebpackEncoreBundle 1.4 or higher
// .enableIntegrityHashes(Encore.isProduction())

// uncomment if you're having problems with a jQuery plugin
// .autoProvidejQuery()

module.exports = Encore.getWebpackConfig();

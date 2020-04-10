# WSU Human Resource Services Theme

[![Build Status](https://travis-ci.org/washingtonstateuniversity/hrs.wsu.edu.svg?branch=master)](https://travis-ci.org/washingtonstateuniversity/hrs.wsu.edu)

**Contributors:** WSU University Communications, Adam Turner  
**Requires at least:** WordPress 5.0  
**Tested up to:** WordPress 5.3.2  
**Requires PHP:** 5.6  
**Version:** 1.10.1  
**License:** GPLv2 or later  
**License URI:** http://www.gnu.org/licenses/gpl-2.0.html  

## Description

A child theme of the Washington State University (WSU) Human Resource Services (HRS) website.

## Installation & Dependencies

The WSU Human Resource Services Theme is not intended for general use and is not available from the WordPress Themes repository. It must be manually installed in the `themes` directory.

### Installation

1. Navigate to the [theme GitHub repository](https://github.com/washingtonstateuniversity/hrs.wsu.edu) and select "Download ZIP" from the "Clone or download" button menu.
2. Extract the downloaded ZIP file into the WordPress themes directory on your server and rename the downloaded directory to `hrs.wsu.edu`.
3. In your admin panel, go to Appearance -> Themes and locate the newly installed WSU Human Resources Services theme.
4. Select the "Activate" button to use the theme.

### Dependencies

The WSU Human Resource Services Theme is a child of the [WSU Spine parent theme](https://github.com/washingtonstateuniversity/WSUWP-spine-parent-theme). Follow the instructions under [installation](#installation) and make sure to rename the Spine theme directory to `wsuspine`.

The WSU Spine parent theme also provides the [spine and skeleton framework](https://github.com/washingtonstateuniversity/wsu-spine) for the WSU Web in WordPress, which the WSU HRS Theme depends on for its global navigation menu.

## For developers

The WSU HRS Theme development environment relies primarily on the NPM and Composer package managers. The `package.json` and `composer.json` configuration files will install the necessary dependencies for testing and building the production version of the theme. The NPM scripts in `package.json` do most of the heavy lifting.

### Initial setup

1. Clone the WSU Human Resource Services Theme to a directory on your computer.
2. Change into that directory.
3. Install the Composer dependencies.
4. Install the NPM dependencies.
5. Ensure PHP, CSS, and JS linting coding standards checks are working -- this should exit with zero (0) errors.
6. If you plan to contribute changes to the WSU HRS Theme you're encouraged to follow the [Git feature branch workflow](https://www.atlassian.com/git/tutorials/comparing-workflows/feature-branch-workflow). The production branch is `master` and the primary development branch is `1.x`, such that the general development flow will be `new-feature` --> `1.x` --> `master`.

In a terminal:

~~~bash
git clone https://github.com/washingtonstateuniversity/hrs.wsu.edu.git
cd hrs.wsu.edu
composer install
npm install
npm test
git checkout -b new-feature
~~~

### Project structure

The WSU HRS Theme CSS, JavaScript, and images are maintained in `scss/`, `js/`, and `images/` directories in the `src/` directory. Stylesheets are written in Sass and JavaScript in ES6+. NPM scripts are responsible for processing these files into production format, polyfilling where necessary, and producing source maps. The build process includes the following steps:

0. Prepare the build environment by removing the contents of the `assets/` directory. (Note: Do not manually create anything here; it will be deleted on build.)
1. Run linting and code standards checks on PHP (`phpcs`), SCSS (`stylelint`), and JS (`eslint`) files.
2. Build CSS: Compile the main Sass entry point (`/src/scss/style.scss`), run autoprefixer, save a human readable version of the stylesheet to `style.css` for WordPress to parse, then save minified production version(s) of the stylesheet(s) to `assets/css/`.
3. Build JS: Compile the main JS entry point (`/src/js/main.js`) using Webpack. Our configuration produces minified JS for two build targets -- one for modern browsers (`assets/js/main.js`) and one for legacy browsers (`assets/js/main.es5.js`) -- using Babel to transpile and add polyfills only as needed. (For more on this method review the `webpack.config.js` file and see Philip Walton, "[Deploying ES2015+ Code in Production Today](https://philipwalton.com/articles/deploying-es2015-code-in-production-today/)"; Addy Osmani and Mathias Bynens, "[Using JavaScript modules on the web](https://developers.google.com/web/fundamentals/primers/modules#mjs)"; and Shubham Kanodia, "[Smart Bundling: How To Serve Legacy Code Only To Legacy Browsers](https://www.smashingmagazine.com/2018/10/smart-bundling-legacy-code-browsers/)" *Smashing Magazine*.)
4. Build images: Optimize SVG images and copy all images to the `assets/images/` directory.

**To maintain this structure:**

* Styles should be added and edited in the `src/scss/` directory.
	- All `.css` files (including `style.css`) are automatically generated by the NPM build scripts and tracked in version control. Run `npm run build:style -s` to build only the CSS.
* JavaScript should be added and edited in the `src/js/` directory.
	- All production JS files are automatically generated by NPM and Webpack and trackd in version control. Run `npm run build:script -s` to build only the JS.
* Theme images should be added and edited in the `src/images/` directory (and SVG files in the `src/images/svg/` directory).
	- All production image files are automatically moved into place by the NPM build scripts and tracked in version control. Run `npm run build:image -s` to build only the images.
* Run `npm run build -s` to test and update all compiled files before committing changes.

### Browser Support

The WSU Human Resource Services child theme uses [Browserlist](https://github.com/browserslist/browserslist) to help monitor feature support. It aims provide a reasonably fast and fully usable experience on older browsers while to progressively enhancing the user experience on more modern browsers.

Specifically, the HRS theme aims to support all browsers with greater than 1% global usage (based on data from [Can I Use](http://caniuse.com/)), as well as IE 11 and the Firefox Extended Support Release (ESR). The Browserlist configuration, defined in `package.json` is:

~~~
"browserslist": [
  "> 1%",
  "ie 11",
  "Firefox ESR"
],
~~~

Review the current list of mobile and desktop browsers this resolves to using the [Browserlist online demo](http://browserl.ist/) (search for `> 1%,ie 11,Firefox ESR`).

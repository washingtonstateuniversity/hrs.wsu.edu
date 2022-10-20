# WSU Human Resource Services Theme

[![Support Level](https://img.shields.io/badge/support-active-green.svg)](#support-level) [![Build Status](https://github.com/washingtonstateuniversity/hrs.wsu.edu/actions/workflows/coding-standards.yml/badge.svg)](https://github.com/washingtonstateuniversity/hrs.wsu.edu/actions) [![Release Version](https://img.shields.io/github/v/release/washingtonstateuniversity/hrs.wsu.edu)](https://github.com/washingtonstateuniversity/hrs.wsu.edu/releases/latest) ![WordPress tested up to version 6.0](https://img.shields.io/badge/WordPress-v6.0.3%20tested-success.svg) ![WordPress Block Ready](https://img.shields.io/badge/block-ready-blueviolet) [![code style: prettier](https://img.shields.io/badge/code_style-prettier-ff69b4.svg)](https://github.com/prettier/prettier) [![GPLv3 License](https://img.shields.io/github/license/washingtonstateuniversity/hrs.wsu.edu)](https://github.com/washingtonstateuniversity/hrs.wsu.edu/blob/develop/LICENSE.md)

## Description

This is the WordPress theme for the Washington State University (WSU) Human Resource Services (HRS) website. It's a child theme of the [WSU Spine parent theme](https://github.com/washingtonstateuniversity/WSUWP-spine-parent-theme).

## Settings

The HRSWP Theme provides a shared settings page for the HRS Theme and HRSWP plugins. The HRS Theme registers two settings for managing production and non-production environments. One toggles environment notices on and off, and the other whether to require a login for frontend access.

## Installation & Dependencies

The WSU Human Resource Services theme is not intended for general use and is not available from the WordPress Themes repository. It must be manually installed.

### Installation

1. [Download the latest release from GitHub](https://github.com/washingtonstateuniversity/hrs.wsu.edu/releases/latest) and rename the .zip file to: `hrs.wsu.edu.zip`.
2. From here you can either extract the files into the theme directory via SFTP and skip to step 5, or navigate to the Themes screen in the admin area of your site to upload it through the theme uploader (steps 3-4).
3. Select Themes > Add New and then select the "Upload Theme" button.
4. Select "Choose File" and locate the downloaded .zip file for the theme (it **must** be a file in .zip format) on your computer. Select "Install Now."
5. Select "Activate Plugin" or return to the plugins page to activate later.

### Dependencies

- **WSU Spine Parent theme (required)**: The HRS theme will not activate without this parent theme. [Download the WSU Spine Parent theme](https://github.com/washingtonstateuniversity/WSUWP-spine-parent-theme/archive/master.zip) and follow the instructions under [installation](#installation). Make sure to rename the Spine theme directory to `wsuspine` in the themes directory.
- **HRSWP Blocks plugin (recommended)**: The [HRSWP Blocks plugin](https://github.com/washingtonstateuniversity/hrswp-plugin-blocks) provides several custom blocks and block adjustments that complement the HRS theme. Also includes several blocks that work with the HRSWP Sqlsrv DB plugin to display external content.
- **HRSWP Sqlsrv DB plugin (recommended)**: The [HRSWP Sqlsrv DB plugin](https://github.com/washingtonstateuniversity/hrswp-plugin-sqlsrv-db) provides tools to connect to and query external Microsoft SQL Server databases. It is required for the HRSWP Blocks plugin to function completely.
- **WSUWP HRS Courses plugin (optional)**: The [WSUWP HRS Courses plugin](https://github.com/washingtonstateuniversity/wsuwp-plugin-hrs-courses) creates a Courses custom post type with supporting custom taxonomies.

## For developers

The HRS Theme is not a Full Site Editing-enabled theme. It unregisters all of the FSE blocks, along with several others that are not used in the standard HRS environment. Refer to the list in `src/components/unregister.js`.

The WSU HRS Theme development environment relies on NPM and Composer for test and build processes. The `package.json` and `composer.json` configuration files will install the necessary dependencies for testing and building the production version of the theme. The NPM scripts in `package.json` do most of the heavy lifting.

### Initial setup

1. Clone the WSU Human Resource Services theme to a directory on your computer.
2. Change into that directory.
3. Install the Composer dependencies.
4. Install the NPM dependencies.
5. Ensure PHP, CSS, and JS linting coding standards checks are working -- this should exit with zero (0) errors.
6. If you plan to contribute changes to the WSU HRS theme you're encouraged to follow the [Git feature branch workflow](https://www.atlassian.com/git/tutorials/comparing-workflows/feature-branch-workflow). Suggested changes should be made on a separate branch and a pull request opened to merge into the `stable` branch.

In a terminal:

~~~bash
git clone https://github.com/washingtonstateuniversity/hrs.wsu.edu.git
cd hrs.wsu.edu
composer install
npm install
npm test
git checkout -b new-feature
git push origin new-feature
~~~

### Project structure

The WSU HRS theme CSS, JavaScript, non-core PHP, and images are maintained in the `src/` directory in directories corresponding to their template or component name. For example, styles for the gallery block can be found at `src/components/gallery/`. Core PHP templates such as `header.php` are located at the root level, but template parts and component PHP can be found in the `src/` directory.

Stylesheets are written in CSS with [PostCSS Preset Env](https://github.com/csstools/postcss-preset-env) nesting rules. JavaScript is written in ESNext. 

NPM scripts are responsible for processing source files into production format, polyfilling where necessary, and producing source maps. The build process includes the following steps:

0. Prepare the build environment by removing the contents of the `build/` directory. (Note: Do not manually create anything here; it will be deleted on build.)
1. Run linting and code standards checks on PHP (`phpcs`), CSS (`stylelint`), and JS (`eslint`) files.
2. Build styles: Compile the main CSS entry points for the front end (`src/style.css`) and the editor (`src/editor.css`), run CSSNext plugins, and save minified production version to `build/`.
3. Build scripts and copy PHP: Compile the main JS entry points for the front end (`src/index.js`) and the editor (`src/editor.js`) using Webpack. The Webpack build process will also move all component and template part PHP to the `build/` directory, along with images.

**To maintain this structure:**

- Styles and scripts should be added and edited in the appropriate `src/` subdirectory for the component or template.
* Theme images should be added and edited in the `src/images/` directory.
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

## Support Level

**Active:** WSU HRS actively works on this theme. We plant to continue work for the foreseeable future, adding new features, enhancing existing ones, and maintaining compatability with the latest version of WordPress. Bug reports, feature requests, questions, and pull requests are welcome.

## Changelog

All notable changes are documented in the [CHANGELOG.md](https://github.com/washingtonstateuniversity/hrs.wsu.edu/blob/develop/CHANGELOG.md), with dates and version numbers.

## Contributing

Please submit bugs and feature requests through [GitHub Issues](https://github.com/washingtonstateuniversity/hrs.wsu.edu/issues). Refer to [CONTRIBUTING.md](https://github.com/washingtonstateuniversity/hrs.wsu.edu/blob/develop/CONTRIBUTING.md) for the development workflow and details for submitting pull requests.

# Changelog: WSU HRS Child Theme

This document details all notable changes to the WSU HRS Child Theme. The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/) and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

<!--
## Major.MinorAddorDeprec.Bugfix (YYYY-MM-DD)

### Added (for new features)
### Changed (for changes in existing functionality)
### Deprecated (for soon-to-be removed features)
### Removed (for now removed features)
### Fixed (for any bug fixes)
### Security (in case of vulnerabilities)
-->

## 3.0.1-rc.1 (:construction: TBD)

## 3.0.0 (2021-12-02)

### Added

- Accent paragraph style. (b065cee)
- Google Fonts preconnect links. (c418bd1)

### Changed

- Add Babel parser options to eslint config. (36fb0c2)
- Fix atoz nav list link styles. (b065cee)
- Increase excerpt length of feature articles. (b065cee)
- Update front page styles to align with brand changes. (b065cee)
- Replace column block backgrounds with alternative decoration. (b065cee)
- Adjust link styles for text with background color. (b065cee)
- Align default link styles closer to updated brand and add secondary link styles. (b065cee)
- Update global footer link styles for brand. (b065cee)
- Update heading styles. (b065cee)
- Update header info and favicon for new brand, close #245. (b065cee)
- Update colors for new WSU brand, close #246. (c418bd1)
- Update font variables with new syntax and sizes. (c418bd1)
- Replace font with updated WSU brand font, close #244. (c418bd1)
- Upgrade roave/security-advisories from dev-master bac54e1 to dev-master 07a4c67. (4e2c509)
- Upgrade eslint from 7.30.0 to 8.2.0. (3388455, 36fb0c2)
- Upgrade postcss-preset-env from 6.7.0 to 7.0.0. (977d184)
- Upgrade postcss-cli from 8.3.1 to 9.0.2. (c15c4a4)
- Upgrade resolve-bin from 0.4.1 to 1.0.0. (93093e4)
- Replace stylelint-config-wordpress with @wordpress/stylelint-config. (c15c4a4)
- Update @wordpress/npm-package-json-lint-config from 4.0.5 to 4.1.0. (3388455)
- Update npm-package-json-lint from 5.1.0 to 5.4.2. (3388455, 2d98d0a)
- Update @wordpress/eslint-plugin from 9.0.6 to 9.3.0. (3388455, 36fb0c2)
- Update copy-webpack-plugin from 9.0.1 to 9.1.0. (c2512a1)
- Update webpack-bundle-analyzer from 4.4.2 to 4.5.0. (93093e4)
- Update @wordpress/dependency-extraction-webpack-plugin from 3.1.4 to 3.2.1. (93093e4)
- Update webpack-cli from 4.7.2 to 4.9.1. (93093e4)
- Update webpack from 5.44.0 to 5.64.1. (93093e4, c2512a1, 4d5ca96)
- Update @wordpress/babel-preset-default from 6.2.0 to 6.4.1. (c1e7ca2, 699deb0)
- Update @babel/runtime from 7.14.6 to 7.16.3. (c1e7ca2)
- Update @babel/core from 7.14.6 to 7.16.0. (c1e7ca2)

### Removed

- Small button style. (b065cee)
- News "Reminders" section and update areas nav. (b065cee)
- `selector-class-pattern` stylelint rule until WP adheres to it. (b065cee)
- Redundant theme supports, close #238. (f6f69dc)
- Typography css in favor of `theme.json` global styles. (c418bd1)

### Fixed

- Fix link specificity dropping tax list styles. (7d3ca76)
- Fix #249 match list font size to paragraph font size. (591f1f7)
- Match WP button block styles to HRS button block. (724be8a)
- Fix #247 adjust columns block layouts for different screen sizes. (b065cee)
- Remove duplicate link from archive article images. (b065cee)
- Fix cover block content center alignment in editor. (b065cee)
- Fix WSU GA plugin block editor conflict. (a3027d2)

### Security

- Bump ansi-regex from 5.0.0 to 5.0.1. (ab87e6a)
- Bump squizlabs/php_codesniffer from 3.6.0 to 3.6.1. (c320e92)
- Bump cssnano from 5.0.6 to 5.0.11. (c15c4a4, b8d4973)
- Bump postcss from 8.3.5 to 8.3.11. (c15c4a4)
- Bump babel-loader from 8.2.2 to 8.2.3. (c1e7ca2)
- Bump nth-check from 2.0.0 to 2.0.1. (c1a8d98)
- Bump path-parse from 1.0.6 to 1.0.7. (eaacad5)

## 2.3.0 (2021-07-19)

### Added

- Create `theme.json` file with global styles for color, duotone presets, spacing, typography, and layout; close #233. (02c8e3a)

### Changed

- Fix #214 remove separator block color options. (02c8e3a)
- Fix #213 remove table block color options. (02c8e3a)
- Fix #206 disable header font size and color options. (02c8e3a)
- Fix #237 unregister unwanted new WordPress 5.8 core blocks, such as the query block. (4602444)
- Update webpack from 5.40.0 to 5.44.0. (b24325e)
- Update eslint from 7.29.0 to 7.30.0. (b24325e)

### Security

- Bump sirbrillig/phpcs-variable-analysis from 2.11.0 to 2.11.2. (b24325e)
- Bump copy-webpack-plugin from 9.0.0 to 9.0.1. (b24325e)
- Bump resolve-bin from 0.4.0 to 0.4.1. (b24325e)

## 2.2.1 (2021-06-24)

### Fixed

- Fix #235 style submit-type buttons. (3c86948)
- Add styles for updated Spine parent theme search UI. (9a00792)

### Changed

- Update eslint from 7.28.0 to 7.29.0. (edc5ed1)
- Update webpack from 5.38.1 to 5.40.0. (edc5ed1)

### Security

- Bump postcss from 8.3.2 to 8.3.5. (edc5ed1)
- Bump @babel/core and @babel/runtime from 7.14.5 to 7.14.6. (edc5ed1)

## 2.2.0 (2021-06-14)

### Added

- Contributing documentation in `CONTRIBUTING.md`. (44a141e)
- Method to unregister specific blocks to close #217. (2d904ac)

### Changed

- Update contributing docs and readme. (44a141e)
- Simplify Composer coding standards scripts. (71d2058)
- Switch to GitHub Actions for CI tests. (71d2058)
- Update core block styles for WordPress 5.7 feature and fine-tuning to close #218. (9e4be30 and dbdc0b4)
- Fix #210 update social link styles to support new WP 5.7 features, including icon size. (50d7b53)
- Disable separator block color output, a stopgap solution for #214. (d82aef3)
- Streamline block modifications registry functions. (2d904ac)
- Move search header styles from the `button` to the `search-menu` component. (3b0b729)
- Update the search block styles to support new layout options introduced in WP 5.7. This also fixes #215 and #225. (7d59ba9)
- Upgrade @wordpress/babel-preset-default from 5.2.2 => 6.2.0 (921aeb7)
- Upgrade copy-webpack-plugin from 8.1.1 to 9.0.0. (17e86e5)
- Upgrade source-map-loader from 2.0.1 to 3.0.0. (17e86e5)
- Update webpack from 5.37.0 to 5.38.1. (17e86e5)
- Update postcss from 8.2.15 to 8.3.2. (43af3e2)
- Update eslint from 7.26.0 to 7.28.0. (bdee822)

### Deprecated

- Deprecate WP core button and buttons block styles in favor of the HRSWP Blocks plugin variant. (3b0b729)

### Fixed

- Fix #203 and #204 update list block styles for WP 5.7 background color. (bdc6ab2)
- Fix #207 update cover block styles for WP 5.7 and 5.8. (448ecd3)
- Fix #209 match editor preformatted block font to frontend. (6a328c9)
- Fix #212 correct alignment of the separator block in the editor. (d82aef3)

### Security

- Bump lodash from 4.17.20 to 4.17.21. (fdcbc3b)
- Bump hosted-git-info from 2.8.8 to 2.8.9. (e4b1aee)
- Bump browserslist from 4.16.1 to 4.16.6. (714719a)
- Bump trim-newlines from 3.0.0 to 3.0.1. (a257a97)
- Bump glob-parent from 5.1.1 to 5.1.2. (00fb165)
- Bump @wordpress/eslint-plugin from 9.0.4 to 9.0.6. (bdee822)
- Bump @wordpress/npm-package-json-lint-config from 4.0.3 to 4.0.5. (bdee822)
- Bump cssnano from 5.0.2 to 5.0.6. (43af3e2)
- Bump webpack-cli from 4.7.0 to 4.7.2. (17e86e5)
- Bump webpack-bundle-analyzer from 4.4.1 to 4.4.2. (17e86e5)
- Bump @wordpress/dependency-extraction-webpack-plugin from 3.1.2 to 3.1.4. (17e86e5)
- Bump @babel/core from 7.14.2 to 7.14.5. (921aeb7)
- Bump @babel/runtime from 7.14.0 to 7.14.5. (921aeb7)
- Bump roave/security-advisories from dev-master 630d41c to dev-master ba84189. (2021036)

## 2.1.2 (2021-05-14)

### Changed

- Revert Changelog TOC to prefer "Keep a Changelog" format.
- Add another form to the Gravity Forms filter hook to modify fields.
- Update Composer and npm built and lint dependencies.
- Update Copy Webpack Plugin to version 8 and fix the `to` syntax in Webpack config.

## 2.1.1 (2021-01-13)

### Bug fixes

- 🐛 Fix #200 remove custom display options from reusable blocks. (19a3242)

## 2.1.0 (2021-01-11)

### Enhancements

- Fix #187 Remove "protected" prefix from page titles. (889b314)
- Remove unused TablePress table styles. (fd6fb8a)

### Code quality

- Use `node.ownerDocument` instead of global element for event listeners. (6e38514)
- Remove unused variable and extra space in `single` template. (6d8d49d)

### Build tools

- ➖ Uninstall Thread Loader and remove it from Webpack config until it works with Webpack 5. (574571d)
- Update Prettier to the latest WordPress packaged version. (7490afe)
- ➕ Update to latest Babel packages, which require adding Babel Core and Runtime dependencies. (8f8159b)
- ➕ Upgrade to PostCSS CLI 8, which require adding PostCSS core as a peer dependency. (e5b30fe)
- ⬆️ Update to latest ESLint minor version. (6fb1b16)
- Update Composer PHP Codesniffer Installer and phpcs variable analysis. (25203b4)
- Change Copy Webpack Plugin `to` function for new syntax. (d34af03)
- ⬆️ Upgrade to Webpack 5 along with associated Webpack plugins. (d34af03)
- ⬆️ (@dependabot) Bump ini from 1.3.5 to 1.3.7. (9298d2c)
- ⬆️ (@dependabot) Bump dot-prop from 4.2.0 to 4.2.1. (db48055)

## 2.0.1 (2020-11-20)

### Bug Fixes

- Fix #178 missing namespaces break Gravity Forms filters. (980c2df)

### Build Tooling

- ⬆️ Build tools/composer updates. (2d87314)
- ⬆️ Upgrade css and js linting tools. (f35d337)
- ⬆️ Upgrade Webpack build plugins, wait on Webpack 5 upgrade. (2228178)

## 2.0.0 (2020-09-21)

### Enhancements

- 🎨 Fix #157 update front-page layout for block editor. (fe5da9c)
- Refactor search menu with updated script and styles, including improved accessibility by modifying tabindex when links are hidden. (d31eb0a, ff53bf3, 1eb7803, a974b39)
- Align button styles with in-progress WSU Design System. (d023614)
- Add `header.php` to override parent theme version. (a0aecb9)
- Add source directories for global (`src/global`) and library (`src/lib`) scripts and styles. (a95d77c, 0d85255)
- Library source files for scripts and styles for external or plugin modifications.
- :art: Update styles to support core block changes in WordPress v5.4.0. (53479e7, 5832f02, 84f75fa, 568129f, 5da07ca, 2a632ec)
- Modify the Gravity Forms filters to more easily include more form adjustments. (c4a829f)
- :bento: Move all component, template part, and global markup, scripts, and styles into dedicated individual directories located at `src/components/{{component-name}}/`, `src/templates/{{template-name}}/` and `src/global/`.
  - Add Components style and script entry point processors (5420047)
	- Social links component. (9ad6b83)
	- WP admin bar component. (12b64cc)
  - Video component. (47424b7)
  - Text tags component. (d587a9e)
  - Text control component. (7905deb)
  - Table component. (9da6db5)
  - Separator component. (7862a02)
  - Search component. (0c1d747)
  - Search Menu component, with PHP template and frontend script. (a9fe37c)
  - Quote component. (2c1ec73)
  - Pullquote component. (fb5da1f)
  - Preformatted component. (f2ef603)
  - Paragraph component. (8dfaebf)
  - Navigation component. (bd91fb6)
  - Navigation link component. (0d693be)
  - Media-text component. (35ea3e6)
  - List component, with core block editor filters. (61da475)
  - Latest Posts component. (d19d95e)
  - Image component. (cd0ff5f)
  - Icons component. (a4161ee)
  - Heading component. (d5f0c82)
  - Gallery component. (997fdc9)
  - Embed component. (df501c7)
  - Cover component. (bb92f06)
  - Single template. (646f68e)
  - Page template. (ae23674)
  - Home template. (0b0c78d)
  - Header template. (dfa2d24)
  - Front-page template. (48a45ad)
  - Footer template. (8775942)
  - Builder template. (a674a40)
  - Base template. (2faf4e4)
  - Archive template. (c954286)

### Bug Fixes

- Fix #163 prevent search menu flash on page load. (aef8827, 245ddc7)
- Fix #167 theme styles leaking into editor UI. (1b71860)
- Fix #164 TablePress class misreferenced. (3e5bced)
- Mitigate some small-screen core columns block layout issues. (8d5d50d)
- Revert site header background color to white. (0b1ce2b)
- Fix #79 hide lazy load placeholder images on no-js. (faed62b)
- 🌐 Add ARIA labeling to generic landmark regions such as `nav` and `article` elements. (cbb5c1c)
- Fix NPM Package Lint config to allow GPL 3.0 license in npm license. (bd01a56)
- 🌐 Fix #132 heading order in search menu. (33bc285)
- Fix site header aria label. (27db595)
- 🌐 Fix #83 Add level 1 heading on homepage. (5ad298f)
- 🐛 Fix #127 include footer in builder template. (1f4aad8)

### Deprecations

- Remove unused meta boxes from page edit screen. (4a5b7eb)
- Remove "post list" and "last updated" shortcodes in favor of using a plugin. (d47d4cd, 55d6240)
- :boom: Remove all custom blocks to a separate plugin. (9a8e517)
- :fire: Remove Javascript variant for legacy browsers. Use only one integrated index file and tune later as needed. (e8215de)
- :heavy_minus_sign: Remove the `url-search-params` npm dependency. (2590294)
- Remove search-filter JavaScript tool in preference for HRS Search Filter block. (a24e48f, 78fe58e)
- Remove MS SQL Server connector class and all related template tags and shortcodes. (0336af6)
- :heavy_minus_sign: Remove uneeded dev dependencies following build tool update.
  - `url-search-params-polyfill` isn't needed since we're not offering this support anymore.
  - `@babel/core`, `@babel/plugin-syntax-dynamic-import`, `@babel/polyfill`, `@babel/preset-env`, `babel-eslint`, and `eslint-loader` are all taken over by WordPress packages.
  - `autoprefixer`
  - `mkdirp`
  - `node-sass`
  - `svgo`
  - Svgo config file.
  - `webpack-merge`

### Code Quality

- 👷 Fix #145 refactor Travis CI config. (6673ce2)
- :recycle: Refactor binder element class logic to better align with WP coding standards. (306f51d)
- :fire: Remove unneeded template part files. (7405a3a)
- Renamed HRS Theme namespace. (9d89a62, dda2434)
- :globe_with_meridians: Update text domain for new theme namespace. (a36a3b0, e404364)
- :heavy_plus_sign: Add `stylelint-a11y` npm stylelint plugin and configure. (a96e194, 5120208)
- :truck: Update environment structure to be more component based.
  - Move shortcodes to `src/components` directory. (288cccb)
  - Move post date and terms lists to `src/components`. (b3ebdd6)
	- Move search menu script into the `src/components` directory and modify for export support. (ea65d91, b513b52)
	- Move template parts into respective `src/templates` directories. (e24ed08, 282bbd2, 4d252ac, 8834964, c9e98a6)
	- Move pagination to `src/components`. (5e7cc55)
	- Distribute `functions.php` and `setup` methods into more specific files. (da340dd)
  - Move lazy loading script into the `src/lib` directory and modify for export support. (e154010)
	- Move the lazy loading class into the `lib` directory. (2080425)
	- Move custom queries into the `inc` directory. (75d0567)
  - Modify the JS entry point, now `src/index.js` to handle all frontend imports and add `src/editor.js` to handle all backend imports. (442d44f, 4eb46b0)
	- Add style entry points for templates source directory. (741de2e)
- Break down scripts and styles into frontend and backend and organize them by component and template. (b0b9eb3)
- :wrench: Add config file for the `npm-package-json-lint` linter, for `postcss-cli`, and for `wp-prettier`. (26dca82, 4a70723, 7e46e0e)
- :heavy_plus_sign: Add `wp-prettier` npm dev dependency aliased to `prettier`. (98734a2)
- :wrench: Update linter configs to use WordPress preset recommendations. (09bb5f6, a38d3f9, 6c5d034)
- :wrench: Simplify `.gitignore` rules. (2c1f44d)
- Use pre-optimized images instead of optimizing on every build and use Webpack to copy from source to build. (847675c)
- :wrench: Update editorconfig with newer WP-aligned rules. (236ccff)
- :construction_worker: Update Travis rules to monitor the 2.x branch and only test PHP 7.0+. (132359b, 6a16c27)
- Add the `npm-package-json-lint` npm dev package with the `@wordpress/npm-package-json-lint-config` package to handle code quality of `package.json` file.
- Use the WordPress `stylelint-config-wordpress` linting rules.
- Directly include the `dealerdirect/phpcodesniffer-composer-installer` Composer dev dependency for PHPCS.
- Add the `phpcompatibility/php-compatibility` and `sirbrillig/phpcs-variable-analysis` Composer packages for additional PHPCS quality checking.

### Documentation

- Replace screenshot for new front page layout. (3dc5e9a)
- Improve changelog organization with type categories. (82117b7)
- Add the Prettier badge. (e00da29)
- :memo: Update documentation. (1afaa73)

### Build Tooling

- ⬆️ Update Composer dependencies and fix `composer.json` spacing. (7d0a988)
- ⬆️ Update npm package lint dependency and config. (3869ce8)
- ⬆️ Update JavaScript build tools; ESLint, Prettier, WordPress ESLint Plugin. (2444736, a240db7)
- ⬆️ Update Webpack and related dependencies. (9779eb9, a240db7)
- ⬆️ Update CSS build tools, Stylelint, Stylelint config, and PostCSS CLI. (1b3f923, a240db7)
- ⬆️ Update Copy Webpack Plugin to v6+ and fix copy patterns syntax for v6.0 changes. (3cc637c)
- Switch from Sass to CSS using the `postcss-present-env` plugin to allow things like variables and nesting. (209dc79)
- Add the `postcss-import` and `postcss-preset-env` npm PostCSS plugins.
- :boom: Revamp Webpack config to use one set of rules geared to the WP block environment, to process frontend and backend scripts separately, and to handle copying componenent assets from entry to output directory. (5fb2313)
  - :heavy_plus_sign: `@wordpress/dependency-extraction-webpack-plugin`
	- :heavy_plus_sign: `copy-webpack-plugin`
	- :heavy_plus_sign: `resolve-bin`
	- :heavy_plus_sign: `source-map-loader`
	- :heavy_plus_sign: `thread-loader`
	- :heavy_plus_sign: `webpack-bundle-analyzer`

### Project Management

- Replace the theme screenshot. (3dc5e9a)
- Update CHANGELOG and README headers and badges. (c2d1ced)
- Switch to GPLv3+ license in place of GPLv2+. (245ae12, c2d1ced)
- Rename primary branch from `master` to `stable`. See the Internet Engineering Task Force (IEFT), [Terminology, Power and Oppressive Language](https://tools.ietf.org/id/draft-knodel-terminology-00.html#rfc.section.1.1.1).
- Revamp `composer.json` and `package.json` with better metadata and build processes focused on PostCSS and Webpack. (c292a6e, 2692f07)
- Add the `roave/security-advisories` Composer package to monitor Composer package security.

## 1.10.3 (2020-06-10)

### Changed

- Rename "master" branch to "stable." See the Internet Engineering Task Force (IEFT), [Terminology, Power and Oppressive Language](https://tools.ietf.org/id/draft-knodel-terminology-00.html#rfc.section.1.1.1).
- :arrow_up: @babel/core => 7.10.2
- :arrow_up: @babel/polyfill => 7.10.1
- :arrow_up: @babel/preset-env => 7.10.2
- :arrow_up: @wordpress/babel-preset-default => 4.14.0
- :arrow_up: autoprefixer => 9.8.0
- :arrow_up: eslint-loader => 3.0.4
- :arrow_up: mkdirp => 1.0.4
- :arrow_up: node-sass => 4.14.1
- :arrow_up: postcss-cli => 7.1.1
- :arrow_up: stylelint => 13.6.0
- :arrow_up: webpack => 4.43.0
- :arrow_up: url-search-params-polyfill => 8.1.0

## 1.10.2 (2020-04-16)

### Added

- Missing `wp-block-buttons` styles for the new Buttons core block in WP 5.4.

## 1.10.1 (2020-04-10)

### Changed

- :wastebasket: Hide deprecated blocks from the inserter (but keep in existing posts). (9a32500)

## 1.10.0 (2020-03-31)

### Added

- :sparkles: Post sidebar control to toggle feature image visibility on single views, using post meta and the body class filter. (1f9c064)
- :sparkles: Post and page sidebar control to toggle title visibility, using post meta and the body class filter. (ac1a196, 3f7a7a2, f2197f2)

### Changed

- :art: Apply frontend table styles to editor. (20d099d)
- :arrow_up: @babel/core => 7.9.0
- :arrow_up: @babel/preset-env => 7.9.0
- :arrow_up: autoprefixer => 9.7.5
- :arrow_up: babel-loader => 8.1.0
- :arrow_up: webpack => 4.42.1

## 1.9.0 (2020-03-17)

### Fixed

- :alien: Add new `.has-text-align-*` class rules for updated core block classes. (f24f7e3)

### Added

- :art: Style option to hide the page title from all but screen readers. (169e79e)

### Changed

- :art: Modify form styles for the HRS contact form. (6f2ae31)
- :arrow_up: @babel/core => 7.8.7
- :arrow_up: @babel/polyfill => 7.8.7
- :arrow_up: rimraf => 3.0.2
- :arrow_up: stylelint => 13.2.1
- :arrow_up: webpack => 4.42.0
- :arrow_up: webpack-cli => 3.3.11

## 1.8.0 (2020-02-04)

### Fixed

- Fix #115 remove deprecated sudo key from Travis config. (17e3469)
- Fix #114 specify os in Travis config. (a7eb2bb)
- :wrench: Specify `is_theme` as 'true' in phpcs config to allow WP template names that violate their own rules. (6bacf4e)
- :wrench: Include browser globals in eslint rules. (6a37b87)
- :warning: Specifically declare WP globals in use. (d8ccdf0)
- :warning: PHP lint issues following rules update. (fd5df24)

## 1.7.2 (2019-09-20)

### Fixed

- :warning: PHP lint issues with "phpcs:ignore" syntax and a misused WP global variable in a custom loop.

### Changed

- :arrow_up: @babel/core 7.5.5 -> 7.6.0
- :arrow_up: @babel/polyfill 7.4.4 -> 7.6.0
- :arrow_up: @babel/preset-env 7.5.5 -> 7.6.0
- :arrow_up: @wordpress/babel-preset-default 4.4.0 -> 4.6.0
- :arrow_up: @wordpress/eslint-plugin 2.4.0 -> 3.1.0
- :arrow_up: babel-eslint 10.0.2 -> 10.0.3
- :arrow_up: eslint 6.1.0 -> 6.4.0
- :arrow_up: eslint-loader 2.2.1 -> 3.0.0
- :arrow_up: rimraf 2.6.3 -> 3.0.0
- :arrow_up: stylelint 10.1.0 -> 11.0.0
- :arrow_up: webpack 4.39.1 -> 4.40.2
- :arrow_up: webpack-cli 3.3.6 -> 3.3.9
- :arrow_up: webpack-merge 4.2.1 -> 4.2.2
- :arrow_up: wp-coding-standards/wpcs 1.2.1 -> 2.1.1

## 1.7.1 (2019-08-08)

### Changed

- Upgrade npm development dependencies.

## 1.7.0 (2019-06-20)

### Fixed

- :warning: PHP lint warnings.

### Added

- Custom "alpha" style option for the core/list block (along with matching CSS rules).

### Changed

- :arrow_up: Upgrade npm and composer dependencies.
- Increment WP minimum version and tested-up-to version.
- Filter the post date display on single posts using a custom template tag.

## 1.6.0 (2019-05-16)

### Added

- Template function that displays lists of taxonomy terms for each taxonomy registered to a particular post type on single pages.

### Changed

- :art: Modify post and page CSS selectors to better catch pages and single posts of any post type.
- Webpack requires specifying Core JS version when 'useBuiltIns' is set.
- Use cp instead of the cpx npm dependency to copy files.
- :arrow_up: Upgrade npm dependencies.

### Removed

- :heavy_minus_sign: Remove cpx npm dependency.

## 1.5.1 (2019-05-07)

### Changed

- :arrow_up: Upgrade npm dependencies.

## 1.5.0 (2019-05-01)

### Added

- :white_check_mark: Github issue and pull request templates.

## 1.4.1 (2019-04-29)

### Fixed

- Fix default horizontal separator width.
- Fix #94 Cover images set to align full should fill content width.
- Fix gallery images stretched by removing `flex-direction` from gallery figure flex definition.
- Adjust padding of media-and-text blocks with background color active.
- Switch callout titles to large text to fix document structure issue created by using headings as the title element of callout blocks.

## 1.4.0 (2019-04-18)

### Fixed

- :art: Fix prominent blocks not being width-restricted when floated.
- Set default Spine bleed setting to false.
- Add menu location to prevent duplicating primary and site reference nav menus.

### Changed

- :art: Tune up table styles.
- :art: Update cover block styles to align with switch to allowing variable inner block content in WP 5.2.
- Normalize line height for headings and larger text sizes.
- Set global line height to relative value of 1.6.
- Isolate cropped-Spine homepage variant styles.
- Set the site reference nav menu in the footer to use the new `site-reference` menu location and adjust the depth to 1 to prevent wrapping.

### Added

- :sparkles: Additional intermediate image size for "small" images (max width of 350px).
- A default attachment template to handle redirecting all attachment page requests to the attachment parent post if it exists and the attachment URL itself if it doesn't.

### Deprecated

- Cover block styles for pre-WP 5.2 markup.

## 1.3.1 (2019-04-12)

### Fixed

- Fix #100 Use local path for `add_editor_style` to load styles more reliably.

## 1.3.0 (2019-04-10)

### Fixed

- Fix z-index and text color for new cover blocks allowed content.
- Child blocks should not inherit center alignment from parent blocks.

### Added

- A "sidebar" block in the block editor to display content in a weighted two-column layout with options for the "sidebar" to sit to the left or the right.
- A custom "callout" block in the block editor to display a heading & content-style element.
- A custom "notification" block in the block editor to display a text & button-style notification element.

### Changed

- Update notification and callout styles for new block syntax.
- Move block registration methods to the theme setup class.
- Add separate webpack environment config for WP blocks.

### Deprecated

- Old-style module (callout) styles.
- Old-style banner notification styles.

## 1.2.0 (2019-03-26)

### Fixed

* Fix #95 Image `sizes` attribute mislabeled in lazy loader script.
* :art: Fix #88 Make header margins more consistent and correct CSS override issue.
* :warning: Fix linter warnings surfaced by new WordPress recommended config.

### Changed

* :wrench: Switched to WordPress recommended ESLint configuration and updated build configs to work with blocks syntax.
* Update button styles to reflect modified WP block style options.
* Move the HRS theme setup method calls from the static constructor into the setup function.
* Remove Spine theme editor style CSS and replace with HRS theme editor style.
* Switch to 100% and max width on the main article content width to be more flexible and make better use of space on medium-width viewports.
* :pencil2: Update CSS table of contents and documentation.
* :truck: Reorganize some style directories for clearer organization and naming. (Consolidate layout, template, and page styles into `layout` directory; Rename "global" to "environment" and move component-specific styles into "components"; Merge `_elements.scss` into `_components.scss` for easier tracking and to avoid duplication.)

### Added

* Add script to modify WP block styles for various blocks.
* :sparkles: Script entry point to handle adding and modifying WP editor blocks.
* :art: Back end styles for the WP blocks we want to support.
* :art: Front end styles for the WP blocks we want to use. Some (like buttons and image galleries) merged with existing styles and others (like columns and  responsive embeds) new or replacing existing styles.
* Layouts stylesheet part specifically for reusable layout rules.

### Deprecated

* Classic-style image gallery.
* Old-style YouTube embed CSS using classes `embed-youtube` and `youtube-4x3`. Will be removed in the next minor version.
* Several image classes that have been replaced by WP blocks.

## 1.1.1 (2019-02-27)

### Fixed

* Target the correct columns for the Gravity Forms list field filters and add an additional form.

## 1.1.0 (2019-02-21)

### Fixed

* Updated syntax for the block editor "align wide" theme support.

### Changed

* Move TablePress filter from setup to functions.

### Added

* Filters and styles to adjust custom form fields, called from a central Gravity Forms setup function.
* Theme support flags for several block editor features.

### Removed

* Disable the Customizer custom CSS option.
* Unset all of the parent theme page templates that are not being used. Will give preference to Builder and then the block editor.
* Delete the `gutenberg-beta` template. Now that WP 5.x has launched with the block editor the template is no longer needed.

## 1.0.1 (2018-12-27)

### Changed

* Don't run lazy load image replacement process on images using a `data:` type source.

## 1.0.0 (2018-12-20)

### Fixed

* :green_heart: Get Travis CI running.
* :bug: Fix #73 clear TablePress table props transient before filtering cells.
* :warning: Fix #72 no self-closing SVG elements.
* :bug: Fix #71 remove duplicate `class` attribute on terms printing function.
* Fix #67 search menu obscured by Spine on homepage when JavaScript is disabled.
* :art: Fix #69 time contextual icon clipping.
* Fix #66 Use `flex-start` to mitigate IE 11 flex :bug: on `margin: auto` elements.
* Builder banner buttons get cut off in Firefox.
* Variable assignment inside condition phpcs error.
* :alien: Close #60 hide empty `<p>` elements in Banner sections. Caused by an unknown interaction between Builder, TinyMCE, and Gutenberg, but only appears in Builder banner sections, which are deprecated here anyway, so just hide them.
* Fix #63 misaligned padding on deprecated Builder banner titles.
* Fix #62 grid list layout fallback for IE 11.
* Apply missing link-after icon styles to recent articles lists.
* Target feature image styles more specifically.
* Fix #65 don't check for a term ID when the term doesn't exist.
* Verify `get_reminder_posts()` returned results before using them.

### Changed

* :memo: Update Readme file with installation and build instructions.
* :truck: Simplify assets directory structure.
* :zap: Merge non-repo Spine parent theme CSS into main CSS to reduce overlap and dequeue unneeded styles.
* Restore a path to the WSU search page for users that need it.
* :sparkles: Switch from using WSU custom search to the built in WP search. Because for all its drawbacks, it's still better.
* :arrow_up: Upgrade Composer dependencies.
* :arrow_up: Upgrade npm dependencies.
* :art: Clean up JS table filter input display.
* Add dynamic import method for JS table filter handler and import only required functions in main JS entry point.
* :package: Add npm dependency to provide a `URLSearchParams` polyfill.
* :package: Add npm dependencies for dynamic module imports.
* :wrench: Update Webpack config to include Babel polyfill for dynamic module imports and set public path for dynamically imported scripts.
* :wrench: Set `eslint.json` config to use emcaVersion 8 and allow dynamic module import syntax (and allow un-capitalized comments).
* Add more files to the `.gitattributes` ignore export rules.
* :recycle: Close #35 Rename and refactor primary scripts into modules to take advantage of ES6+ syntax and methods alongside Babel transpilation and polyfills. For more on this method see: https://philipwalton.com/articles/deploying-es2015-code-in-production-today/ and https://www.smashingmagazine.com/2018/10/smart-bundling-legacy-code-browsers/ and https://developers.google.com/web/fundamentals/primers/modules#mjs.
* Update script enqueuing to load the main script as a module type for modern (ES6+-supporting) browsers alongside a legacy script loaded with a "nomodule" attribute. Modern browsers should ignore the nomodule script (technically shouldn't download it).
* ES Lint doesn't need to support jQuery any more, but should allow module syntax.
* Load non-critical JS async.
* Replace bottom margin on page title headers.
* Update theme screenshot.
* Added some box shadow, stamped down some box shadow.
* Use more reliable centering on the Builder banner title elements.
* Move fallback styles into a dedicated scss file.
* Expand the `.alignwide` class to apply block level elements.
* Organize styles a bit.
* More specific classes to distinguish single vs. archive articles.

### Added

* TablePress filters to add `data-column` attributes to all cells in tables with header rows, to allow for responsive layouts with labels.
* :art: Allow sticky table headers that scroll with the viewport.
* :zap: Implement lazy loading of off-screen images site-wide using Intersection Observer methods to swap out a placeholder.
* Setup method to adjust font size options for the new WP block editor.
* A "light" version of the notification component.
* Dedicated `search.php` template to override the Spine parent theme version.
* WP Shortcode and JavaScript to create a tool to filter table rows by a search term.
* Use Webpack + Babel to manage JS builds and selective polyfills.
* Page navigation styles for A-Z nav lists.
* New general svg icons.
* Config file for svgo npm tool to preserve `viewbox` in minified svg files.
* A `.gitattributes` file to manage cross-environment settings and facilitate creating non-development zip files for download.

### Removed

* :fire: Old image decorations.
* :wrench: Remove support for IE versions below 11.
* No longer need unique card stylings for specific pages.
* No special styling for Builder banner titles on specific pages.
* Clean out unused deprecated styles.

## 0.20.1 (2018-11-07)

### Fixed

* :pencil2: Wrong version number in `HRS_MSDB` related functions.
* Extra debug messages in `HRS_MSDB` class methods.

## 0.20.0 (2018-11-06)

### Fixed

* Added missing `tr` elements to table formatting in `template-tags.php`.
* Namespace errors following update.
* Match ER Awards template to default page template and fix phpcs issues.

### Changed

* :memo: Clean up and fill in some documentation throughout the `includes/` dir files.
* :zap: Switch from `wp_kses_post` to less resource-intensive and aggressive escaping functions for external content table output.
* Add `data-title` attributes to external content tables for responsive display.
* Apply basic responsive tables CSS to all tables.
* Use `<th>` instead of `<tr>` for the salary grid table header.
* Move flushing results into its own function.
* Add missing documentation and tidy some function checks.
* :art: Adjust table style to semi-bold tableheaders.
* Switch from template to shortcode for displaying external ER Awards content.
* Move odbc queries and template tags to respective newer files.
* Move awards list heading inside section element and change functions so that only one prints output.
* Modify `HRS_MSDB` query methods to allow SQL Server-style parameterized queries (@see http://php.net/manual/en/function.sqlsrv-query.php).
* :warning: Add escaping functions and fix other PHPCS issues.
* Include the new `HRS_MSDB` class file in `functions.php`.
* Add the new `includes/` and `templates/` directories to the npm PHPCS script.
* Adjust row list component class names to be a little more element agnostic.

### Added

* :wrench: A `.gitattributes` file to manage cross-environment settings and facilitate creating non-development zip files for download.
* Functions to fetch, format, and display data for the salary schedule table.
* Class var to track last query for use in debugging.
* Functions to fetch, format, and display data for the salary grid table.
* Functions to handle preparing SQL statements for SQL Server requests.
* Template to handle presenting a list of awards from the Employee Recognition database.
* Function in `hrs-template-tags.php` to print the lists of awards grouped by ER year.
* Function in `hrs-template-tags.php` to print the results of a request to the ER DB awards table as lists of awards.
* Function in `hrs-queries.php` that instantiates the HRS_MSDB class to open a new connection to the ER database, retrieve the contents of the awards table as an object, then close the connection and return the results.
* :sparkles: New class `HRS_MSDB` that provides a variety of methods for connecting to and interacting with an SQL Server database.

## 0.19.0 (2018-08-07)

### Changed

- Fix alignment and add "if posts" check to default page template.

### Added

- CSS to target the new Gutenberg `alignwide` option to create full-width images.
- Gutenberg page template to enable the Gutenberg editor on select pages (override Spine parent theme version).
- Action to include and modify theme support for select Gutenberg editor elements (including removing the color picker for now).

## 0.18.2 (2018-08-03)

### Fixed

- Remove flex display on archive page card layout for browsers that don't support CSS Grid to fix an odd auto-height bug.
- Fix #31, adds float fallbacks for CSS Grid layouts (based on advice from Rachel Andrew in a [_Smashing Magazine_ post](https://www.smashingmagazine.com/2017/11/css-grid-supporting-browsers-without-grid/) and in [examples on her website](https://rachelandrew.co.uk/css/cheatsheets/grid-fallbacks).

### Changed

- Add README section on browser support and Browserlist.

## 0.18.1 (2018-08-02)

### Fixed

- Fix #55 and close #56, use main WP Query wherever possible instead of custom queries to maintain pagination.

### Changed

- No longer override the posts_per_page setting on the posts home page.
- Switch from using a custom WP_Query in `home.php` to using only the main query and filtering it with `pre_get_posts` and formatting with a counter.
- Switched from using a custom WP_Query on HRS taxonomy archive pages to just filtering the full main query.

### Removed

- Stop filtering the main query on the HRS taxonomy archive pages.
- Removed unneeded page query var from `archive.php`.

## 0.17.8 (2018-07-31)

### Fixed

- Fix #54, Switch from manual "is first page" check to WP-builtin `is_paged()` method to check for first page of archive results.

## 0.17.7 (2018-07-30)

### Fixed

- Fix #53, Caption text on page feature images was being encoded; switched from `esc_html` to `wp_kses_post` to preserve needed HTML.
- Silence output of the `featured-images.php` template part for non-default page templates in the parent theme (to avoid having to override all of those themes).

### Removed

- Remove un-used and/or unwanted parent theme page templates from the editor template selection menu.

## 0.17.6 (2018-07-27)

### Fixed

- Fix #50, Jiggering on site reference nav menu hover.
- Fix #48, Apply `.article-header` bottom margin only on single pages.
- Fix #49, Empty feature image link URL on single views by echoing the Spine image URL function.

### Changed

- Switch the footer cougar head logo to crimson.
- Shift Builder banner title down slightly.
- Remove unused color Sass variables.
- Give the site header a little more breathing room.
- Style page template feature image to match single post views.
- Move page template feature image out of the hero position.

## 0.17.5 (2018-07-18)

### Fixed

- Add missing `articles/` directory to the NPM deploy script.

## 0.17.4 (2018-07-18)

### Changed

- Separate retrieving and display formatting functionality between the HRS "get_terms" methods and streamline argument declaration with a default set.

## 0.17.3 (2018-07-17)

### Fixed

- Use get method instead of global variable to track HRS child theme version, fix #42.
- Remove left border on the site header when on the full-width home page, fix #45.

### Changed

- Add abbr element styles.
- Add hanging indent style to standard definition lists.
- Consolidate site header border styles.
- Add additional blockquote styling to make contents stand out more from normal text.

### Added

- Abbr and acronym (HTML5 deprecated) element styles.

## 0.17.2 (2018-07-17)

### Fixed

- Apply `break-word` rule globally on the `main` element.
- Page header bottom margin should only apply to main page and single template page headers, not individual archive items.

### Changed

- Set `show_in_rest` to true to display HRS Units taxonomy in the WP RESP API so that it is enabled in the new Gutenberg editor.
- Add `break-word` rule to single and page template article content to avoid edge case of overflowing titles and content.
- Move pagination query and markup from the multiple archive templates into a function.
- Add width styles to default and Builder template page views to prevent overly long lines of text, fix #30.

### Added

- Setup method in `class-hrs-theme-setup.php` to hook into the WP API and remove the Spine parent theme excerpt filter.
- Function to retrieve and display archive page post pagination.
- Template for displaying default page views, adjusted from the parent theme to display as single instead of two-column layout.

## 0.16.0 (2018-07-13)

### Changed

- Update theme setup class to require the new post lists shortcode file.

### Added

- Methods to retrieve and display the latest HRS posts with some filtering criteria.
- Shortcode to display the latest HRS posts matching a given criteria.
- Includes file to store shortcodes related to post lists.

## 0.15.2 (2018-07-06)

### Fixed

- Add noscript element to handle no-JS search menu display to fix #34.
- Add focus visibility to the search menu close button to fix #33.

### Changed

- Rename primary theme JavaScript from `custom.js` to `scripts.js`.

## 0.15.1 (2018-07-06)

### Fixed

- Update npm dependencies.

## 0.15.0 (2018-07-06)

### Changed

- Update archive pages (`home.php`, `archive.php`, and `taxonomy-hrs_unit.php`) to display the most recent 10 posts, include pagination, and only use the special feature layout on the first results page.
- Update page header.

### Added

- Base styles for the posts home page.
- Method to display a gallery of taxonomy term titles.
- Method to retrieve recent posts categorized as "reminders."
- Icons for bookmarks and events.
- A `home.php` template to handle display and layout of the home posts page.

## 0.14.0 (2018-06-27)

### Changed

- Update article list (grid row) styling to be more flexible and to include feature images.
- Update default Spine options to hide author pages since HRS does not use them.
- Globalize contextual mini-icon :before and :after styles.
- Restyle the single post footer to align more with the site footers.

### Added

- Base styles for archive page(s) layout.
- Method to filter the default WP Query for HRS Unit taxonomy term archives.
- Special archive template for HRS Unit taxonomy term archives.
- Default archive template for author, category, CPT, taxonomy, date, and, tag archives.
- Article template for displaying archive post content.
- Method in the setup class to set HRS's default Spine options, overriding some of the default Spine options.
- Default label icon svg.
- WSU time icon svg.
- Custom template tags to get and display any taxonomy terms, formatted at a data list element.
- Fetch and display the HRS Unit taxonomy terms on posts.
- Template tags file for custom HRS child theme template tags, when needed.
- Create new HRS taxonomy to categorize posts by HRS unit(s).
- Template for displaying individual post content inside the single template to adjust markup of the parent theme version (remove sidebar).
- Template for displaying individual post views to adjust the markup of the parent theme version (remove the featured image background).
- PHP doc header information for `footers.php`, close #21.
- A new template part called `before-main.php` that displays the site header. This used to be displayed by `headers.php`, but we want the site header outside of the `main` element, close #22.

### Deprecated

- Silenced the output of the `headers.php` file because we don't want the parent theme to display its default headers inside the `main` element.

### Removed

- Author info section removed from `articles/post.php` template.
- Deleted the `header.php` file because it simply duplicated the parent theme version, close #19.

## 0.13.1 (2018-06-08)

### Fixed

- HRS child theme JS no longer uses jQuery, so remove that as a dependency.

## 0.13.0 (2018-06-08)

### Added

- Header section for main functions file.
- Action to redirect users to homepage on logout (copy from helper plugin).
- Shortcode to display the date a page was last updated.
- Namespace the HRS document gallery shortcode.
- HRS document gallery shortcode that largely duplicates the standard WP gallery shortcode, but for PDF thumbnail galleries.

## 0.12.0 (2018-06-08)

### Changed

- Clean up `functions.php` to remove unneeded methods and refactor the rest, fix #17.
- Prefer to enqueue the login page CSS rather than inline it.
- Rename HRS nav menus for easier identification.
- Move WP menu(s) registration into the setup class.
- Fix malformed call to `add_theme_support` for HTML5 search form and move to the setup class.

### Added

- Filter to adjust the punctuation in the HRS page title element.
- Crimson svg WSU cougar logo for CSS background use.
- New nav menu to display the site footer nav menu so that the "Offsite" menu can display in the Spine as intended, or not at all if unwanted.
- Action and methods to get and set the Spine schema version for the HRS child theme -- set to 2.x to target the latest Spine configuration options.
- A theme setup class to handle theme setup tasks such as registering theme support in a new `includes/` directory.

### Removed

- Restored the "lost password" link to the login page by removing the filter that erased it.

## 0.11.1 (2018-06-05)

### Fixed

- Escape translated form labels in search menu.
- Add a container class for the deprecated Builder Banner tool that downgrades its z-index value to 1 to prevent it overlapping other elements.

### Changed

- Update all font sizes to use variables.
- All media queries, new and old, updated and streamlined using mobile-ready versions as the default, fix #25.
- Tweak row list display to be less cluttered on small screens.
- Use flexbox with notification styles to allow optional right-aligned button and require only one line of text.
- Update all old media queries to use breakpoint variables and target small-screen as base wherever possible (given parent and plugin theme limitations).
- Adjust site title sizes for better responsive display.
- Switch gallery styles to use small-screen layout as the default with a media query to handle larger screens.
- Incorporate breakpoint styles into main SCSS files for ease of development and since we aren't using stylesheet switching yet.
- Switched from inline styles to flexbox for homepage social media links.
- Simplified styling of Tri-Cities and Spokane landing pages.
- Updated CSS for home page to simplify and refresh appearance.
- Simplified Builder banner styles by reverting to base Spine styles with some adjustments.
- Adjust site background colors.
- Restyle site footer display.
- Refactor `footers.php` template part for more organization.
- Restyle expandable search menu for a cleaner display and slide effect.
- Convert theme JS from jQuery to ES6 and refactor search menu toggle controls.
- Refactor header search menu markup to be more accessible and leaner.
- Match pagination style selectors to Spine markup.
- Reverse primary and secondary button styles to make light version standard and dark version into a call-to-action variant.
- Clean up button styles following link style updates.
- Update `.socialicons` styles.
- Just use the WordPress builtin "gallery" naming for all grid lists (get rid of "grid-list" mixin and references).
- Override Spine's blockquote font.
- Tone down header link styles.
- Restyle links to stand out more.
- Switch to Source Sans Pro as primary site font.
- Enqueue Source Sans Pro from Google Fonts.
- Delay enqueuing HRS child theme styles until after all parent and plugin styles have loaded.
- Move `figure` styles to Components.
- Update button styles and organization.
- Move deprecated styles earlier in the stylesheet to allow for overriding.
- Alphabetize utility styles.
- Change `abs-center` class into a scss mixin called `center-middle` that targets the container.

### Added

- New array of font sizes following a 1.1487 scale.
- Icons image directory with a "link" SVG image.
- Separate scss file `_plugins` for styles targeted to adjusting and overriding styles loaded by plugins such as TablePress.
- Baseline data table styles.
- Use nested grid and order to adjust the visual ordering of elements in `recent-articles` grids (logical ordering to promote the title; visual ordering moves the image back to the top).
- Apply "Insider"-style links inside the `main` element, with adjustments for images and article titles.
- Set base font color, weight, size, and family on `main` element.
- Variables for the default font stack and some named color values.
- Border-box style on all `main` elements.

### Deprecated

- Old (unused) experimental design for new application instructions page.
- Old (unused) experimental layout for a new benefits page.
- Old column layout using the `nested*` classes.
- Old callout styles.
- Former `.hrs-gallery` element style class(es) to prefer the standard `.gallery` class.
- Builder Banner styles.
- Former `.hrs-button` button style classes (now style the same as default buttons).
- Font size adjustment on `.two` elements.
- 100% height styles on `html` and `body` probably not needed.
- `.fixed` and `.gray-bg` styles targeting unknown site elements.
- Inline list styles using `inline` class. Replace with flexbox as needed.

### Removed

- Delete old media queries.
- Delete all HRS News styles in favor of standard posts.
- Many old homepage-only styles.
- Many, many Builder banner styles.
- Old template styles for header, footer, and article author display.
- Old tabbed content styles.
- Don't use a mixin for buttons. Redundant.
- Do not override padding styles of the main parent theme (yet).
- Do not need to set all elements to `border-box` since Spine parents already sets relevant elements.
- Remove unneeded `<hr>` styles.

## 0.10.2 (2018-04-27)

### Fixed

- Upgade npm hoek dependency to ~> 5.0.3 to fix vulnerability.

## 0.10.1 (2018-04-09)

### Fixed

- Point HRS child theme to the correct Spine parent theme directory.

### Changed

- Move more table-specific styles to `_plugins.scss` from `_pages.scss`.
- Remove some extraneous styles on the `HTML` and `body` elements.
- Removed the global `display: none!important` rule from `.article-date` fields. If it is needed for a specific subset of pages we can add it back in a less global fashion.
- Rename callout styles to notifications and restyle them.
- Update stylelint config to allow Sass `@extend` rule and not require spaces before at-rules while in blocks.
- Reorder style table of contents to match the pattern library
- Remove extra css source-map from the reference style.css file at root.

### Added

- Basic styles for Grid Lists components.
- A global `_variables.scss` file for storing Sass variables, started with colors.
- Basic styles for a Module component.
- Add "number" type to the Spine `input[type=$]` style.
- Styles for a standard "Card" component using a grid layout.

## 0.9.0 (2018-03-14)

### Fixed

- Clean up styles on global header.
- Spine mobile menu by deprecating old Spine style overrides.
- Clean out unneeded styles for the homepage bulleted lists.
- Fixed search label text color from red-on-gray to white-on-gray.
- Match global header title style to search label text.

### Changed

- Broke up Sass files based on new organization scheme; moved into separate subdirectories.
- Created new CSS organization scheme to flow from globals to elements to components to layouts to templates to pages.
- Update stylesheet with changes from prior 2 years of untracked changes.
- Add .yml extension to .stylelintrc for more reliable syntax detection.
- Update .stylelintrc to exclude comments with URLs from line length limits.
- Update NPM dependency versions (with nonbreaking change in compressed variable placeholder names).

### Deprecated

- Spine style overrides.
- Old button styles.

## 0.8.0 (2018-03-02)

### Changed

- Refactor SCSS so that it passes stylelint testing. Fixes [#16](https://github.com/washingtonstateuniversity/hrs.wsu.edu/issues/16)
- Refactor JS so that it passes eslint testing. Fixes [#14](https://github.com/washingtonstateuniversity/hrs.wsu.edu/issues/14)
- Refactor PHP so that it passes phpcs testing. Fixes [#15](https://github.com/washingtonstateuniversity/hrs.wsu.edu/issues/15)
- Include PHP in the `parts/` directory in phpcs testing.
- Updating full HRS Child Theme with the changes made out of version control over the past 2 years.
    - Update original header template part with previously untracked changes.
    - Update functions file with previously untracked changes.
	- Update header.php with previously untracked changes.

### Added

- NPM scripts for complete build task. Closes [#11](https://github.com/washingtonstateuniversity/hrs.wsu.edu/issues/15)
- NPM script for cumulative lint and code standards testing, run: `npm test`. Closes [#12](https://github.com/washingtonstateuniversity/hrs.wsu.edu/issues/12)
- Homepage background gray patchwork tile.

### Removed

- Unused css3-multi-column.js file.

## 0.7.1 (2018-02-28)

### Fixed

- Changelog formatting and URI.

## 0.7.0 (2018-02-28)

### Changed

- Include composer.lock in version control.
- Correct theme URI and add author in stylesheet header content.
- Enqueue child theme stylesheet with path to minified version.
- Dequeue child theme stylesheet.

### Added

- Warning message about editing SCSS files vs. CSS files.
- Method to retrieve current HRS Child Theme version.

## 0.6.0 (2018-02-27)

### Added

- Build production CSS files.
- Build production JS files.
- Create build task to copy images from `src/assets/images/` to `assets/images/`.

### Changed

- Point header.php and functions.php to JS build version `custom.min.js`.
- Add end-of-file newline in custom.js.
- Move JS files from js/ to src/assets/js.
- Update paths to cream_pixels.png image asset.
- Move cream_pixels.png from `assets/` to `src/assets/images/`.

### Removed

- Delete empty template-parts/ directory because we don't need it for now.

## 0.5.0 (2018-02-22)

### Added

- Basic SVG minification build process using the svgo npm package.

## 0.4.0 (2018-02-22)

### Fixed

- Incorrect version number target for postcss-cli in package.json.
- Duplicate name fields in composer.json.

### Changed

- NPM scripts for sass to css processing and autoprefixing to include minification.
- Add package to npm to handle copying files cross-platform.
- Remove eslint-plugin-wordpress call from eslintrc config file.
- Update composer.json with newer versions of php_codesniffer and wpcs.
- Update package.json with HRS child theme details.
- Update package.json with HRS child theme dev dependencies.

### Added

- A `src` directory for pre-build assets like Sass files, human-readable JavaScript, and uncompressed images.
- Start installation instructions in the readme file.
- Use browserslist in package.json to specify target browsers for autoprefixer (and for potential future use of eslint-plugin-compat for ESLint and stylelint-no-unsupported-browser-features for Stylelint).
- NPM method to minify css rather than rely on Sass's compress flag, which doesn't do as good a job.
- NPM script for processing scss into css, with minified and human readable versions.
- NPM script for stylelint to lint scss files.
- NPM script for uglifyjs to mangle and compress (and concatenate) js files.
- NPM script to run eslint on source js files for js linting and coding standards.
- Eslint config file (`.eslintrc.json`) with rules to enforce WP coding standards.
- NPM script to run php codesniffer.
- Screenshot file.
- phpcs.ruleset.xml file.
- package.json file.
- composer.json file.
- .stylelintrc file.
- Gitignore file.
- License file.
- .editorconfig file
- Up-to-date changelog.

### Removed

- Broken eslint-plugin-wordpress npm dependency.

## 0.3.1 (2018-01-29)

### Fixed

- Correct version number.

### Changed

- Adjust readme title and add some body content describing the child theme.

## 0.3.0.5 (2016-02-16)

### Changed

- Remove the `ul` `li` footer styles in the red portion of the footer.

## 0.3.0.4 (2016-02-16)

### Changed

- Add the `ul li::before` instead of list-style has carried over to the homepage.

## 0.3.0.3 (2016-02-16)

### Changed

- Various style updates to:

  - Change font color
  - Adjust heading sizes
  - Add side-right aside styles
  - Adjust how other headings proceed each other
  - Adjust ul li squares
  - Add aesthetic element to hr tag
  - Add nested items
  - Add fixed utility class

## 0.3.0.2 (2016-01-06)

### Changed

- Remove the blue browser outline on the tabs.
- Tighten the input box in the search area on the homepage.

## 0.3.0.1 (2016-06-06)

### Changed

- Replace input tabs with js tabs on the homepage.

## 0.3.0 (2016-01-05)

### Changed

- Style updates to:
  - Multiple mobile view adjustments for tabs, parent stretch, footer, and
home nav
  - Compiles anything that has a BG to a few lines
  - Adds in nested styles
  - Style the tab headings and ul

## 0.2.9 (2015-12-23)

### Changed

- Hide search menu on home page.

### Added

- Home nav styles.
- Full banner image styles.
- Input tab styles.

## 0.2.8 (2015-10-15)

### Changed

- Rename and adjust headers template part to display site title on all pages.
- Place foot in main pages.
- Adjust styles.

## 0.2.7 (2015-09-30)

### Fixed

- Add padding to fix Firefox input text cutoff.

### Changed

- List style adjustments and search wrapper margin.

## 0.2.6 (2015-09-28)

### Changed

- Adjust margins on dropdown menus.

## 0.2.5 (2015-09-28)

### Fixed

- Adjust styles and breakpoints to address some responsive display issues:

  -Wider screens: Spine no longer overlaps the search criteria.
  - Smaller screens: Radio buttons now have an appropriate amount of space and the home open close dropdown sticks with the search bar.

## 0.2.4 (2015-09-24)

### Fixed

- Paddings and margins on some mobile displays.

## 0.2.3 (2015-09-18)

### Fixed

- Typo in button hover CSS.

### Added

- Color to button style.

## 0.2.2 (2015-09-18)

### Added

- Background-image styling.

## 0.2.1 (2015-09-18)

### Added

- Button style per HRS request.

## 0.2.0 (2015-09-18)

### Added

- Apply skimmed (cropped) Spine display on homepage even at full width.

## 0.1.16 (2015-09-18)

### Changed

- Adjust breakpoints and display of main header and Spine.

## 0.1.15 (2015-09-18)

### Added

- Styles for tabbed content display on smaller screens.

## 0.1.14 (2015-09-18)

### Added

- Tabs JQuery method.
- Styling for `#tabs` sections to go with JQuery method.

### Changed

- Some margin and text transform adjustments.

## 0.1.13 (2015-09-18)

### Changed

- Add styles to ordered and unordered list `li` elements.
- Add margins to `hr` elements.

## 0.1.12 (2015-09-18)

### Changed

- Stop using `css3-multi-column` JS; remove enqueue script call.

## 0.1.11 (2015-09-18)

### Todo

- Bug: Style sheet not loading?

## 0.1.10 (2015-09-18)

### Changed

- Padding adjustments to `main` elements.

## 0.1.9 (2015-09-16)

### Changed

- Adjust footer margins and Spine icon spacing.

## 0.1.8 (2015-09-16)

### Changed

- Adjust paddings and margins on list items in header and footer.

## 0.1.7 (2015-09-14)

### Fixed

- Remove breaking IE-only CSS.

## 0.1.6 (2015-09-14)

### Added

- Column layout in utility footer.
- Hover color ease transitions.
- Content `|` after "hr sites" in footer.

## 0.1.5 (2015-09-14)

### Changed

- Move footer into position on home and interior pages.
- Set main page footer to 100% width.

## 0.1.4 (2015-09-14)

### Changed

- Position and style footer markup.

### Added

- Footer markup.

## 0.1.3 (2015-09-14)

### Changed

- Make common searches styling more specific.
- Hide common searches by default on the front page.

## 0.1.2 (2015-09-14)

### Added

- Register common search nav menu.

## 0.1.1 (2015-09-14)

### Fixed

- Hide search by default on internal pages, not the home page.

## 0.1.0 (2015-09-14)

### Fixed

- Spacing in functions.php.
- Correct version from "0.8.6" to "0.1.0".

### Changed

- Only hide search by default on the home page.
- Prefix scripts and functions for HRS.
- Abbreviate "Washington State University" as "WSU" in theme name.

### Added

- JS handling for search menu.
- Add common search nav menu.
- Click events to show/hide search areas.

## 0.0.1 (2015-09-11)

### Changed
- Adjusts #spine's pad-top and pad-bottom.
- body.home specific styles for the homepage search bar.
- body.home #spine modifications for the cropped spine.

### Added

- Initial theme for HRS.
- Introduces the search bar for the homepage in the before-main.php.
- Introduces the search bar for the inside pages in the before-main.php.
- Enqueue custom.js (which is blank for now).
- Add theme support for html5 search.
- `.gray-bg` utility style.
- Basic typography styles h1, h2, h3, p, and .main-header.
- `@media` queries for search bars.
- Base readme file.

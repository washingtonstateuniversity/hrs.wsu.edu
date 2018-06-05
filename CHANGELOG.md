# Changelog: WSU HRS Child Theme

Author: WSU Web Communications

Author: Adam Turner

URI: https://github.com/washingtonstateuniversity/hrs.wsu.edu/

This document details all notable changes to the WSU HRS Child Theme. Uses [Semantic Versioning](http://semver.org/) (as of v0.3.1).

<!--
## Major.MinorAddorDeprec.Bugfix (YYYY-MM-DD)

### Todo (for upcoming changes)
### Security (in case of fixed vulnerabilities)
### Fixed (for any bug fixes)
### Changed (for changes in existing functionality)
### Added (for new features)
### Deprecated (for once-stable features removed in upcoming releases)
### Removed (for deprecated features removed in this release)
-->

## (next release) (unreleased)

### Todo

- Move article footer inside the `section` element.
- Set max width on text-based content like posts and standard pages, open #30.
- Clean up templates.
- Set up grid fallbacks, open #31.
- Set up no-js handling for the search form and menu, open #34.
- Get Babel processing working, open #35.
- Determine if we really need the `center-middle` utility class. If yes, look into using a flex or grid with `Xvh` and `Xvh` column and row size to center instead.

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
- Create build task to copy (@todo and possibly compress) images from `src/assets/images/` to `assets/images/`.

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

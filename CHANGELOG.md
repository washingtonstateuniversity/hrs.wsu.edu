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

## 1.0.0-20181114 (:construction: WIP)

### Fixed

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

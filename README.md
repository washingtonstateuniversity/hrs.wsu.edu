# WSU Human Resource Services Theme

A child theme of the Washington State University (WSU) Human Resource Services (HRS) website.

## For Developers

@todo Explain the directory structure, build process, and build and testing tools.

### Initial Setup

1. Install the NPM dependencies.
2. Install the Composer dependencies.
3. Ensure PHP coding standards are properly sniffed.
4. Ensure SASS files are properly linted.
5. Ensure JS files are properly linted and sniffed.

In a terminal:

~~~
npm install
composer install
npm run phpcs
npm run lintscss
npm run lintjs
~~~

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

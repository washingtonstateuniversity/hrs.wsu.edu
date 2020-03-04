/**
 * Module to handle lazy loading images.
 *
 * Works with the Lazy_Load_Images() class in the `includes` directory. The
 * class transposes standard image tag source attributes into data-* attributes
 * and this module adds intersection observers to load those images only just
 * as they are needed.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/API/Intersection_Observer_API
 * @see https://www.smashingmagazine.com/2018/01/deferring-lazy-loading-intersection-observer-api/
 * @see https://github.com/deanhume/lazy-observer-load
 *
 * @package WSU_Human_Resources_Services
 * @since 1.0.0
 */

const images = /** @type {Element[]} */ ( document.querySelectorAll(
	'[data-src]'
) );
const config = {
	rootMargin: '100px 0px',
	threshold: 0,
};

let imageCount = images.length;
let observer;

/*
 * Replaces select image source attribute values with data-* counterparts.
 *
 * @since 1.0.0
 *
 * @param {string} img An HTML image element.
 */
const applyImage = function replaceImageAttributeValues( img ) {
	const src = img.getAttribute( 'data-src' );

	if ( ! src || 'undefined' === typeof src ) {
		return;
	}

	const srcset = img.getAttribute( 'data-srcset' );
	const sizes = img.getAttribute( 'data-sizes' );

	// Update the image element `src` attribute with the value of `data-src`.
	img.src = src;

	if ( srcset ) {
		img.srcset = srcset;
	}

	if ( sizes ) {
		img.sizes = sizes;
	}
};

/**
 * Replaces all placeholder images immediately; skips the Intersection Observer.
 *
 * A fallback method for browsers that don't yet support Intersection Observer.
 * And because IE doesn't support `forEach()`, we use a "for" loop instead.
 *
 * @since 1.0.0
 *
 * @param {Array} imagesArray All image elements with placeholders on the page.
 */
function loadImagesNow( imagesArray ) {
	for ( let i = 0; i < imagesArray.length; i++ ) {
		const image = imagesArray[ i ];
		applyImage( image );
	}
}

/**
 * Handles intersection of observed elements.
 *
 * On intersection this function decrements the number of observed images,
 * calls the `applyImage` method to load the correct image, then unobserves
 * the element.
 *
 * @since 1.0.0
 *
 * @param {Array}  entries The elements to watch for interection.
 * @param {Object} self    Reference to the Intersection Observer instance.
 */
const handleIntersection = function loadOnIntersection( entries, self ) {
	entries.forEach( ( entry ) => {
		// Disconnect if we've loaded all of the images.
		if ( 0 === imageCount ) {
			observer.disconnect();
		}

		if ( entry.isIntersecting ) {
			imageCount--;
			applyImage( entry.target );
			self.unobserve( entry.target );
		}
	} );
};

/**
 * Initializes the image lazy load observer.
 *
 * Adds an observer for each element in the `images` array.
 *
 * @since 1.0.0
 */
export default function initLazyImages() {
	if ( ! ( 'IntersectionObserver' in window ) ) {
		loadImagesNow( images );
	} else {
		observer = new IntersectionObserver( handleIntersection, config );

		images.forEach( ( image ) => {
			observer.observe( image );
		} );
	}
}

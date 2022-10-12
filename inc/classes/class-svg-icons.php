<?php
/**
 * SVG Icons class
 *
 * @package HrswpTheme
 * @since 3.5.0
 */

namespace HrswpTheme\inc\Class_SVG_Icons;

/**
 * This class helps display SVG icons.
 *
 * @since 3.5.0
 */
class SVG_Icons {
	/**
	 * SVG Icons.
	 *
	 * @since 3.5.0
	 *
	 * @var array
	 */
	protected static $icons = array(
		'trees'  => '<svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M27.85 43v-6.2h4.35V43Zm-12 0v-7.6H1.9L11 22.15H6.45L18 5.75l11.55 16.4h-4.5l9.1 13.25H20.2V43Zm20-7.6-8.1-11.85h4.5L24.85 13 30 5.75l11.55 16.4h-4.5L46.1 35.4Z"/></svg>',
		'rocket' => '<svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="m9.5 42.6 7.75-3.05q-1.45-3.45-2.125-6.35-.675-2.9-.925-6.75l-3.05 2.05q-.8.5-1.225 1.325-.425.825-.425 1.725Zm9.2-3.8h10.6q1.4-3.4 2.15-6.85.75-3.45.75-6.9 0-5.75-2.15-10.725T24 6.2q-3.9 3.15-6.05 8.125T15.8 25.05q0 3.45.75 6.9t2.15 6.85ZM24 25.15q-1.3 0-2.225-.925T20.85 22q0-1.3.925-2.225T24 18.85q1.3 0 2.225.925T27.15 22q0 1.3-.925 2.225T24 25.15ZM38.45 42.6V31.55q0-.9-.425-1.725Q37.6 29 36.85 28.55l-3.05-2.1q-.3 3.85-.95 6.775-.65 2.925-2.1 6.325Z"/></svg>',
		'wrench' => '<svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M35.65 41.35 22.45 28.1q-1.15.45-2.325.75-1.175.3-2.475.3-4.65 0-7.95-3.275T6.4 17.9q0-1.35.325-2.65.325-1.3.975-2.45l7.15 7.1 5-4.8-7.2-7.25q1.15-.65 2.425-1t2.575-.35q4.75 0 8.1 3.35 3.35 3.35 3.35 8.05 0 1.35-.275 2.525-.275 1.175-.775 2.275L41.3 35.9q.45.5.45 1.2t-.45 1.15l-3.35 3.15q-.5.45-1.15.425-.65-.025-1.15-.475Z"/></svg>',
		'lab'    => '<svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9 41q-1.6 0-2.275-1.475-.675-1.475.425-2.675l12.3-14.15V9.25H16.6q-.45 0-.775-.325T15.5 8.1q0-.45.325-.775T16.6 7h14.8q.45 0 .775.325t.325.825q0 .5-.325.8-.325.3-.775.3h-2.85V22.7l12.3 14.15q1.1 1.2.425 2.675Q40.6 41 39 41Z"/></svg>',
	);

	/**
	 * Gets the SVG for a requested icon.
	 *
	 * @static
	 *
	 * @since 3.5.0
	 *
	 * @param string $icon The name of the icon.
	 * @param int    $size The icon size, in pixels.
	 * @return string The requested icon SVG HTML.
	 */
	public static function get_svg( string $icon, int $size ): string {
		$svg = '';
		if ( array_key_exists( $icon, self::$icons ) ) {
			$repl = sprintf(
				'<svg class="svg-icon" width="%1$d" height="%1$d" aria-hidden="true" role="img" focusable="false" ',
				esc_attr( $size )
			);

			// Add extra attributes to SVG code.
			$svg = preg_replace( '/^<svg /', $repl, trim( self::$icons[ $icon ] ) );
		}

		return $svg;
	}
}

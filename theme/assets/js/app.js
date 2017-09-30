
/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
 
(function ($) {

	const nav = $('#site-navigation');
	const tgl = $('#nav-toggle');

	var navIsOpen = false;

	tgl.on('click', function () {
		if (navIsOpen) {
			nav.removeClass('nav-is-open');
			tgl.removeClass('nav-is-open');
		} else {
			nav.addClass('nav-is-open');
			tgl.addClass('nav-is-open');
		}

		navIsOpen = !navIsOpen;
	});


} (jQuery));

/**
 * File skip-link-focus-fix.js.
 *
 * Helps with accessibility for keyboard only users.
 *
 * Learn more: https://git.io/vWdr2
 */
(function() {
	var isIe = /(trident|msie)/i.test( navigator.userAgent );

	if ( isIe && document.getElementById && window.addEventListener ) {
		window.addEventListener( 'hashchange', function() {
			var id = location.hash.substring( 1 ),
				element;

			if ( ! ( /^[A-z0-9_-]+$/.test( id ) ) ) {
				return;
			}

			element = document.getElementById( id );

			if ( element ) {
				if ( ! ( /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) ) {
					element.tabIndex = -1;
				}

				element.focus();
			}
		}, false );
	}
})();

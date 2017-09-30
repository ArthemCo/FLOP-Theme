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

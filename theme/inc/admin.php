<?php
/**
 * Remove WordPress branding in key locations
 *
 * @package flop
 */


/**
 * Remove the "Howdy, X" greeting fromn the admin window
 */
function change_howdy($translated, $text, $domain) {

    if (!is_admin() || 'default' != $domain)
        return $translated;

    if (false !== strpos($translated, 'Howdy'))
        return str_replace('Howdy', 'Welcome', $translated);

    return $translated;
}
add_filter('gettext', 'change_howdy', 10, 3);

/**
 * Remove WordPress name from adming interface footer 
 */
function change_admin_footer_text() {
    return '';
}
add_filter('admin_footer_text', 'change_admin_footer_text');




function flop_admin_css() {

	echo '';

}
add_action('admin_head','flop_admin_css');


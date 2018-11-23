<?php

define('THEME_URL', get_stylesheet_directory_uri());

define('THEME_PATH', get_stylesheet_directory());

define('INC_PATH', THEME_PATH.'/includes');

define('LIB_URL', THEME_URL.'/libraries');

require_once INC_PATH.'/class.spsdev.php';

/**
 * TGM Plugin Activation
 */
require_once THEME_PATH.'/TGM-Plugin-Activation/class-tgm-plugin-activation.php';

/** @internal */
function _action_theme_register_required_plugins() {
	tgmpa( array(
		array(
			'name'      => 'Unyson',
			'slug'      => 'unyson',
			'required'  => true,
		),
		// array(
		// 	'name'      => 'Polylang',
		// 	'slug'      => 'polylang',
		// 	'required'  => true,
		// ),
	) );
}
add_action( 'tgmpa_register', '_action_theme_register_required_plugins' );
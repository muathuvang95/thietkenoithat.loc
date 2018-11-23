<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$manifest               = array ();
$manifest['id']         = 'spsdev-tka';
$manifest['name']       = 'TKA';
$manifest['author']     = 'spsdev';
$manifest['author_uri'] = 'http://dev.sps.vn/';

$manifest['supported_extensions'] = array(
	'page-builder' => array(),
	'breadcrumbs' => array(),
	'wp-shortcodes' => array(),
	'portfolio' => array(),
);

$manifest['requirements'] = array(
	/*
    'wordpress' => array(
        'min_version' => '4.0',
        'max_version' => '4.99.9'
    ),
    'framework' => array(
        'min_version' => '1.0.0',
        'max_version' => '1.99.9'
    ),
    */
    'extensions' => array(
        /*'extension_name' => array(),*/
        /*'extension_name' => array(
            'min_version' => '1.0.0',
            'max_version' => '2.99.9'
        ),*/
        'page-builder' => array(),
		'breadcrumbs' => array(),
		'wp-shortcodes' => array(),
		'portfolio' => array(),
    ),

);
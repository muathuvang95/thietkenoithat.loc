<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
/**
 * Framework options
 *
 * @var array $options Fill this array with options to generate framework settings form in backend
 */

$options = array(
	fw()->theme->get_options( 'general-settings' ),
	fw()->theme->get_options( 'titlebar-settings' ),
	fw()->theme->get_options( 'pricing-settings' ),
	fw()->theme->get_options( 'portfolio-settings' ),
);

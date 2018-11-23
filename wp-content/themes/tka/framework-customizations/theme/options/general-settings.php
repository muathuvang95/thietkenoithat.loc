<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

//$slides = array();

$options = array(
	'general' => array(
		'title'   => __( 'General' ),
		'type'    => 'tab',
		'options' => array(
			'general-box' => array(
				'title'   => __( 'General Settings' ),
				'type'    => 'box',
				'options' => array(
					'hotline'    => array(
						'label' => __( 'Hotline' ),
						'desc'  => '',
						'type'  => 'text',
						'value' => ''
					),
					'text-copyright'    => array(
						'label' => __( 'Text copyright' ),
						'desc'  => '',
						'type'  => 'text',
						'value' => ''
					),
				)
			),
		)
	)
);

if(function_exists('get_masterslider_names')) {
	$options['general']['options']['general-box']['options']['slider'] = array(
		'label' => __( 'Slider' ),
		'desc'  => '',
		'value'  => '',
		'type'  => 'select',
		'choices' => get_masterslider_names()
	);
}
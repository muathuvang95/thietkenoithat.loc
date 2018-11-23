<?php

if (!defined('FW')) {
    die('Forbidden');
}
$options = array (
    'portfolio-archive' => array (
        'title'   => esc_html__('Portfolio Settings') ,
        'type'    => 'tab' ,
        'options' => array (
            'portfolio-archive-box' => array (
                'title'   => esc_html__('Title Bar Settings') ,
                'type'    => 'box' ,
                'options' => array (
                    'pa_header_txt'   => array (
                        'type'  => 'text' ,
                        'value' => 'Portfolio' ,
                        'label' => esc_html__('Archives Heading') ,
                        'desc'  => esc_html__('') ,
                    ) ,
					'pa_enable_breadcrumbs' => array(
                        'type'  => 'switch',
                        'value' => 'enable',
                        'label' => esc_html__('Breadcrumbs'),
                        'desc'  => esc_html__('Enable or Disable Breadcrumbs.'),
                        'left-choice' => array(
                            'value' => 'enable',
                            'label' => esc_html__('Enable'),
                        ),
                        'right-choice' => array(
                            'value' => 'disable',
                            'label' => esc_html__('Disable'),
                        ),
                    ),
                    'pa_header_bg_color'     => array (
                        'type'  => 'rgba-color-picker' ,
                        'value' => '' ,
                        'label' => esc_html__('Header bg color') ,
                        'desc'  => esc_html__('') ,
                    ) ,
					'pa_header_txt_color' => array(
						'type'  => 'color-picker',
						'value' => '',
						'label' => esc_html__('Heading color'),
						'desc'  => esc_html__(''),
					),
                    'pa_header_bg_image' => array (
                        'type'        => 'upload' ,
                        'label'       => esc_html__('Upload header background image') ,
                        'desc'        => esc_html__('It will override background color') ,
                        'images_only' => true,
                    ) ,
                )
            ) ,
        )
    )
);

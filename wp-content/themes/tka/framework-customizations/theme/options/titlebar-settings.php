<?php

if (!defined('FW')) {
    die('Forbidden');
}
$options = array (
    'subheaders' => array (
        'title'   => esc_html__('Title Bar Settings') ,
        'type'    => 'tab' ,
        'options' => array (
            'subheaders-box' => array (
                'title'   => esc_html__('Header Settings') ,
                'type'    => 'box' ,
                'options' => array (
                    '404_heading'        => array (
                        'type'  => 'text' ,
                        'value' => '404' ,
                        'label' => esc_html__('404 Heading') ,
                        'desc'  => esc_html__('') ,
                    ) ,
                    'blog_heading'        => array (
                        'type'  => 'text' ,
                        'value' => 'Blog' ,
                        'label' => esc_html__('Blog Heading') ,
                        'desc'  => esc_html__('') ,
                    ) ,
                    'archives_heading'   => array (
                        'type'  => 'text' ,
                        'value' => 'Danh sách' ,
                        'label' => esc_html__('Archives Heading') ,
                        'desc'  => esc_html__('') ,
                    ) ,
                    'search_heading'     => array (
                        'type'  => 'text' ,
                        'value' => 'Tìm kiếm' ,
                        'label' => esc_html__('Search Heading') ,
                        'desc'  => esc_html__('' ) ,
                    ) ,
					'enable_breadcrumbs' => array(
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
                    'header_bg_color'     => array (
                        'type'  => 'rgba-color-picker' ,
                        'value' => 'rgba(0,0,0,0.3)' ,
                        'label' => esc_html__('Heading bg color') ,
                        'desc'  => esc_html__('') ,
                    ),

					'header_txt_color' => array(
						'type'  => 'color-picker',
						'value' => '#ffffff',
						'label' => esc_html__('Heading color'),
						'desc'  => esc_html__(''),
					),
                    'header_txt_align'     => array (
                        'type'  => 'select',
                        'value' => '',
                        'label' => esc_html__('Heading text align'),
                        'choices'  => array(
                            '' => '--Select Align--',
                            'left' => 'Left',
                            'right' => 'Right',
                            'center' => 'Center',
                        ),
                    ),
                    'header_bg_image' => array (
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

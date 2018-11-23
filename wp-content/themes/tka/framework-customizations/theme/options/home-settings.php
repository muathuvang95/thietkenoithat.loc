<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

// function adi_get_page_selection(&$return=array(), $parent=0, $level=0) {
// 	$pages = get_posts("post_type=page&posts_per_page=-1&post_status=publish&post_parent=$parent");
	
// 	if($pages) {
// 		foreach ($pages as $value) {
// 			$return[$value->ID] = str_repeat('-', $level).$value->post_title;
// 			adi_get_page_selection($return, $value->ID, $level+1);
// 		}
// 	}
// }
// adi_get_page_selection($pages, 0, 0);

$categories = get_categories( array('hide_empty'=>false,'fields'=>'id=>name') );

function adi_get_slider_selection() {
	global $wpdb;
	$sliders = array(''=>'---');
	$table_name  = $wpdb->prefix . "rich_web_photo_slider_manager";
	$Rich_Web_Slider=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name WHERE id > %d", 0));
		
	foreach ($Rich_Web_Slider as $Rich_Web_Slider1)
	{
		$sliders[$Rich_Web_Slider1->id] = $Rich_Web_Slider1->Slider_Title;
	}
	return $sliders;
}

$options = array(
	'homepage' => array(
		'title'   => __( 'Home page' ),
		'type'    => 'tab',
		'options' => array(
			'homepage-box' => array(
				'title'   => __( 'Home page Settings' ),
				'type'    => 'box',
				'options' => array(
					'solution_page'    => array(
						'label' => __( 'Solution category' ),
						'desc'  => '',
						'value'  => '',
						'type'  => 'select',
						'choices' => $categories
					)
					,'service_page'    => array(
						'label' => __( 'Service category' ),
						'desc'  => '',
						'value'  => '',
						'type'  => 'select',
						'choices' => $categories
					)
					,'slider'    => array(
						'label' => __( 'Slider' ),
						'desc'  => '',
						'value'  => '',
						'type'  => 'select',
						'choices' => adi_get_slider_selection()
					)
					,'project_number_show' => array (
                        'type'  => 'text' ,
                        'value' => 4 ,
                        'label' => esc_html__('Recent Project Number Show') ,
                        'desc'  => esc_html__('' ) ,
                    )
                    ,'recent_posts'    => array(
						'label' => __( 'Category for recent posts' ),
						'desc'  => '',
						'value'  => '',
						'type'  => 'select',
						'choices' => get_categories(array('hide_empty'=>false,'fields'=>'id=>name'))
					)
					,'post_number_show' => array (
                        'type'  => 'text' ,
                        'value' => 4 ,
                        'label' => esc_html__('Recent Post Number Show') ,
                        'desc'  => esc_html__('') ,
                    )
				)
			),
		)
	)
);
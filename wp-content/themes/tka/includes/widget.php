<?php
require_once spsdev::abs_path('widgets/class.social_links_widget.php');
function tka_widgets() {

	register_sidebar( array(
		'name'          => 'Sidebar',
		'id'            => 'sidebar',
		'description'   => __( 'Thanh bên.' ),
		'before_widget' => '<section id="%1$s" class="widget widget-homepage %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => 'Footer info left',
		'id'            => 'footer-left',
		'description'   => __( 'Thêm widget vào bên trái footer.' ),
		'before_widget' => '<section id="%1$s" class="widget widget-homepage %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => 'Footer info right',
		'id'            => 'footer-right',
		'description'   => __( 'Thêm widget vào bên phải footer.' ),
		'before_widget' => '<section id="%1$s" class="widget widget-homepage %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

}
add_action( 'widgets_init', 'tka_widgets' );

/**
* 
*/
class Save_Widgets {
	
	public static $widgets = array();

	public static function add_widget($widget) {
		self::$widgets[] = $widget;
	}

}
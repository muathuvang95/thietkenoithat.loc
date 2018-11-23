<?php 
/**
 * spsdev
 */
class spsdev {

	private static $instance;

	public $editor_styles = array();
	
	private function __construct() {
		
		// remove WP version from css
		add_filter( 'style_loader_src', array($this, 'remove_wp_ver_css_js'), 9999 );
		// remove Wp version from scripts
		add_filter( 'script_loader_src', array($this, 'remove_wp_ver_css_js'), 9999 );

		// if(!get_theme_mod( 'frontend_adminbar', false )) {
		show_admin_bar( false );
		// }

		add_action( 'after_setup_theme', array( $this, 'setup' ) );

		add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ), 99 );

		add_filter( 'the_content', 'shortcode_unautop' );

		add_filter( 'widget_text', 'shortcode_unautop' );

		add_filter( 'widget_text', 'do_shortcode' );

		add_filter( 'excerpt_more', function(){return '...';}, 10, 1 );

		self::inc('template-tags.php');
		self::inc('functions-hook.php');
		self::inc('hooks.php');
		self::inc('class.spsdev_widget.php');
		self::inc('widget.php');
		self::inc('wp-bootstrap-navwalker.php');

		// if(is_admin()) {
		// 	include_once self::abs_path('admin/class.spsdev-admin.php');
		// }
	}

	public function scripts() {

		wp_enqueue_style( 'fontawesome', self::lib('font-awesome/css/font-awesome.min.css') );

		wp_enqueue_style( 'bootstrap', self::lib('bootstrap/css/bootstrap.min.css') );

		// wp_enqueue_style( 'slick', self::lib('slick/slick.css') );
		// wp_enqueue_style( 'slick', self::lib('slick/slick-theme.css') );
		
		wp_enqueue_style( 'blueimp-gallery', self::lib('blueimp-gallery/css/blueimp-gallery.min.css') );

		wp_enqueue_style( 'main', self::url('css/main.css') );

		wp_enqueue_script( 'bootstrap', self::lib('bootstrap/js/bootstrap.min.js'), array('jquery'), '', true );
		
		wp_enqueue_script( 'blueimp-helper', self::lib('blueimp-gallery/js/blueimp-helper.js'), array('jquery'), '', true );
		//wp_enqueue_script( 'blueimp-fullscreen', self::lib('blueimp-gallery/js/blueimp-gallery-fullscreen.js'), array('jquery'), '', true );
		wp_enqueue_script( 'blueimp-gallery', self::lib('blueimp-gallery/js/blueimp-gallery.min.js'), array('jquery'), '', true );
		wp_enqueue_script( 'jquery-blueimp-gallery', self::lib('blueimp-gallery/js/jquery.blueimp-gallery.min.js'), array('jquery'), '', true );

		// wp_enqueue_script( 'slick', self::lib('slick/slick.min.js'), array('jquery'), '', true );

		// wp_enqueue_style( 'fancybox', self::lib('fancybox/jquery.fancybox-1.3.4.css') );
		// wp_enqueue_script( 'easing', self::lib('fancybox/jquery.easing-1.3.pack.js'), array('jquery'), false, true );
		// wp_enqueue_script( 'mousewheel', self::lib('fancybox/jquery.mousewheel-3.0.4.pack.js'), array('jquery'), false, true );
		// wp_enqueue_script( 'fancybox', self::lib('fancybox/jquery.fancybox-1.3.4.pack.js'), array('jquery'), false, true );

		wp_enqueue_script( 'script', self::url('js/script.js'), array('jquery', 'imagesloaded', 'masonry'), '', true );
		wp_localize_script( 'script', 'site', array('home_url'=>home_url(), 'ajax_url'=>admin_url('admin-ajax.php'), 'gmt_offset'=>get_option( 'gmt_offset' )) );

	}

	public function setup() {
		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
		add_theme_support( 'title-tag' );

		/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus( array(
			'main'    => 'Main menu'
		) );

		/*
		* Enable support for Post Formats.
		*
		* See: https://codex.wordpress.org/Post_Formats
		*/
		// add_theme_support( 'post-formats', array(
		//     // 'aside',
		//     // 'image',
		//     // 'video',
		//     // 'quote',
		//     // 'link',
		//     // 'gallery',
		//     // 'audio'
		//   ) );
		
		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
		) );

		// Add theme support for Custom Logo.
		add_theme_support( 'custom-logo', array(
			'width'       => 228,
			'height'      => 57,
			'flex-width'  => true,
			'flex-height'  => false
		) );

		add_theme_support( 'custom-background', array(
			'default-color' => '#ffffff'
		) );

		add_post_type_support( 'fw-portfolio', 'comments' );

		$this->editor_styles = array(
				self::lib('bootstrap/css/bootstrap.min.css'),
				self::url('css/editor-style.css')
			);
		
		add_editor_style( $this->editor_styles );

	}
	
	/**
	 * Call a shortcode function by tag name.
	 */
	public static function do_shortcode( $tag, array $atts = array(), $content = null ) {
	  global $shortcode_tags;

	  if ( ! isset( $shortcode_tags[ $tag ] ) ) {
	    return false;
	  }

	  return call_user_func( $shortcode_tags[ $tag ], $atts, $content, $tag );
	}

	public static function remove_wp_ver_css_js($src) {
	  if ( strpos( $src, 'ver=' ) )
	    $src = remove_query_arg( 'ver', $src );
	  return $src;
	}

	public static function url($file_path, $echo=false) {
		if($echo) {
			echo THEME_URL.'/'.trim( $file_path, '/\\' );
		} else {
			return THEME_URL.'/'.trim( $file_path, '/\\' );
		}
	}

	public static function inc($file_path, $require=true) {
		if($require) {
			require_once INC_PATH.'/'.trim( $file_path, '/\\' );
		} else {
			include_once INC_PATH.'/'.trim( $file_path, '/\\' );
		}
	}

	public static function abs_path($file_path) {
		return THEME_PATH.DIRECTORY_SEPARATOR.trim( $file_path, '/\\' );
	}

	public static function lib($file_path) {
		return LIB_URL.'/'.trim( $file_path, '/\\' );
	}

	public static function get_instance() {
		if(empty(self::$instance))
			self::$instance = new self;
		return self::$instance;
	}

	public static function debug($var, $escape=true, $dump=false) {
		echo '<pre>';
		ob_start();
		if($dump) {
			var_dump($var);
		} else {
			print_r($var);
		}
		$debug = ob_get_clean();
		if($escape) {
			echo esc_html($debug);
		} else {
			echo $debug;
		}
		echo '</pre>';
	}

} // class: spsdev

return spsdev::get_instance();
<?php
class Social_Links_Widget extends Spsdev_Widget {

	public function __construct() {

		parent::__construct( 'social-links', 'Social Links Widget' );

		/*
		 * popular fields
		 */
		$this->add_field( 'title', array( 'type' => 'text', 'data_type' => 'text', 'label' => 'Tiêu đề', 'description' => 'Tiêu đề widget' ) );

		/*
		 * custom fields
		 */
		$this->add_field( 'facebook_url', array( 'type' => 'text', 'data_type' => 'url', 'label' => 'Facebook Page', 'description' => 'URL Trang facebook' ) );

		$this->add_field( 'google_plus_url', array( 'type' => 'text', 'data_type' => 'url', 'label' => 'Google Plus', 'description' => 'URL Trang G+' ) );

		$this->add_field( 'youtube_url', array( 'type' => 'text', 'data_type' => 'url', 'label' => 'Youtube URL', 'description' => 'URL Kênh Youtube' ) );

		$this->add_field( 'twitter_url', array( 'type' => 'text', 'data_type' => 'url', 'label' => 'Twitter URL', 'description' => 'URL Twitter' ) );

		$this->add_field( 'feed_url', array( 'type' => 'text', 'data_type' => 'url', 'label' => 'Feed URL', 'description' => '' ) );

		/*
		 * popular extra fields
		 */
		$this->add_field( 'inner_class', array( 'type' => 'text', 'data_type' => 'text', 'label' => 'Inner html class', 'description' => 'Html class wrap inner widget' ) );

		$this->add_field( 'body_class', array( 'type' => 'text', 'data_type' => 'text', 'label' => 'Widget body html class', 'description' => 'Html class wrap body widget' ) );

		$this->add_field( 'container_tag', array( 'type' => 'text', 'data_type' => 'key', 'label' => 'Container Tag', 'description' => 'Thẻ html của widget' ) );

		$this->add_field( 'title_tag', array( 'type' => 'text', 'data_type' => 'key', 'label' => 'Title Tag', 'description' => 'Thẻ html của tiêu đề widget' ) );

		$this->add_field( 'title_class', array( 'type' => 'text', 'data_type' => 'text', 'label' => 'Title Html Class', 'description' => 'Class Thẻ html của tiêu đề widget' ) );

		$this->add_field( 'xclass', array( 'type' => 'text', 'data_type' => 'text', 'label' => 'X-Class', 'description' => 'html class mở rộng cho widget' ) );
	}

	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}
		
		/*
		 * extra data
		 */
		

		/*
		 popular data
		 */
		$title                 = ( ! empty( $instance['title'] ) ) ? $instance['title'] : $obj_category->name;
		
		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title                 = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$container_tag         = (!empty($instance['container_tag'])) ? sanitize_key($instance['container_tag']) : 'section';
		
		$title_tag             = (!empty($instance['title_tag'])) ? sanitize_key($instance['title_tag']) : 'h3';
		
		$title_class                = (!empty($instance['title_class'])) ? sanitize_text_field($instance['title_class']) : '';

		$xclass                = (!empty($instance['xclass'])) ? sanitize_text_field($instance['xclass']) : '';

		$container_class = array('widget');
		$container_class[] = $this->id_base;
		$container_class[] = $args['widget_id'];
		if($xclass!='')
			$container_class[] = $xclass;
		
		$args['before_widget'] = '<'.$container_tag.' id="'.esc_attr($args['widget_id']).'" class="'.esc_attr(implode(' ',$container_class)).'">';
		
		$args['after_widget']  = '</'.$container_tag.'>';
		
		$wg_title_class = array('widget-title');
		if($title_class!='')
			$wg_title_class[] = $title_class;

		$args['before_title']  = '<'.$title_tag.' class="'.esc_attr(implode(' ',$wg_title_class)).'">';
		
		$args['after_title']   = '</'.$title_tag.'>';

        
        $inner_class = !empty($instance['inner_class']) ? sanitize_text_field($instance['inner_class']) : '';
        $wg_inner_class = array('widget-inner');
        if($inner_class!='')
        	$wg_inner_class[] = $inner_class;

        $body_class = !empty($instance['body_class']) ? sanitize_text_field($instance['body_class']) : '';
        $wg_body_class = array('widget-body');
        if($body_class!='')
        	$wg_body_class[] = $body_class;

        /*
         * display widget on fron-end
         */
		echo $args['before_widget'];

		echo '<div class="'.esc_attr(implode(' ', $wg_inner_class)).'">';

		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		echo '<div class="'.esc_attr(implode(' ', $wg_body_class)).'">';
		/*
		 * custom display
		 */
		$facebook_url = (!empty($instance['facebook_url'])) ? esc_url($instance['facebook_url']) : '';
		$google_plus_url = (!empty($instance['google_plus_url'])) ? esc_url($instance['google_plus_url']) : '';
		$youtube_url = (!empty($instance['youtube_url'])) ? esc_url($instance['youtube_url']) : '';
		$twitter_url = (!empty($instance['twitter_url'])) ? esc_url($instance['twitter_url']) : '';
		$feed_url = (!empty($instance['feed_url'])) ? esc_url($instance['feed_url']) : '';

		if($facebook_url!='') {
			printf('<a href="%s" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>', $facebook_url);
		}
		if($google_plus_url!='') {
			printf('<a href="%s" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a>', $google_plus_url);
		}
		if($youtube_url!='') {
			printf('<a href="%s" target="_blank"><i class="fa fa-youtube" aria-hidden="true"></i></a>', $youtube_url);
		}
		if($twitter_url!='') {
			printf('<a href="%s" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>', $twitter_url);
		}
		if($feed_url!='') {
			printf('<a href="%s" target="_blank"><i class="fa fa-feed" aria-hidden="true"></i></a>', $feed_url);
		}
		
		
		echo '</div><!-- .widget-body -->';

		echo '</div><!-- .widget-inner -->';
		
		echo $args['after_widget'];
	}

}

register_widget( 'Social_Links_Widget' );
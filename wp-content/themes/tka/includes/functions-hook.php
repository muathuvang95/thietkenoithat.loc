<?php

function projects_post_type_name($names) {
	$names = array(
				'singular' => 'Công trình',
				'plural'   => 'Công trình'
			);
	return $names;
}

function tka_header_styles() {
	$header_txt_color = '';
	$header_bg_color = '';
	$header_bg_image = '';

	$header_txt_color = fw_get_db_settings_option('header_txt_color');
	$header_txt_align = fw_get_db_settings_option('header_txt_align');
	$header_txt_color = fw_get_db_settings_option('header_txt_color');
	$header_bg_color = fw_get_db_settings_option('header_bg_color');
	$header_bg_image = fw_get_db_settings_option('header_bg_image');

	//fw_print($header_bg_image);
	
	if(is_page()) {
		global $post;
		if(has_post_thumbnail($post)) {
			$header_bg_image['attachment_id'] = get_post_thumbnail_id($post);
			$header_bg_image['url'] = get_the_post_thumbnail_url( $post, 'full' );
		}
	} elseif (is_archive()) {
		if(is_post_type_archive('fw-portfolio')) {
			$txt_color = fw_get_db_settings_option('pa_header_txt_color');
			$breadcrumb = fw_get_db_settings_option('pa_enable_breadcrumbs');
			$bg_color = fw_get_db_settings_option('pa_header_bg_color');
			$bg_image = fw_get_db_settings_option('pa_header_bg_image');

			if($txt_color!='') {
				$header_txt_color = $txt_color;
			}
			if($bg_color!='') {
				$header_bg_color = $bg_color;
			}
			if($bg_image!='') {
				$header_bg_image = $bg_image;
			}
		} elseif (is_post_type_archive('product')) {
			$txt_color = fw_get_db_settings_option('pro_header_txt_color');
			$breadcrumb = fw_get_db_settings_option('pro_enable_breadcrumbs');
			$bg_color = fw_get_db_settings_option('pro_header_bg_color');
			$bg_image = fw_get_db_settings_option('pro_header_bg_image');

			if($txt_color!='') {
				$header_txt_color = $txt_color;
			}
			if($bg_color!='') {
				$header_bg_color = $bg_color;
			}
			if($bg_image!='') {
				$header_bg_image = $bg_image;
			}
		}
	} elseif (is_singular()) {
		global $post;
		if(has_post_thumbnail($post)) {
			$header_bg_image['attachment_id'] = get_post_thumbnail_id($post);
			$header_bg_image['url'] = get_the_post_thumbnail_url( $post, 'full' );
		}
	}
	?>
	<style type="text/css" id="page-heading-css">
		#page-heading {
			<?php
			if($header_bg_color!='') {
				echo 'background-color: '.$header_bg_color.';';
			}
			if($header_bg_image['url']!='') {
				echo 'background-image: url('.$header_bg_image['url'].');';
			}
			?>
			background-size: cover;
		}
		#page-heading .heading {
			<?php
			if($header_txt_color!='') {
				echo 'color: '.$header_txt_color.';';
			}
			if($header_txt_align!='') {
				echo 'text-align: '.$header_txt_align.';';
			}
			?>
		}
	</style>
	<?php
}
<?php
function spsdev_boolval($var) {
  # '1','-1','1.1','2','true' => true
  # '','0.0','0','false' => false
  return (bool)json_decode(strtolower($var));
}

function format_content($raw_string) {
  return do_shortcode( shortcode_unautop( wpautop( $raw_string ) ) );
}

function unautop($s) {
    //remove any new lines already in there
    $s = str_replace("\n", "", $s);

    //remove all <p>
    $s = str_replace("<p>", "", $s);

    //replace <br /> with \n
    $s = str_replace(array("<br />", "<br>", "<br/>"), "", $s);

    //replace </p> with \n\n
    $s = str_replace("</p>", "", $s);       

    return $s;      
}

// unautop excerpt
function spsdev_unautop_excerpt($excerpt) {
  remove_filter( 'the_excerpt', 'wpautop' );
  return $excerpt;
}

function spsdev_excerpt_more() {
	return '';
}

function spsdev_get_excerpt($post=null, $limit=100) {
	
	$post = get_post($post);
	
	$excerpt = $post->post_excerpt;
	$content = $post->post_content;

	if(''==$excerpt) {
		$content = strip_shortcodes( $content );
		$content = str_replace(']]>', ']]&gt;', $content);
		$content = strip_tags($content);
		$excerpt = $content;
	}

	if(mb_strlen($excerpt)>$limit)
		$excerpt = mb_substr($excerpt, 0, $limit).'...';

	return $excerpt;

}

function term_id_map($term) {
	return $term->term_id;
}
function term_slug_map($term) {
	return $term->slug;
}
function term_name_map($term) {
	return $term->name;
}

/**
 * Retrieve the archive title based on the queried object.
 *
 * @since 4.1.0
 *
 * @return string Archive title.
 */
function spsdev_archive_title() {
	if ( is_category() ) {
		/* translators: Category archive title. 1: Category name */
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		/* translators: Tag archive title. 1: Tag name */
		$title = single_tag_title( '', false );
	} elseif ( is_author() ) {
		/* translators: Author archive title. 1: Author name */
		$title = sprintf(
				__('Tác giả: %s'),
				'<span class="vcard">' . get_the_author() . '</span>'
			);
	} elseif ( is_year() ) {
		/* translators: Yearly archive title. 1: Year */
		$title = sprintf(
				__('Năm: %s'),
				get_the_date( 'Y' )
			);
	} elseif ( is_month() ) {
		/* translators: Monthly archive title. 1: Month name and year */
		$title = sprintf( 
				__('Tháng %s năm %s'),
				get_the_date( 'm' ), 
				get_the_date( 'Y' ) 
			);
	} elseif ( is_day() ) {
		/* translators: Daily archive title. 1: Date */
		$title = sprintf( 
				__('Ngày %s tháng %s năm %s'), 
				get_the_date( 'd' ), get_the_date( 'm' ), 
				get_the_date( 'Y' ) 
			);
	} elseif ( is_tax( 'post_format' ) ) {
		if ( is_tax( 'post_format', 'post-format-aside' ) ) {
			$title = __('Bên lề');
		} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
			$title = __('Bộ sưu tập');
		} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
			$title = __('Hình ảnh');
		} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
			$title = __('Video');
		} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
			$title = __('Lưu ý');
		} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
			$title = __('Liên kết');
		} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
			$title = __('Trạng thái');
		} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
			$title = __('Âm thanh');
		} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
			$title = __('Tán gẫu');
		}
	} elseif ( is_post_type_archive() ) {
		/* translators: Post type archive title. 1: Post type name */
		$title = post_type_archive_title( '', false );
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		/* translators: Taxonomy term archive title. 1: Taxonomy singular name, 2: Current taxonomy term */
		$title = sprintf( '%1$s: %2$s', $tax->labels->singular_name, single_term_title( '', false ) );
	} elseif ( is_search() ) {
		$title = sprintf(
				__('Tìm kiếm: "%s"'),
				get_search_query()
			);
	} else {
		$title = __('Lưu trữ');
	}

	/**
	 * Filters the archive title.
	 *
	 * @since 4.1.0
	 *
	 * @param string $title Archive title to be displayed.
	 */
	return $title;
}
/* -------------------------------------------------------- */
function tka_projects_featured() {
	$portfolio = fw()->extensions->get( 'portfolio' );
	$projects = new WP_Query(array(
		'post_type' => $portfolio->get_post_type_name(),
		'posts_per_page' => 24,
		'post_status' => 'publish',
		'orderby' => 'date',
		'order' => 'desc'
	));
	//fw_print($projects);
	if($projects->have_posts()):
	?>
	<div id="projects_featured">
		<div class="container">
			<div class="heading">
				<h3>Công trình tiêu biểu</h3>
			</div>
			<div class="row">
				<?php while ($projects->have_posts()) {
					$projects->the_post();
					$image = get_the_post_thumbnail_url(null, 'medium_large');
					// @list( $width, $height ) = getimagesize( $image );
					// $ratio = 100*$height/$width;
					// $image_class = ($ratio<=70)?'hor':'ver';
					?>
					<div class="project col-sm-6 col-md-3">
						<div class="inner">
							<span class="before"></span>
							<a href="<?php the_permalink(); ?>" style="background-image: url(<?=$image?>);background-size:cover;">
								<?php //the_post_thumbnail('medium_large', array('alt'=>esc_attr(get_the_title()), 'class'=>'image '.$image_class)); ?>
								<h2><?php the_title(); ?></h2>
							</a>
							<span class="after"></span>
						</div>
					</div>
					<?php
				} ?>
			</div>
		</div>
	</div>
	<?php
	endif;
	wp_reset_postdata();
}

function tka_pricings() {
	$pricings = fw_get_db_settings_option('pricings');
	echo '<div id="pricing"><div class="container"><div class="row">';
	foreach ($pricings as $key => $pricing) {
		?>
		<div class="pricing col-sm-4">
			<div class="pricing-inner">
				<div class="header"><?=esc_html($pricing['header'])?></div>
				<div class="body"><?=format_content($pricing['body'])?></div>
				<div class="footer"><?php
				if($pricing['url']!='') {
					echo '<a class="btn btn-danger" href="'.esc_url($pricing['url']).'">Chi tiết</a>';
				}
				?></div>
			</div>
		</div>
		<?php
	}
	echo '</div></div></div>';
}

function tka_blog_posts() {
	$recent_posts = wp_get_recent_posts(array('numberposts'=>3,'post_status'=>'publish'), OBJECT);
	if($recent_posts):
	echo '<div id="blog-post"><div class="container"><div class="row">';
	foreach ($recent_posts as $key => $value) {
		$image = get_the_post_thumbnail_url($value, 'medium_large');
		?>
		<div class="col-sm-4">
			<a class="inner" href="<?php echo get_permalink($value); ?>">
				<span class="image" style="background-image: url(<?=$image?>);background-size: cover;"><?php //echo get_the_post_thumbnail($value, 'medium_large', array('alt'=>esc_attr(get_the_title($value)), 'class'=>$image_class)); ?></span>
				<h2 class="title"><?php echo get_the_title($value); ?></h2>
			</a>
		</div>
		<?php
	}
	echo '</div></div></div>';
	endif;
}

function tka_home_heading() {
	?>
	<div id="home-heading">
		<div class="container">
			<div>
				<h1 class="site-title"><?php echo wp_kses_post(html_entity_decode(get_bloginfo( 'name' ))); ?></h1>
				<h2 class="site-description"><?php echo wp_kses_post(html_entity_decode(get_bloginfo( 'description' ))); ?></h2>
			</div>
		</div>
	</div>
	<?php
}

function tka_heading() {
	$header_txt = '';
	$breadcrumb = 'enable';

	$breadcrumb = fw_get_db_settings_option('enable_breadcrumbs');

	//fw_print($header_bg_image);
	
	if(is_home()) { // blog page
		$header_txt = fw_get_db_settings_option('blog_heading');
	 } elseif(is_page()) {
		global $post;
		$header_txt = $post->post_title;
	} elseif (is_archive()) {
		if(is_post_type_archive('fw-portfolio')) {
			$header_txt = fw_get_db_settings_option('pa_header_txt');
			$breadcrumb = fw_get_db_settings_option('pa_enable_breadcrumbs');
		
		} elseif (is_post_type_archive('product')) {
			$header_txt = fw_get_db_settings_option('pro_header_txt');
			$breadcrumb = fw_get_db_settings_option('pro_enable_breadcrumbs');

		} elseif (is_tax()) {
			$term = get_queried_object();
			$header_txt = $term->name;
		}
	} elseif (is_singular()) {
		global $post;
		$header_txt = $post->post_title;
	}
	?>
	<div id="page-heading">
		<div class="container">
			<h1 class="heading"><?=esc_html($header_txt)?></h1>
			<?php
			if($breadcrumb=='enable') {
				echo fw_ext_get_breadcrumbs( '\\' );
			}
			?>
		</div>
	</div>
	<?php
}

function tka_pagination() {
	?>
	<div class="pagination-links"><div class="pagination">
	<?php
	echo paginate_links(array(
			'prev_text' => '&laquo;',
			'next_text' => '&raquo;'
		));
	?>
	</div></div>
	<?php
}

function fw_portfolio_related() {
	global $post;
	$terms = wp_get_post_terms( $post->ID, 'fw-portfolio-category' );
	$args = array(
				'post_type' => 'fw-portfolio',
				'posts_per_page' => 8,
				'post_status' => 'publish',
				'post__not_in' => array($post->ID)
			);
	if($terms) {
		$terms_slugs = array_map('term_slug_map', $terms);
		$args['tax_query'] = array(
								array(
									'taxonomy' => 'fw-portfolio-category',
									'field' => 'slug',
									'terms' => $terms_slugs
								)
							);
	}
	$query = new WP_Query($args);
	if($query->have_posts()):
	?>
	<div class="fw-portfolio-related">
		<div class="heading">Các công trình tương tự</div>
		<div class="row">
			<?php
			while ($query->have_posts()) {
				$query->the_post();
				$image = get_the_post_thumbnail_url(null, 'medium_large');
				$post_id = get_the_ID();
				$excerpt = fw_get_db_post_option($post_id, '_excerpt');
				?>
				<div class="item col-sm-6 col-md-3">
					<a class="inner" href="<?php the_permalink(); ?>">
						<span class="image"><span style="background-image: url(<?=$image?>);background-size:cover;"></span></span>
						<div class="desc"><?php echo wp_kses_post($excerpt); ?></div>
					</a>
				</div>
				<?php
			}
			wp_reset_postdata();
			?>
		</div>
	</div>
	<?php
	endif;
}

function tka_posts_related() {
	global $post;
	$cats = get_the_category();
	$args = array(
				'post_type' => 'post',
				'posts_per_page' => 10,
				'post_status' => 'publish',
				'post__not_in' => array($post->ID)
			);
	if($cats) {
		$cats_slugs = array_map('term_slug_map', $cats);
		$args['tax_query'] = array(
								array(
									'taxonomy' => 'category',
									'field' => 'slug',
									'terms' => $cats_slugs
								)
							);
	}
	$query = new WP_Query($args);
	if($query->have_posts()):
	?>
	<div class="posts-related">
		<div class="heading">Bài viết liên quan</div>
		<ul class="list-unstyled">
			<?php
			while ($query->have_posts()) {
				$query->the_post();
				?>
				<li>
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?> <i>(<?php the_time('d/m/Y'); ?>)</i></a>
				</li>
				<?php
			}
			wp_reset_postdata();
			?>
		</ul>
	</div>
	<?php
	endif;
}

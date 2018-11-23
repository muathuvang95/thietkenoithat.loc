<article id="post-<?php the_ID(); ?>" <?php post_class('col-sm-6 col-md-3'); ?>>
	<?php
	$image = get_the_post_thumbnail_url(null, 'medium_large');
	$price = fw_get_db_post_option(get_the_ID(), '_price');
	if($price>0) {
		$price = number_format($price, 0, '.', ',').'vnđ';
	} else {
		$price = 'liên hệ';
	}
	?>
	<a class="inner" href="<?php the_permalink(); ?>">
		<span class="image" style="background-image: url(<?=$image?>);background-size:cover;"></span>
		<div class="summary">
			<h3 class="title"><?php the_title(); ?></h3>
			<div class="price">Giá: <?php echo $price; ?></div>
		</div>
	</a>
</article>
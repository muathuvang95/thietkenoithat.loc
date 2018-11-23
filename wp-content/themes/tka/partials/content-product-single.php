<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	$price = fw_get_db_post_option(get_the_ID(), '_price');
	if($price>0) {
		$price = number_format($price, 0, '.', ',').'vnđ';
	} else {
		$price = 'liên hệ';
	}

	the_content();
	?>
	<div class="price">Giá: <?php echo $price; ?></div>
</article>

<?php
/*
 * archive portfolio template
 */
get_header();
?>
<div id="main" class="wrapper">
	<div class="container content-area">
		<div class="row">
			<?php
			while (have_posts()) {
				the_post();
				$image = get_the_post_thumbnail_url(null, 'medium_large');
				$post_id = get_the_ID();
				$excerpt = fw_get_db_post_option($post_id, '_excerpt');
				?>
				<div <?php post_class('col-sm-6 col-md-3'); ?>>
					<div class="border"><a class="inner" href="<?php the_permalink(); ?>" style="background-image: url(<?=$image?>);background-size: cover;">
						<div class="info">
							<h2><?php the_title(); ?></h2>
							<div class="desc"><?php echo wp_kses_post($excerpt); ?></div>
						</div>
					</a></div>
				</div>
				<?php
			}
			?>
		</div>
		<?php tka_pagination(); ?>
	</div>
</div>
<?php
get_footer();
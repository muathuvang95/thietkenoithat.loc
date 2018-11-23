<?php
/*
 * archive template
 */
get_header();

?>
<div id="main" class="wrapper">
	<div class="container content-area">
		<?php
		while (have_posts()) {
			the_post();

			get_template_part('partials/content');
		}
		?>
		<?php tka_pagination(); ?>
	</div>
</div>
<?php
get_footer();
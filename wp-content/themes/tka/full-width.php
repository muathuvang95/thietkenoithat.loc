<?php
/*
 * Template Name: Full width
 */
get_header();

?>
<div id="main" class="wrapper">
	<div class="content-area">
		<?php
		while (have_posts()) {
			the_post();
			get_template_part('partials/content', 'page');

			comments_template();
		}
		?>
	</div>
</div>
<?php
get_footer();
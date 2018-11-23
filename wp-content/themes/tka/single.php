<?php

get_header();

?>
<div id="main" class="wrapper">
	<div class="container content-area">
		<?php
		while (have_posts()) {
			the_post();
			get_template_part('partials/content', 'single');
			
			comments_template();

			tka_posts_related();
		}
		?>
	</div>
</div>
<?php
get_footer();
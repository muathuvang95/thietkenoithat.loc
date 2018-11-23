<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="row">
		<div class="hidden-xs col-sm-4 col-md-2"><a class="post-thumbnail" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium', array('alt'=>esc_attr(get_the_title()))); ?></a></div>
		<div class="col-sm-8 col-md-10"><h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<table class="post-date">
			<tr>
				<td><i class="fa fa-calendar"></i> <?php the_time('d/m/Y'); ?></td>
				<td><i class="fa fa-folder-o"></i> <?php the_category(', '); ?></td>
			</tr>
		</table>
		<div class="post-excerpt"><?php the_excerpt(); ?></div></div>
	</div>
</article>
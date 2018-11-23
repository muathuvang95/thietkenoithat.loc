<?php if(comments_open()): ?>
<div class="entry-footer">
	<div class="social-plugin">
		<div class="fb-like" data-href="<?php the_permalink(); ?>" data-layout="standard" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
		<div class="fb-comments" data-href="<?php the_permalink(); ?>" data-width="100%" data-numposts="5"></div>
	</div>
</div>
<?php endif; ?>
<?php
/*
 * single portfolio template
 */
get_header();
?>
<div id="main" class="wrapper">
	<div class="container content-area">
		<div class="row">
		<?php
		while (have_posts()) {
			the_post();
			$post_id = get_the_ID();
			$excerpt = fw_get_db_post_option($post_id, '_excerpt');
			?>
			<div class="col-sm-8 entry-content">
				<?php the_content(); ?>
				<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
				    <div class="slides"></div>
				    <h3 class="title"></h3>
				    <a class="prev">‹</a>
				    <a class="next">›</a>
				    <a class="close">×</a>
				    <a class="play-pause"></a>
				    <ol class="indicator"></ol>
				</div>
			</div>
			<div class="col-sm-4 entry-meta">
				<div id="sidebar-affix">
					<div class="heading">Thông tin dự án</div>
					<div class="tbl-info">
						<?php echo wp_kses_post($excerpt); ?>
					</div>
				</div>
			</div>
			<?php
		}
		?>
		</div>
		<?php comments_template(); ?>
		<?php fw_portfolio_related(); ?>
	</div>
</div>
<?php
get_footer();
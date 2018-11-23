<?php
/**
 * The template for displaying the footer
 *
 */
?>
<footer id="footer">
	<div class="container">
		<div class="row">
			<div class="col-sm-6 footer-left">
				<div class="footer-left-inner"><?php dynamic_sidebar('footer-left'); ?></div>
			</div>
			<div class="col-sm-6 footer-left">
				<div class="footer-right-inner"><?php dynamic_sidebar('footer-right'); ?></div>
			</div>
		</div>
	</div>
</footer>
<a id="back-top" href="#"><i class="fa fa-chevron-up" aria-hidden="true"></i></a>
<?php wp_footer(); ?>
</body>
</html>

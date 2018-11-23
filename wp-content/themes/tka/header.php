<?php
/**
 * The template for displaying the header
 *
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<header id="header">
		<nav class="navbar navbar-fixed-top" role="navigation">
		  <div class="container">
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-main">
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		      <?php
		     	the_custom_logo();
		      ?>
		    </div>

		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="navbar-collapse-main">
		    <?php
		    	wp_nav_menu(array(
		    		'theme_location' => 'main',
		    		'container' => false,
		    		'menu_class' => 'nav navbar-nav',
		    		'depth' => 2,
		    		'walker' => new WP_Bootstrap_Navwalker()
		    	));
		    ?>
		      <form class="navbar-form navbar-right" role="search" action="<?php echo home_url('/'); ?>">
		        <div class="form-group">
		          <input type="text" name="s" class="form-control">
		        </div>
		        <button type="submit"><i class="fa fa-circle-o" aria-hidden="true"></i></button>
		      </form>
		    </div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav>
	</header>
	<?php 
	if((is_home() || is_front_page()) && is_page_template('homepage.php')) { // home page
		$slider = fw_get_db_settings_option('slider');
		echo '<div id="home-header">';
		masterslider($slider);
		tka_home_heading();
		echo '</div>';
	} else {
		tka_heading();
	}
	?>
<?php
/**
 * Template part for displaying main navigation.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package kite
 */

?>

<nav id="site-navigation" class="main-navigation">
	<?php kite_close_button( true ); ?>
	<div class="nav-spacer">
	<?php
		wp_nav_menu(
			array(
				'theme_location' => 'menu-1',
				'menu_id'        => 'primary-menu',
				'depth'		 	 => 2
			)
		);
	?>
	<div>
</nav><!-- #site-navigation -->
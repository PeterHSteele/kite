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
	<button class="nav-close">
		<span class="screen-reader-text"><?php esc_html_e( 'close', 'kite' ); ?></span>
		<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/kite-nav-close2.svg' ) ?>" aria-hidden>
	</button>
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
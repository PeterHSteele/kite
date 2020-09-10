<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package kite
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'kite' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="site-branding">
			<?php
			if ( has_custom_logo() ):
				the_custom_logo();
			/*else :
			?>
				<h2><a class="custom-logo-fallback" href="<?php echo esc_url(home_url('/')) ?>"><?php bloginfo('name'); ?></a></h2>
			<?php*/
			endif;
			if ( is_front_page() && is_home() ) :
				?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
			else :
				?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
			endif;
			$kite_description = get_bloginfo( 'description', 'display' );
			if ( $kite_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $kite_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
			<?php endif; ?>
		</div><!-- .site-branding -->

		<div class="header-controls">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'kite' ); ?></button>
			<button class="search-toggle" aria-controls="search-form" aria-expanded="false"><?php esc_html_e( 'Search', 'kite' ); ?></button>
		</div>

		<?php 
		get_template_part( 'template-parts/navigation', 'top' ); 
		get_search_form();
		?>
	</header><!-- #masthead -->

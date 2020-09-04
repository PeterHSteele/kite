<?php
/**
 * Template Name: Featured
 *
 * Page template for featured content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package kite
 */

get_header();
?>

	<main id="primary" class="site-main">

		<div id="hero" style="background-image: url(<?php kite_post_thumbnail_background(); ?>)" class="featured-hero">
			<div style="background-image: url(<?php echo esc_url(get_template_directory_uri() . '/assets/kite-sploof4.svg') ?>);" class="hero-content">
				<?php do_action( 'kite-hero-card' ); ?>
				<!-- wp:template-part {"slug":"hero-card","theme":"kite"} /-->
			</div>
		</div>
		
		<div id="cards" class="featured-cards">
			<?php do_action( 'kite_featured_cards' ); ?>
		</div>
		<div id="parallax-container" class="kite-parallax-container">
			<?php do_action( 'kite_parallax_image' ); ?>
		</div>

		<div id="blockquote-section" class="kite-blockquote-section">
			<?php do_action( 'kite_blockquote_section' ); ?>
		</div>
		
		<?php do_action( 'kite_picture_nav' ); ?>

		<div class="bubble-panel">
			<?php do_action( 'kite_bubble_panel' ); ?>
		</div>

	</main><!-- #main -->

<?php
get_footer();
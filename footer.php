<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package kite
 */

?>

	<footer id="colophon" class="<?php do_action('kite_footer_class')?>">
		<div class="footer-row">
			<?php kite_social_menu(); ?>
			<?php do_action( 'kite_copyright' ); ?>
		</div>	
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

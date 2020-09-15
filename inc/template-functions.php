<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package kite
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function kite_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'kite_body_classes' );

function kite_post_class( $classes ){
 	return $classes;
}

add_filter( 'post_class', 'kite_post_class' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function kite_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'kite_pingback_header' );

function kite_hero_card(){
	$title = get_theme_mod( 'kite-hero-card-title', '' );
	$text = get_theme_mod( 'kite-hero-card-body', '' );
	$cta_text = get_theme_mod( 'kite-hero-card-cta', '' );
	$cta_link = get_theme_mod( 'kite-hero-card-cta-link', '' );
	?>
	<div class="hero-card">
		<h2><?php echo esc_html($title) ?></h2>
		<?php 
		echo apply_filters( 'the_content', $text);
		printf( 
			'<a href="%1$s" class="kite-cta"><span class="kite-cta-text">%2$s</span></a>',
			esc_url( $cta_link ),
			esc_html( $cta_text )
		);
		?>

	</div>
	<?php
}

add_action( 'kite-hero-card', 'kite_hero_card' );

function kite_featured_cards(){
	for ( $count = 1; $count < 4; $count++){
		$title = get_theme_mod( 'kite-featured-card-' . $count . '-title', '' );
		$text  = get_theme_mod( 'kite-featured-card-' . $count . '-body', '' );
		?>
		<section class="card <?php echo 'card-'.$count ?>">
			<h2><?php echo esc_html( $title ); ?></h2>
			<p><?php echo $text;//apply_filters( 'the_content', $text ); ?></p>
		</section>
		<div class="card-spacer"></div>
		<?php
	}
}

add_action( 'kite_featured_cards', 'kite_featured_cards');

function kite_parallax_image(){
	echo wp_get_attachment_image( 
		get_theme_mod( 'kite-parallax-image' , '' ),
		'full', 
		false, 
		array(
			'class' => 'kite-parallax-image',
		)
	);
}

add_action( 'kite_parallax_image' , 'kite_parallax_image' );

function kite_picture_nav(){
	if ( ! has_nav_menu( 'menu-2' ) ){
		return;
	}
	/*$locations = get_nav_menu_locations();
	if (! has_nav_menu( 'menu-2') ){
		return;
	}
	$menu = get_term($locations['menu-2'], 'nav_menu');
	$menu_items = wp_get_nav_menu_items( $menu );
	$urls = array();
	foreach ( $menu_items as $menu_item ){
		$linked_page = $menu_item->object_id;
		$featured_img_url = get_the_post_thumbnail_url( $linked_page, 'full' );
		if ( $featured_img_url ){
			$urls[$linked_page] = $featured_img_url;
		}
	}
	//var_dump($urls);
	$json_urls = json_encode( $urls );  
	
	*/?>
	<div id="picture-nav" class="picture-nav-section" style="background-image: url(<?php// echo esc_url( $urls ) ?>)">
		<div class="picture-nav-mask"></div> 
			<nav class="kite-picture-nav">
			<h2><span class="nav-title-wrap"><?php echo esc_html( wp_get_nav_menu_name( 'menu-2' ) )?></span></h2>
			<?php
				wp_nav_menu( 
					array(
						'theme_location' => 'menu-2',
						'depth' => 1,
						'fallback_cb' => false,
						'menu_class' => 'picture-nav',
					)
				);
			?>
			</nav>
	</div> 
	<?php
}

add_action( 'kite_picture_nav', 'kite_picture_nav' );

function kite_picture_nav_add_images( $atts, $item, $args ){
	if ( $args->theme_location === 'menu-2' ){
		$featured_img_id = get_post_thumbnail_id( $item->object_id );
		$image_attrs =  wp_get_attachment_image_src( $featured_img_id, 'full' );
		$atts['data-source'] = $image_attrs[0];
	}

	return $atts;
}

add_filter( 'nav_menu_link_attributes', 'kite_picture_nav_add_images', 10, 3 );

function kite_blockquote(){
	$quote = get_theme_mod( 'kite-blockquote-text', '' );
	if ( $quote ):
	?>
	<blockquote>
		<span class="opening-quote">&ldquo;</span>
		<p><?php echo apply_filters( 'the_content', $quote ) ?></p>
		<cite><?php echo esc_html( get_theme_mod( 'kite-blockquote-source', '') ); ?></cite>
		<div class="bars">
			<div class="bar bar-1"></div>
			<div class="bar bar-2"></div>
			<div class="bar bar-3"></div>
		</div>
	</blockquote>
	<?php
	endif;
}

add_action( 'kite_blockquote_section', 'kite_blockquote' );

function kite_bubble_section(){
	$text = get_theme_mod( 'kite-bubble-text', '' );
	if ( $text ) :
	kite_bubble( 1, 80, 100, -1);
	kite_bubble( 2, 60, 50, -3);
	kite_bubble( 3, 80, 70, -2.5);
	kite_bubble( 4, 90, 80, -.5);
	kite_bubble( 5, 60, 70, -3.5);
	?>
	<div class="text-panel">
		<!--<p><?php echo apply_filters( 'the_content', $text ); ?></p>-->
		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>
	</div>
	<?php
	endif;
}

add_action( 'kite_bubble_panel', 'kite_bubble_section' );

function kite_copyright(){
	$show = get_theme_mod( 'kite_copyright_visible', false );
	if ( ! $show ){
		return '';
	}

	$year = get_theme_mod( 'kite_copyright_year', date( 'Y' ) );
	?>
	<div class="content-block">
		<span class="copyright">
		<?php
		printf( 
			'&copy; %1$s %2$s',
			esc_html( $year ),
			esc_html( get_bloginfo( 'name') )
		);
		?>
		</span>
	</div>
	<?php
}

add_action( 'kite_copyright', 'kite_copyright' );

function kite_jetpack_menu(){
	kite_social_menu();
}

add_action( 'kite_jetpack_menu', 'kite_jetpack_menu' );

function kite_search_form( $html ){
	$before_close = explode( '</form>', $html );
	$before_close[0] .= kite_close_button( false ) . '</form>';
	return implode( '', $before_close );
}

add_action( 'get_search_form', 'kite_search_form', 1000, 1 );

function kite_footer_class(){
	$class = 'site-footer';
	if ( !is_singular() && !is_paged() ){
		$class .= ' plus-margin-top';
	}
	echo $class;
}

add_action( 'kite_footer_class', 'kite_footer_class' );
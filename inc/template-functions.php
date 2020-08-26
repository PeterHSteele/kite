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
	?>
	<div class="hero-card">
		<h2><?php echo esc_html($title) ?></h2>
		<p><?php echo esc_html($text) ?></p>
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
	$locations = get_nav_menu_locations();
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
	$menu_html = wp_nav_menu( 
		array(
			'theme_location' => 'menu-2',
			'depth' => 1,
			'fallback_cb' => false,
			'menu_class' => 'picture-nav',
			'echo' => false
		)
	); 


	
	?>
	<div id="picture-nav" class="picture-nav-section" style="background-image: url(<?php// echo esc_url( $urls ) ?>)">
		<nav class="kite-picture-nav" data-sources=<?php echo $json_urls ?>>
		<?php
			echo $menu_html;
		?>
		</nav>
	</div> 
	<?php
}

add_action( 'kite_picture_nav', 'kite_picture_nav' );
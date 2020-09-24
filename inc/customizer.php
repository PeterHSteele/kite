<?php
/**
 * kite Theme Customizer
 *
 * @package kite
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function kite_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'kite_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'kite_customize_partial_blogdescription',
			)
		);
	}



	//featured.php
	$wp_customize->add_section( 'kite-featured', array(
		'title' => 'Kite Featured Page',
	));

	$wp_customize->add_setting( 'kite-hero-card-title', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control( 'kite-hero-card-title', array(
		'type' => 'text',
		'label' => __( 'Hero Section Title', 'kite' ),
		'section' => 'kite-featured'
	));

	$wp_customize->add_setting( 'kite-hero-card-body', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_textarea_field',
	));

	$wp_customize->add_control( 'kite-hero-card-body', array(
		'type' => 'textarea',
		'maxlength' => 150,
		'label' => __( 'Hero Section Text', 'kite' ),
		'section' => 'kite-featured'
	));

	$wp_customize->add_setting( 'kite-hero-card-cta', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control( 'kite-hero-card-cta', array(
		'type' => 'text',
		'label' => __( 'Hero Section Call to Action Text', 'kite' ),
		'section' => 'kite-featured'
	));

	$wp_customize->add_setting( 'kite-hero-card-cta-link', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control( 'kite-hero-card-cta-link', array(
		'type' => 'text',
		'label' => __( 'Hero Section Call To Action Link', 'kite' ),
		'section' => 'kite-featured'
	));

	//Cards

	$wp_customize->add_setting( 'kite-featured-card-1-title', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control( 'kite-featured-card-1-title', array(
		'type' => 'text',
		'section' => 'kite-featured',
		'label' => __( 'Card 1 Title', 'kite' )
	));

	$wp_customize->add_setting( 'kite-featured-card-1-body', array(
		'default' => '',
		//'sanitize_callback' => 'sanitize_textarea_field',
		'sanitize_callback' => 'kite_sanitize_textarea_field',
	));

	$wp_customize->add_control( 'kite-featured-card-1-body', array(
		'type' => 'textarea',
		'section' => 'kite-featured',
		'label' => __( 'Card 1 Text', 'kite' )
	));

	$wp_customize->add_setting( 'kite-featured-card-2-title', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control( 'kite-featured-card-2-title', array(
		'type' => 'text',
		'section' => 'kite-featured',
		'label' => __( 'Card 2 Title', 'kite' )
	));

	$wp_customize->add_setting( 'kite-featured-card-2-body', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_textarea_field',
	));

	$wp_customize->add_control( 'kite-featured-card-2-body', array(
		'type' => 'textarea',
		'section' => 'kite-featured',
		'label' => __( 'Card 2 Text', 'kite' )
	));

	$wp_customize->add_setting( 'kite-featured-card-3-title', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control( 'kite-featured-card-3-title', array(
		'type' => 'text',
		'section' => 'kite-featured',
		'label' => __( 'Card 3 Title', 'kite' )
	));

	$wp_customize->add_setting( 'kite-featured-card-3-body', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_textarea_field',
	));

	$wp_customize->add_control( 'kite-featured-card-3-body', array(
		'type' => 'textarea',
		'section' => 'kite-featured',
		'label' => __( 'Card 3 Text', 'kite' )
	));

	//Parallax Image
	$wp_customize->add_setting( 'kite-parallax-image', array(
		'default' => '',
		'sanitize_callback' => 'absint',
	));

	$wp_customize->add_control( 'kite-parallax-image', array(
		'type' => 'select',
		'choices' => kite_parallax_image_choices(),
		'label' => __( 'Image for parallax section', 'kite' ),
		'section' => 'kite-featured',
	));

	//blockquote section
	$wp_customize->add_setting( 'kite-blockquote-text', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_textarea_field'
	));

	$wp_customize->add_control( 'kite-blockquote-text', array(
		'type' => 'textarea',
		'label' => __( 'Featured Quote Text', 'kite' ),
		'section' => 'kite-featured'
	));

	$wp_customize->add_setting( 'kite-blockquote-source', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control( 'kite-blockquote-source', array(
		'type' => 'text',
		'label' => 'Featured Quote Source',
		'section' => 'kite-featured'
	));	

	//bubble panel
	$wp_customize->add_setting( 'kite-bubble-text', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_textarea_field'
	));

	$wp_customize->add_control( 'kite-bubble-text', array(
		'type' => 'textarea',
		'label' => __( '"Bubble" Panel Text', 'kite' ),
		'section' => 'kite-featured'
	));

	//Copyright
	$wp_customize->add_setting( 'kite_copyright_visible', array(
		'default' => false,
		'sanitize_callback' => 'kite_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'kite_copyright_visible', array(
		'label' => __( 'Show Copyright', 'kite' ),
		'type'  => 'checkbox',
		'section' => 'title_tagline',
		'priority' => 100
	));

	$wp_customize->add_setting( 'kite_copyright_year', array(
		'default' => date('o'),
		'sanitize_callback' => 'kite_sanitize_year'
	) );

	$wp_customize->add_control( 'kite_copyright_year', array(
		'label' => __( 'Copyright Year', 'kite' ),
		'type'  => 'number',
		'section' => 'title_tagline',
		'priority' => 105
	));

}
add_action( 'customize_register', 'kite_customize_register' );

function kite_parallax_image_choices(){
	$attachments = get_posts(array(
		'numberposts' => -1,
		'post_type' => 'attachment',
	));
	$choices = [];
	foreach( $attachments as $post ){
		$choices[$post->ID] = $post->post_title; 
	}
	
	return $choices;
}

/**
* Sanitize the copyright year by converting to a number
* and accepting up to four digits.
*/

function kite_sanitize_year( $year ){
	return absint( substr( $year, 0, 4) );
}

/**
* Sanitize a checkbox value by allowing only 0 or 1 to be saved
*/

function kite_sanitize_checkbox( $input ){
    return intval( $input ) > 0 ? 1 : 0;
}

/**
* Sanitize a textarea field
*/

function kite_sanitize_textarea_field( $text ){
	return wp_kses(
		$text,
		array(
			'a' => array(
				'class' => array(),
				'href' => array()
			),
			'img' => array(
				'class' => array(),
				'alt' => array(),
				'src' => array(),
				'srcset' => array(),
				'height' => array(),
				'width' => array(),
				'style' => array()
			)
		)
	);
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function kite_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function kite_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function kite_customize_preview_js() {
	wp_enqueue_script( 'kite-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'kite_customize_preview_js' );

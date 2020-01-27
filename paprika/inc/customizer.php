<?php
/*
 * Paprika Customizer functions
 *
 */

/*== Body ==*/
function paprika_bodybg( $wp_customize ) {
	$wp_customize->add_setting('paprika_bbg', array(
		'default' => false,
		'transport' => 'postMessage',
		'sanitize_callback' => 'esc_url_raw'
	));
    
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'paprika_bbg', array(
        'label' => __( 'Site Background', 'paprika' ),
        'section'   => 'title_tagline'
    ) ));
}
add_action('customize_register','paprika_bodybg');


/*==== Header ====*/

/*== Top Contact ==*/
function paprika_top_contact( $wp_customize ) {
	$wp_customize->add_section( 'paprika_header', array(
		'title' => __( 'Header', 'paprika' )
	));
	
	$wp_customize->add_setting( 'paprika_top_contact', array(
		'default' => '1',
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control( 'paprika_top_contact', array(
		'type' => 'checkbox',
  		'section' => 'paprika_header',
  		'label' => __( 'Top Contact', 'paprika' ),
  		'description' => __( 'Adds contact info and socials section.', 'paprika' )
	));
	$wp_customize->selective_refresh->add_partial( 'paprika_top_contact', array(
        'selector' => '#top-contact-container',
        'render_callback' => function() {
            				 	require get_theme_file_path() . '/template-parts/header/top-contact.php';
        					 }
    ));
	
	$wp_customize->add_setting( 'paprika_tc_phone', array(
		'default' => false,
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control( 'paprika_tc_phone', array(
		'type' => 'text',
  		'section' => 'paprika_header',
  		'label' => __( 'Phone Number', 'paprika' ),
  		'description' => __( 'Adds your phone number.', 'paprika' ),
		'input_attrs' => array(
    		'placeholder' => __( 'All formats are valid.', 'paprika' )
  		)
	));
	
	$wp_customize->add_setting( 'paprika_tc_email', array(
		'default' => false,
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_email',
		'validate_callback' => 'validate_email'
	));
	$wp_customize->add_control( 'paprika_tc_email', array(
		'type' => 'text',
  		'section' => 'paprika_header',
  		'label' => __( 'E-mail' ),
  		'description' => __( 'Adds your E-mail.', 'paprika' ),
		'input_attrs' => array(
    		'placeholder' => __( 'info@company.com', 'paprika' )
  		)
	));
	
	$wp_customize->add_setting( 'paprika_ts_facebook', array(
		'default' => false,
		'transport' => 'postMessage',
		'sanitize_callback' => 'esc_url_raw'
	));
	$wp_customize->add_control( 'paprika_ts_facebook', array(
		'type' => 'text',
  		'section' => 'paprika_header',
  		'label' => __( 'Facebook', 'paprika' ),
  		'description' => __( 'Adds your Facebook link.', 'paprika' )
	));
	
	$wp_customize->add_setting( 'paprika_ts_twitter', array(
		'default' => false,
		'transport' => 'postMessage',
		'sanitize_callback' => 'esc_url_raw'
	));
	$wp_customize->add_control( 'paprika_ts_twitter', array(
		'type' => 'text',
  		'section' => 'paprika_header',
  		'label' => __( 'Twitter', 'paprika' ),
  		'description' => __( 'Adds your Twitter link.', 'paprika' )
	));
	
	$wp_customize->add_setting( 'paprika_ts_linkedin', array(
		'default' => false,
		'transport' => 'postMessage',
		'sanitize_callback' => 'esc_url_raw'
	));
	$wp_customize->add_control( 'paprika_ts_linkedin', array(
		'type' => 'text',
  		'section' => 'paprika_header',
  		'label' => __( 'Linkedin', 'paprika' ),
  		'description' => __( 'Adds your Linkedin link.', 'paprika' )
	));
	
	$wp_customize->add_setting( 'paprika_ts_youtube', array(
		'default' => false,
		'transport' => 'postMessage',
		'sanitize_callback' => 'esc_url_raw'
	));
	$wp_customize->add_control( 'paprika_ts_youtube', array(
		'type' => 'text',
  		'section' => 'paprika_header',
  		'label' => __( 'Youtube', 'paprika' ),
  		'description' => __( 'Adds your Youtube link.', 'paprika' )
	));
	
	$wp_customize->add_setting( 'paprika_ts_vimeo', array(
		'default' => false,
		'transport' => 'postMessage',
		'sanitize_callback' => 'esc_url_raw'
	));
	$wp_customize->add_control( 'paprika_ts_vimeo', array(
		'type' => 'text',
  		'section' => 'paprika_header',
  		'label' => __( 'Vimeo', 'paprika' ),
  		'description' => __( 'Adds your Vimeo link.', 'paprika' )
	));
}
add_action('customize_register','paprika_top_contact');

/*== Sanitization and Validation functions ==*/
function validate_email( $validity, $value ) {
    if( ! sanitize_email($value)){
		$validity -> add( 'required', __('allowed format - "info@company.com"','paprika'));
    	return $validity;
	}
}

/*== Logo ==*/
function paprika_top_logo( $wp_customize ) {
	$wp_customize->add_setting('paprika_tlogo', array(
		'default' => false,
		'sanitize_callback' => 'esc_url_raw'
	));
    
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'paprika_tlogo', array(
        'label' => __( 'Logo', 'paprika' ),
        'section'   => 'title_tagline',
		'priority' => '1'
    ) ));
	$wp_customize->selective_refresh->add_partial( 'paprika_tlogo', array(
        'selector' => '#logo-container',
        'render_callback' => function() {
            require get_theme_file_path() . '/template-parts/header/site-branding.php';
        },
    ));
}
add_action('customize_register','paprika_top_logo');


/*==== AJAX loader ====*/
function paprika_ajax( $wp_customize ) {
	$wp_customize->add_section( 'paprika_ajax', array(
		'title' => __( 'AJAX', 'paprika' )
	));
	
	$wp_customize->add_setting( 'paprika_ajax_loader', array(
		'default' => 1,
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control( 'paprika_ajax_loader', array(
		'type' => 'checkbox',
  		'section' => 'paprika_ajax',
  		'label' => __( 'AJAX Posts', 'paprika' ),
  		'description' => __( 'Posts are loaded automatically when user reaches the last post of the page.', 'paprika' ),
		'active_callback' => function(){
							 	if(is_home() || is_archive() || is_search()){
									return true;
								}
							 }
	));
}
add_action('customize_register','paprika_ajax');


/*==== footer ====*/

function paprika_footer( $wp_customize ) {
	$wp_customize->add_section( 'paprika_footer', array(
		'title' => __( 'Footer', 'paprika' )
	));
	$wp_customize->add_setting('paprika_footer_checkbox', array(
		'default' => '1',
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field'
	));
    $wp_customize->add_control( 'paprika_footer_checkbox', array(
		'type' => 'checkbox',
  		'section' => 'paprika_footer',
  		'label' => __( 'Footer', 'paprika' ),
  		'description' => __( 'Display Footer.', 'paprika' )
	));
	$wp_customize->add_setting('paprika_footer_text', array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field'
	));
    $wp_customize->add_control( 'paprika_footer_text', array(
		'type' => 'textarea',
  		'section' => 'paprika_footer',
  		'label' => __( 'Footer Text', 'paprika' ),
  		'description' => __( 'Adds your Footer text.', 'paprika' )
	));
}
add_action('customize_register','paprika_footer');



















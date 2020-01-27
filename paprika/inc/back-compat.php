<?php
/*
 * Paprika back compatibility functionality
 *
 * Prevents Paprika from running on WordPress versions prior to 4.9,
 * since this theme is not meant to be backward compatible beyond that and
 * relies on many newer functions and markup changes introduced in 4.9.
 */

/**
 * Prevent switching to Paprika on old versions of WordPress.
 *
 * Switches to the default theme.
 */
function paprika_switch_theme() {
	switch_theme( WP_DEFAULT_THEME );
	unset( $_GET['activated'] );
	add_action( 'admin_notices', 'paprika_upgrade_notice' );
}
add_action( 'after_switch_theme', 'paprika_switch_theme' );

/**
 * Adds a message for unsuccessful theme switch.
 *
 * Prints an update message after an unsuccessful attempt to switch to
 * Paprika on WordPress versions prior to 4.9.
 *
 * @global string $wp_version WordPress version.
 */
function paprika_upgrade_notice() {
	$message = sprintf( __( 'Paprika requires at least WordPress version 4.9. You are running version %s. Please upgrade and try again.', 'paprika' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Prevents the Customizer from being loaded on WordPress versions prior to 4.9.
 *
 * @global string $wp_version WordPress version.
 */
function paprika_customize() {
	wp_die( sprintf( __( 'Paprika requires at least WordPress version 4.9. You are running version %s. Please upgrade and try again.', 'paprika' ), $GLOBALS['wp_version'] ), '', array(
		'back_link' => true,
	) );
}
add_action( 'load-customize.php', 'paprika_customize' );

/**
 * Prevents the Theme Preview from being loaded on WordPress versions prior to 4.9.
 *
 * @global string $wp_version WordPress version.
 */
function paprika_preview() {
	if ( isset( $_GET['preview'] ) ) {
		wp_die( sprintf( __( 'Paprika requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'paprika' ), $GLOBALS['wp_version'] ) );
	}
}
add_action( 'template_redirect', 'paprika_preview' );
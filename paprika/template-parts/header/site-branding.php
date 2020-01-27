<?php
/*
 * Paprika Site Main Logo
 */
?>
<div id="logo-container">
<?php
if ( get_theme_mod('paprika_tlogo') != "" ) {
	echo '<a id="main-logo" href="'.get_site_url().'"><img src="' . esc_url( get_theme_mod( 'paprika_tlogo' ) ) . '" alt="' . get_bloginfo( 'name' ) . '"></a>';
} else {
	echo '<div id="main-logo"><a href="'.get_site_url().'">'. get_bloginfo( 'name' ) .'</a></div>';
}
?>
</div>
<?php if( !empty( get_bloginfo( 'description' ) ) ): ?>
<div id="site-tagline">
	<h3><?php echo get_bloginfo( 'description' ); ?></h3>
</div>
<?php endif; ?>
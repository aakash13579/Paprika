<?php
/*
 * Template for displaying search forms in Paprika
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="search-form">
		<span class="screen-reader-text"><?php echo _x( 'Search for:', 'label', 'paprika' ); ?></span>
	</label>
	<input type="search" id="search-form" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'paprika' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	<button type="submit" class="search-submit"><span class="paprika-icon paprika-search"></span><span class="screen-reader-text"><?php echo _x( 'Search', 'submit button', 'paprika' ); ?></span></button>
</form>
<?php

// Paprika only works in WordPress 4.9 or later.
if ( version_compare( $GLOBALS['wp_version'], '4.9', '<' ) ) {
    require get_theme_file_path() . '/inc/back-compat.php';
	return;
}

if ( ! function_exists( 'paprika_setup' ) ){
	
	// Sets up theme defaults and registers support for various WordPress features.
	function paprika_setup() {
		
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 */
		load_theme_textdomain( 'paprika', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );
	
		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );

		add_image_size( 'paprika_featured_image', 673, 449, true );
		
		add_image_size( 'paprika_post_image_featured', 673, 350, true );
		
		add_image_size( 'paprika_post_standard_featured', 300, 200, true );
		
		add_image_size( 'paprika_featured_image_mob', 546, 364, true );

		add_image_size( 'paprika_thumbnail_avatar', 100, 100, true );

		// This theme uses wp_nav_menu() in one locations.
		register_nav_menus( array(
			'top_menu'    => __( 'Top Menu', 'paprika' ),
		) );
	
		/*
		 * Switch default core markup for caption, comment-form, comment-list, gallery and search-form
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'caption',
			'comment-form',
			'comment-list',
			'gallery',
			'search-form',
		) );
		
		//Enable support for Post Formats.
		add_theme_support( 'post-formats', array(
			'image',
			'video',
			'audio'
		) );
		
		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );
		
	} // closing theme setup function
} //closing theme setup 'if' statement
add_action( 'after_setup_theme', 'paprika_setup' );

/*
 * Register widget area.
 */
function paprika_widgets_init() {

	register_sidebar(
		array(
			'name'          => __( 'Main Sidebar', 'paprika' ),
			'id'            => 'main_sidebar',
			'description'   => __( 'Add widgets here to appear in your footer.', 'paprika' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'paprika_widgets_init' );

/*
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function paprika_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
	}
}
add_action( 'wp_head', 'paprika_pingback_header' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function paprika_body_classes( $classes ) {
	// Add class if we're viewing the Customizer for easier styling of theme options.
	if ( is_customize_preview() ) {
		$classes[] .= 'paprika-customizer';
	}
	
	// Add class if sidebar is used.
	if ( is_active_sidebar( 'sidebar-1' ) && ! is_page() ) {
		$classes[] .= 'has-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'paprika_body_classes' );

/*
 * Enqueue scripts and styles.
 */
function paprika_scripts() {
	wp_enqueue_style( 'paprika_style', get_stylesheet_uri(), array(), '1.0.0' );
	wp_enqueue_style( 'paprika_responsive_style', get_theme_file_uri( '/assets/css/min-responsive.css' ), array(), '1.0.0' );
	wp_enqueue_style( 'paprika_font', get_theme_file_uri( '/assets/fonts/paprika-icon/style.css' ), array(), '1.0.0' );
	
	wp_enqueue_script( 'paprika_script', get_theme_file_uri( '/assets/js/min-main.js' ), array('jquery'), '1.0.0', true );
	
	if ( has_nav_menu( 'top_menu' ) ) {
		wp_enqueue_style( 'paprika_top_menu_style', get_theme_file_uri( '/assets/css/min-top-menu.css' ), array(), '1.0.0' );
		wp_enqueue_script( 'paprika_top_menu_script', get_theme_file_uri( '/assets/js/min-top-menu.js' ), array('jquery'), '1.0.0', true );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'paprika_scripts' );

/*
 * Customizer
 */
require get_theme_file_path() . '/inc/customizer.php';

function paprika_customizer_scripts(){
	wp_enqueue_script( 'paprika_customizer_script', get_theme_file_uri('/assets/js/min-customizer.js'), array( 'jquery' ), '1.0.0', true );
	wp_localize_script( 'paprika_customizer_script', 'customizerdata', array('a' => get_theme_mod('paprika_top_contact')) );
}
add_action( 'customize_controls_enqueue_scripts', 'paprika_customizer_scripts' );

/*
 *
 * Filter the except length to 20 words.
 *
 * @param int $length Excerpt length.
 *
 */
function wpdocs_custom_excerpt_length( $length ) {
    return 44;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length');

/*
 * Include Walker Class
 */
require get_theme_file_path() . '/inc/walker.php';

/*
 * filter excerpt's read more
 */
function wpdocs_excerpt_more( $more ) {
    return '... <a href="'.get_the_permalink().'" rel="nofollow">Read More</a>';
}
add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );

/*
 * Gets a nicely formatted string for the published date.
 */
if ( ! function_exists( 'paprika_published_on' ) ) :
	/**
	 * Gets a nicely formatted string for the published date.
	 */
	function paprika_published_on() {
		$time_string = '<span class="screen-reader-text">Posted on %2$s</span><time class="published" datetime="%1$s">%2$s</time>';
		return sprintf(
			$time_string,
			get_the_date( DATE_W3C ),
			get_the_date()
		);
	}
endif;

/*
 * Gets a nicely formatted post classes.
 */
function paprika_post_class(){
	$categories = get_the_category();
	$separator = ', ';
	$output = '';
	$i = 1;
	
	if( !empty($categories) ):
		foreach( $categories as $category ):
			if( $i > 1 ): $output .= $separator; endif;
			$output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( 'View all posts in '.$category->name  ) .'">' . esc_html( $category->name ) .'</a>';
			$i++; 
		endforeach;
	endif;
	
	return '<span id="vertical-line">&#124;</span><span class="posted-in">' . $output . '</span>';
}

/*
 * Gets a nicely formatted post tags.
 */
function paprika_post_tag(){
	$tags = get_the_tags();
	$separator = ' ';
	$output = '';
	$i = 1;
	
	if( !empty($tags) ):
		foreach( $tags as $tag ):
			if( $i > 1 ): $output .= $separator; endif;
			$output .= '<a href="' . esc_url( get_category_link( $tag->term_id ) ) . '" alt="' . esc_attr( 'View all posts in '.$tag->name ) .'"><span class="hashtag">#</span>' . esc_html( $tag->name ) .'</a>';
			$i++; 
		endforeach;
	endif;
	
	return '<span class="posted-in">' . $output . '</span>';
}

/*
 * Ajax call to get more post
 */

add_action( 'wp_ajax_nopriv_paprika_load_more', 'paprika_load_more' );
add_action( 'wp_ajax_paprika_load_more', 'paprika_load_more' );

function paprika_load_more() {
	
	$paged = esc_sql(sanitize_text_field($_POST["page"]))+1;
	$searchword = esc_sql(sanitize_text_field($_POST["searchword"]));
	$archmonth = esc_sql(sanitize_text_field($_POST["archmonth"]));
	$archyear = esc_sql(sanitize_text_field($_POST["archyear"]));
	$archcat = esc_sql(sanitize_text_field($_POST["archcat"]));
	$archtag = esc_sql(sanitize_text_field($_POST["archtag"]));
	
	if($searchword != ""){
		$query = new WP_Query( array(
				'post_type' => 'post',
				's' => $searchword,
        		'post_status' => 'publish',
				'paged' => $paged
			 ));
	
		if( $query->have_posts() ):		
			while( $query->have_posts() ): 
				$query->the_post();
				get_template_part( 'template-parts/post/content', get_post_format() );
			endwhile;
		endif;
	}elseif($archmonth != ""){
		$query = new WP_Query( array(
				'post_type' => 'post',
				'monthnum' => $archmonth,
				'year' => $archyear,
        		'post_status' => 'publish',
				'paged' => $paged
			 ));
		if( $query->have_posts() ):		
			while( $query->have_posts() ): 
				$query->the_post();
				get_template_part( 'template-parts/post/content', get_post_format() );
			endwhile;
		endif;
	}elseif($archcat != ""){
		$query = new WP_Query( array(
				'post_type' => 'post',
				'category_name' => $archcat,
				'post_status' => 'publish',
				'paged' => $paged
			 ));
		if( $query->have_posts() ):		
			while( $query->have_posts() ): 
				$query->the_post();
				get_template_part( 'template-parts/post/content', get_post_format() );
			endwhile;
		endif;
	}elseif($archtag != ""){
		$query = new WP_Query( array(
				'post_type' => 'post',
				'tag' => $archtag,
				'post_status' => 'publish',
				'paged' => $paged
			 ));
		if( $query->have_posts() ):		
			while( $query->have_posts() ): 
				$query->the_post();
				get_template_part( 'template-parts/post/content', get_post_format() );
			endwhile;
		endif;
	}else{
		$query = new WP_Query( array(
				'post_type' => 'post',
        		'post_status' => 'publish',
				'paged' => $paged
			 ));
	
		if( $query->have_posts() ):
			while( $query->have_posts() ): 
				$query->the_post();
				get_template_part( 'template-parts/post/content', get_post_format() );
			endwhile;
		endif;
	}
	
	wp_reset_postdata();
	
	die();
	
}

/*
 * Filter Comment form
 */
add_filter( 'comment_form_default_fields', 'paprika_comment_form_fields' );

function paprika_comment_form_fields( $fields ) {
	unset($fields['url']);
	
	$req       = get_option( 'require_name_email' );
	$commenter = wp_get_current_commenter();
	$html_req  = ( $req ? " required='required'" : '' );
	$fields['author'] = '<p class="comment-form-author">' . '<label for="author">' . __( 'Name' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' . '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" maxlength="245"' . $html_req . 'placeholder="Name" /></p>';
	$fields['email']  = '<p class="comment-form-email"><label for="email">' . __( 'Email' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' . '<input id="email" name="email" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" maxlength="100" aria-describedby="email-notes"' . $html_req . 'placeholder="Email" /></p>';

	return $fields;
}
<?php
get_header();
?>
<div id="main-content" class="flexbox-center">
	<?php if( ! is_single() ): ?>
		<header class="page-header">
			<h2 class="page-title"><?php _e( '&#126; Posts &#126;', 'paprika' ); ?></h2>
		</header>
    <?php endif; ?>
    <div id="posts-container">
    	<main id="posts-area <?php echo get_the_ID() ?>" role="main">
        	<?php if ( have_posts() ) : ?>
                <div id="entry-content">
                	<?php
						/* Start the Loop */
						while ( have_posts() ) :
							the_post();
						 	get_template_part( '/template-parts/post/content', get_post_format() );
						endwhile;
                	?>    
				</div>
				<?php if( (is_home()) && (get_theme_mod('paprika_ajax_loader',1)==1)){ ?>
            		<div id="three-dots-container" class="flexbox-center loading" data-page="1" data-url="<?php echo admin_url('admin-ajax.php'); ?>">
            			<div id="three-dots">
            				<figure></figure>
            				<figure></figure>
            				<figure></figure>
            			</div>
            		</div>
				<?php
					}else{
						the_posts_pagination(
							array(
								'prev_text'          => '<span class="paprika-icon paprika-arrow-left"></span>' . '<span class="screen-reader-text">' . __( 'Previous page', 'paprika' ) . '</span>',
								'next_text'          => '<span class="screen-reader-text">' . __( 'Next page', 'paprika' ) . '</span>' . '<span class="paprika-icon paprika-arrow-right"></span>',
								'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'paprika' ) . ' </span>',
							)
						);				
					} 
				?>
			<?php endif; ?>
        </main>
    </div>
</div>
<?php
get_footer();
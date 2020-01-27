<?php
get_header();
?>

<div id="main-content" class="flexbox-center">
	<?php if ( have_posts() ) : ?>
		<header class="page-header">
			<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="taxonomy-description">', '</div>' );
			?>
		</header><!-- .page-header -->
	<?php endif; ?>
    <div id="posts-container">
    	<main id="posts-area" role="main">
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
				<?php if( get_theme_mod('paprika_ajax_loader',1) == 1 ){ ?>
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
</div><!-- #main-content -->

<?php
get_footer();
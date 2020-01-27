<?php
get_header();
?>	
<div id="main-content" class="flexbox-center">
    <div id="post-container" class="single-post">
    	<main id="post-area" role="main">
        	<div id="entry-content">
				<?php the_post(); ?>
                	<article id="post-<?php the_ID(); ?>" <?php post_class('flexbox'); ?>>
        				<header>
        					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
        				</header>
						<?php if( has_post_thumbnail() ): ?>
                    		<div class="paprika_featured_image">
								<?php the_post_thumbnail('paprika_featured_image'); ?>
        					</div>
						<?php endif; ?>
        				<div class="post-content flexbox">
							<?php the_content(); ?>
            			</div>
					</article>
			</div>
            <?php
                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;
            ?>
        </main>
    </div>
</div>
<?php get_footer(); ?>
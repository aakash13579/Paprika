<?php

$image_mob = get_the_post_thumbnail_url(get_the_ID(),'paprika_featured_image_mob') . " 546w, ";
$image_mob = $image_mob . get_the_post_thumbnail_url(get_the_ID(),'paprika_featured_image') . " 673w";

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
                    	<div class="paprika-featured-image">
							<?php the_post_thumbnail('paprika_featured_image', array('sizes' => '(max-width:576px) 546px, 673px','srcset' => $image_mob)); ?>
        				</div>
					<?php endif; ?>
                    <div class="post-meta flexbox">
                        <div>
                            <?php
                                printf(
                                    /* translators: %s: Author name */
                                    __( 'By %s', 'paprika' ),
                                    '<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author_meta( 'display_name' ) ) . '</a>'
                                );
                            ?>
                        </div>
            			<div>
                        	<div>
                				<?php
									echo(paprika_published_on());
									echo(paprika_post_class());
								?>
                            </div>
                            <div class="tags-container">
                            	<?php
									echo(paprika_post_tag());
								?>
                            </div>
                		</div>
            		</div>
        			<div class="post-content flexbox">
						<?php the_content(); ?>
            		</div>
				</article>    
			</div>
            <?php
				the_post_navigation(
					array(
						'prev_text' => '<span class="screen-reader-text">' . __( 'Previous Post', 'paprika' ) . '</span> <span class="nav-title"><span class="nav-title-icon-wrapper">' . '<span class="paprika-icon paprika-arrow-left"></span>' . '</span>%title</span>',
						'next_text' => '<span class="screen-reader-text">' . __( 'Next Post', 'twentyseventeen' ) . '</span><span class="nav-title">%title<span class="nav-title-icon-wrapper">' . '<span class="paprika-icon paprika-arrow-right"></span>' . '</span></span>',
					)
				);
            	// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>
        </main>
    </div>
</div>
<?php
get_footer();
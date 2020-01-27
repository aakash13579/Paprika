<?php
/*
 * Template part for displaying image post-type
 */
 
 $image_mob = get_the_post_thumbnail_url(get_the_ID(),'paprika_featured_image_mob') . " 546w, ";
 $image_mob = $image_mob . get_the_post_thumbnail_url(get_the_ID(),'paprika_post_image_featured') . " 673w";
 ?>
 
 <article id="post-<?php the_ID(); ?>" <?php post_class(array('post-content-image','flexbox')); ?>>
 	<div class="post-title">
		<?php
			the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
		?>
	</div>
    <?php if( has_post_thumbnail() ): ?>	
		<div class="post-image-featured">
			<?php the_post_thumbnail('paprika_post_image_featured', array('sizes' => '(max-width:576px) 546px, 673px','srcset' => $image_mob)); ?>
        </div>
	<?php endif; ?>
    <div class="flexbox post-meta">
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
			<?php
				echo(paprika_published_on());
				echo(paprika_post_class());
			?>
        </div>
    </div>
 </article>
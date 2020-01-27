<?php
/*
 * Template part for displaying audio post-type
 */
 ?>
  
 <article id="post-<?php the_ID(); ?>" <?php post_class(array('post-content-audio','flexbox')); ?>>
 	<div class="post-title">
		<?php
			the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
		?>
	</div>
    <div class="post-content">
    	<?php
			$content = apply_filters( 'the_content', get_the_content() );
			$audio   = false;

			// Only get audio from the content if a playlist isn't present.
			if ( false === strpos( $content, 'wp-playlist-script' ) ) {
				$audio = get_media_embedded_in_content( $content, array( 'audio' ) );
			}
			if ( ! is_single() ) {

				// If not a single post, highlight the video file.
				if ( ! empty( $audio ) ) {
					foreach ( $audio as $audio_html ) {
						echo '<div class="entry-audio">';
							echo $audio_html;
						echo '</div>';
					}
				};
			};
		?>
    </div>
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
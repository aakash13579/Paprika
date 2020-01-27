<?php
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">
	
	<?php
		comment_form(array('comment_field' => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label><textarea id="comment" name="comment" rows="8" aria-required="true" placeholder="'. __('Your Comment Here &hellip;','paprika').'"></textarea></p>'));
		if ( have_comments() ) :
		?>
		<ul class="comment-list">
			<?php
				wp_list_comments(
					array(
						'avatar_size' => 50,
						'style' => 'ul',
						'short_ping'  => true,
						'reply_text'  => '<span class="paprika-icon paprika-reply"></span>',
					)
				);
			?>
		</ul>

		<?php
		the_comments_pagination(
			array(
				'prev_text' => '<span class="paprika-icon paprika-arrow-left"></span>' . '<span class="screen-reader-text">' . __( 'Previous', 'twentyseventeen' ) . '</span>',
				'next_text' => '<span class="screen-reader-text">' . __( 'Next', 'twentyseventeen' ) . '</span>' . '<span class="paprika-icon paprika-arrow-right"></span>',
			)
		);

	endif; // Check for have_comments().

	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>

		<p class="no-comments"><?php _e( 'Comments are closed.', 'twentyseventeen' ); ?></p>
		<?php
	endif;
	?>

</div>
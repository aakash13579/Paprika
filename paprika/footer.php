			</div>
            <?php if(!empty(get_theme_mod('paprika_footer_checkbox','1'))): ?>
            <div id="site-footer" class="flexbox-center">
            	<footer class="flexbox-center">
            		<?php
						if(empty(get_theme_mod('paprika_footer_text'))):
							echo ('<span>&copy; Paprika Theme 2020.</span>');
						else:
							echo get_theme_mod('paprika_footer_text');
						endif;
					?>
                </footer>
            </div>
            <?php endif; ?>
        </div>
		<?php wp_footer(); ?>
	</body>
</html>
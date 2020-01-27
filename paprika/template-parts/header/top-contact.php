<?php
/*
 * Paprika Customizer functions
 */
 ?>
<div id="top-contact" class="flexbox">
    <div id="top-contact-left" class="flexbox">
    	<div id="top-phone" <?php if(empty(get_theme_mod('paprika_tc_phone'))){echo("style=\"display:none;\"");} ?>>
        	<span class="paprika-icon paprika-phone"></span><span><i><?php echo(get_theme_mod('paprika_tc_phone')); ?></i></span>
        </div>
        <div id="top-email" <?php if(empty(get_theme_mod('paprika_tc_email'))){echo("style=\"display:none;\"");} ?>>
        	<span class="paprika-icon paprika-email"></span><span><i><?php echo(get_theme_mod('paprika_tc_email')); ?></i></span>
        </div>
    </div>
    <div id="top-contact-right" class="flexbox">
    	<a href="<?php echo(get_theme_mod('paprika_ts_facebook')); ?>" class="paprika-icon paprika-facebook" <?php if(empty(get_theme_mod('paprika_ts_facebook'))){echo("style=\"display:none;\"");} ?>></a>
        <a href="<?php echo(get_theme_mod('paprika_ts_twitter')); ?>" class="paprika-icon paprika-twitter" <?php if(empty(get_theme_mod('paprika_ts_twitter'))){echo("style=\"display:none;\"");} ?>></a>
        <a href="<?php echo(get_theme_mod('paprika_ts_linkedin')); ?>" class="paprika-icon paprika-linkedin" <?php if(empty(get_theme_mod('paprika_ts_linkedin'))){echo("style=\"display:none;\"");} ?>></a>
        <a href="<?php echo(get_theme_mod('paprika_ts_youtube')); ?>" class="paprika-icon paprika-youtube" <?php if(empty(get_theme_mod('paprika_ts_youtube'))){echo("style=\"display:none;\"");} ?>></a>
        <a href="<?php echo(get_theme_mod('paprika_ts_vimeo')); ?>" class="paprika-icon paprika-vimeo" <?php if(empty(get_theme_mod('paprika_ts_vimeo'))){echo("style=\"display:none;\"");} ?>></a>
    </div>
</div>
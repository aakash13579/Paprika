<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php wp_head(); ?>
        <style id="js-style" type="text/css">
        /*==== JS generated style ====*/
        </style>
	</head>
<body <?php body_class('flexbox'); ?> <?php if(!empty(get_theme_mod( 'paprika_bbg' ))){ echo 'style="background: url(\''.esc_url( get_theme_mod( 'paprika_bbg' ) ).'\')"';} ?>>
	<div id="site-container">
    	<div id="site-header">
            <?php if(!empty(get_theme_mod('paprika_top_contact'))){ ?>
                <div id="top-contact-container" class="flexbox">
                    <?php
                        require get_theme_file_path() . '/template-parts/header/top-contact.php';
                    ?>
                </div>
            <?php } ?>
            
            <div id="site-branding-container" class="flexbox-center">
                <div id="site-branding">	
				    <?php
					   require get_theme_file_path() . '/template-parts/header/site-branding.php';
				    ?>
                </div>
            </div>
            <?php if ( has_nav_menu('top_menu') ){ ?>
            <div id="top-menu" class="flexbox-center menu-close">
            	<div id="mob-menu-icon">
                	<span class="paprika-icon paprika-menu"></span>
                	<span class="paprika-icon paprika-close"></span>
                </div>
            	<?php
                	wp_nav_menu( array(
							'theme_location' => 'top_menu',
							'container' => false,
							'menu_id' => 'main-menu',
							'menu_class' => 'flexbox-center',
							'walker' => new Walker_Nav_Primary(),
						)
					);
				?>
            </div>
            <?php } ?>
		</div>
        	<?php if ( is_active_sidebar( 'main_sidebar' ) ) { ?>
        		<div id="main-content-container" class="active-sidebar flexbox">
                	<div id="main-sidebar">
                		<?php get_sidebar(); ?>
                	</div>
			<?php }else{ ?>
        		<div id="main-content-container" class="flexbox">
            <?php } ?>
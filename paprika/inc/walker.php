<?php
/*
 * Paprika Walker Class for "Top Menu" functionality
 *
 * Adds necessary id, classes, attributes and elements.
 */

class Walker_Nav_Primary extends Walker_Nav_Menu {
	
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		if($depth<=1){
			if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
				$t = '';
				$n = '';
			} else {
				$t = "\t";
				$n = "\n";
			}
			$indent = ( $depth ) ? str_repeat("\t",$depth) : '';
			$classes = array( 'sub-menu' );
			$class_names = join( ' ', apply_filters( 'nav_menu_submenu_css_class', $classes, $args, $depth ) );
			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
			$output .= "{$n}{$indent}<ul$class_names>{$n}";
		}else{
			$output .= '';
		}
    }

    function end_lvl(&$output, $depth=0, $args=array()) {
        if($depth<=1){
        	$output .= "</ul>\n";
        }else{
        	$output .= '';
        }
    }

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ){ //li a span
		if($depth<=2){
		$indent = ( $depth ) ? str_repeat("\t",$depth) : '';
		
		$class_names = '';
		
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		
		$class_names =  join(' ', apply_filters('nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = ' class="' . esc_attr($class_names) . '"';
		
		$id = apply_filters('nav_menu_item_id', 'menu-item-'.$item->ID, $item, $args);
		$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';
		
		$output .= $indent . '<li' . $id . $class_names .'>';
		
		$attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr($item->target) . '"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr($item->url) . '"' : '';
		$attributes .= $item->current ? 'aria-current="page"' : '' ;
		
		$item_output = $args->before;
		$item_output .= '<a' . $attributes . '>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= ( ($depth == 0 && $args->walker->has_children) || ($depth == 1 && $args->walker->has_children) ) ? ' <span class="paprika-icon paprika-caret-down"></span></a>' : '</a>';
		$item_output .= $args->after;
		
		$output .= apply_filters ( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}else{
			apply_filters ( 'walker_nav_menu_start_el', '', $item, $depth, $args );
		}
	}
}
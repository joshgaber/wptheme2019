<?php

class topnav_walker extends Walker_Nav_Menu {		
	//start of the sub menu wrap
	function start_lvl(&$output, $depth = 0, $args = array()) {
		$output .= '<div class="dropdown-menu dropdown-menu-left" role="menu">';
	}
 
	//end of the sub menu wrap
	function end_lvl(&$output, $depth = 0, $args = array()) {
		$output .= '</div>';
	}
 
	//add the description to the menu item output
	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		global $wp_query;
		
		// Set up classes for <li> or <a> element
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$a_classes = array();
		
		// If current page, disable link
		if ( in_array( 'current_page_item', $classes ) ) {
			$a_classes[] = 'disabled';
			$item->url = "#";
		}
		
		// Set up attributes for <a> element
		$a_attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$a_attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$a_attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$a_attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		
		// Top level
		if ($depth == 0) {
			$classes[] = "nav-item";
			$a_classes[] = "nav-link";
			
			// If nav item is a dropdown
			if ( in_array( "menu-item-has-children", $classes ) ) {
				$classes[] = "dropdown";
				$item->url = "#";
				$a_classes[] = "dropdown-toggle";
				$a_attributes .= ' data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"';
			}
			
			// Combine class names into strings
			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
			
			// Output <li> open tag
			$output .= '<li class="' . esc_attr( $class_names ) . '">';
			
			
		}
		
		// Second Level
		elseif ($depth == 1) {
			
			// If item is a separator (-), return separator
			if( $item->title == "-" ) {
				$output .= '<div class="dropdown-divider"></div>';
				return;
			}
			// If item is a header, return text in header wrap
			elseif ( preg_match( "/^#.*#$/", $item->title ) ) {
				$output .= '<h6 class="dropdown-header">' . trim( apply_filters( 'the_title', $item->title, $item->ID ), " \t\n\r\0\x0B#" ) . '</h6>';
				return;
			}
			
			// Merge arrays - we only need one here
			$a_classes = array_merge($classes, $a_classes);
			$a_classes[] = "dropdown-item";
		}
		
 		// pre-script <a> element
		$a_class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $a_classes ), $item, $args, $depth ) );
		
		$item_output = $args->before;
		$item_output .= '<a class="' . esc_attr($a_class_names) . '" '. $a_attributes .'>';
		$item_output .= $args->link_before . do_shortcode( apply_filters( 'the_title', $item->title, $item->ID ) ) . $args->link_after;
		$item_output .= '</a>' . $args->after;
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
	
	public function end_el( &$output, $item, $depth = 0, $args = array() ) {
		if ($depth == 0) {
			$output .= "</li>";
		}
	}
}

class action_walker extends Walker_Nav_Menu {		
	//start of the sub menu wrap
	function start_lvl(&$output, $depth = 0, $args = array()) {
		
	}
 
	//end of the sub menu wrap
	function end_lvl(&$output, $depth = 0, $args = array()) {
		
	}
 
	//add the description to the menu item output
	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		global $wp_query;
		
		// Set up classes for <li> element
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes = array_merge($classes, array('btn', 'btn-light', 'btn-lg', 'mx-1'));
		
		// Set up attributes for <a> element
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
 
 		// pre-script <a> element
		$item_output = $args->before;
		$item_output .= '<a'. $id . $attributes . $class_names . '>';
		$item_output .= $args->link_before . do_shortcode( apply_filters( 'the_title', $item->title, $item->ID ) ) . $args->link_after;
		$item_output .= '</a>' . $args->after;
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args ) . ' ';
	}
	
	public function end_el( &$output, $item, $depth = 0, $args = array() ) {
		
	}
}
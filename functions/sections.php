<?php

/**
 * Defines all nav menus and widget areas.
 *
 */

function josh2019_sections() {
	register_nav_menu( "primary_menu", "Primary Menu" );
	register_nav_menu( "primary_menu_right", "Primary Menu (Right)" );
	register_nav_menu( "action_buttons", "Action Buttons" );
	register_sidebar(array(
		'name' => "Blog Sidebar",
		'id' => "sidebar-blog",
		'before_widget' => '<div id="%1$s" class="sidebar-widget card my-3 %2$s">',
		'after_widget' => '</div></div>',
		'before_title' => '<div class="card-header h5">',
		'after_title' => '</div><div class="card-body">',
	));
	register_sidebar(array(
		'name' => "Footer",
		'id' => "footer",
		'before_widget' => '<div id="%1$s" class="footer-widget %2$s"><div class="container">',
		'after_widget' => '</div></div>',
		'before_title' => '<h5 class="text-hide">',
		'after_title' => '</h5>',
	));
}
add_action( "init", "josh2019_sections" );

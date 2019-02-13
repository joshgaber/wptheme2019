<?php

// Disable Wordpress nonsense
remove_action( 'wp_head', 'wp_resource_hints', 2 );

// Enable Post Thumbnails and Excerpts
add_theme_support( "post-thumbnails" );
add_post_type_support('page', 'excerpt');

require_once "functions/enqueue.php";
require_once "functions/sections.php";
require_once "functions/content.php";
require_once "functions/shortcodes.php";
require_once "functions/nav.php";
require_once "functions/admin_page.php";
require_once "functions/svg-fix.php";
require_once "gutenberg/gutenberg.php";

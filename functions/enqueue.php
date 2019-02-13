<?php

/**
 * Enqueues all CSS and JS files to be printed in the head.
 *
 */

function josh2019_register() {
	wp_register_style("roboto", "//fonts.googleapis.com/css?family=Roboto:300,400,500,700,300i,400i,500i,700i", NULL, "1.0");
	wp_register_style("roboto-mono", "//fonts.googleapis.com/css?family=Roboto+Mono:300,400,500,700,300i,400i,500i,700i", NULL, "1.0");
	wp_register_style("bootstrap", get_template_directory_uri() . "/styles/css/bootstrap.css", array("roboto", "roboto-mono"), "4.2.1");
	wp_register_style("custom-css", get_template_directory_uri() . "/styles/css/custom.css", array("roboto", "roboto-mono", "bootstrap"), "4.2.1");
	wp_register_style("iconic", get_template_directory_uri() . "/lib/iconic/css/open-iconic-bootstrap.min.css", array("bootstrap"), "1.1.0");
	wp_register_style("socicon", "https://s3.amazonaws.com/icomoon.io/114779/Socicon/style.css?u8vidh", null, "1.0");
	wp_register_script("bootstrap", get_template_directory_uri() . "/js/bootstrap.js", array("jquery"), "4.1.0");
	wp_register_script("scripts", get_template_directory_uri() . "/js/scripts.js", array("jquery", "bootstrap"), "1.0");
}
add_action( "init", "josh2019_register" );

function josh2019_admin_register() {
	wp_register_style('hero-meta-box', get_template_directory_uri() . '/styles/css/admin.css', array('roboto'), 'null', 'all');
	wp_register_script('admin-page-edit', get_template_directory_uri().'/js/admin-page-edit.js');
}
add_action( "admin_init", "josh2019_admin_register" );

function josh2019_load_head() {
	wp_enqueue_style("roboto");
	wp_enqueue_style("roboto-mono");
	wp_enqueue_style("bootstrap");
	wp_enqueue_style("custom-css");
	wp_enqueue_style("iconic");
	wp_enqueue_style("socicon");
	wp_enqueue_script("jquery");
	wp_enqueue_script("bootstrap");
	wp_enqueue_script("scripts");
}
add_action( "wp_enqueue_scripts", "josh2019_load_head" );

function josh2019_block_editor_styles() {
	wp_enqueue_style("gutenberg", get_template_directory_uri() . "/styles/css/gutenberg.css", NULL, "4.2.1");
}
add_action( 'enqueue_block_editor_assets', 'josh2019_block_editor_styles' );

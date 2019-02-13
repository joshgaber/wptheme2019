<?php

function theme_gutenberg_columns () {
  wp_register_script(
    'gutenberg-columns-js',
    get_template_directory_uri() . '/gutenberg/columns/columns.js',
    array( 'wp-blocks', 'wp-element', 'wp-editor' )
  );

  wp_register_style(
    'gutenberg-columns-css',
    get_template_directory_uri() . '/gutenberg/columns/columns.editor.css'
  );

  register_block_type(
    'theme-gutenberg/fixed-row', array(
      'editor_script' => 'gutenberg-columns-js',
      'editor_style' => 'gutenberg-columns-css'
    )
  );
}

add_action( 'init', 'theme_gutenberg_columns' );

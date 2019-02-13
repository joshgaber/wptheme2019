<?php

function theme_gutenberg_alert () {
  wp_register_script(
    'gutenberg-alert',
    get_template_directory_uri() . '/gutenberg/alert/alert.js',
    array( 'wp-blocks', 'wp-element', 'wp-editor' )
  );

  register_block_type(
    'theme-gutenberg/alert', array(
      'editor_script' => 'gutenberg-alert'
    )
  );
}

add_action( 'init', 'theme_gutenberg_alert' );

<?php

/** Theme Options Page */
add_action( 'admin_menu', 'josh2019_add_theme_options_page' );

function josh2019_add_theme_options_page() {
	add_theme_page( 'General Theme Options', 'Theme Options', 'edit_theme_options', 'josh2019-theme-display', 'josh2019_theme_display' );
}

function josh2019_theme_display() {

	wp_enqueue_media();

	$home_options = get_option('josh2019_home_options');

	//must check that the user has the required capability
	if (!current_user_can('manage_options'))
	{
		wp_die( 'You do not have sufficient permissions to access this page.' );
	}
	?>

<div class="wrap">
	<h2>Theme Options</h2>
	<?php settings_errors();

		$active_tab = 'home-options';
		if( isset( $_GET[ 'tab' ] ) ) {
			$active_tab = $_GET[ 'tab' ];
		}
  ?>

	<h2 class="nav-tab-wrapper">
    <a href="?page=josh2019-theme-display&tab=home-options" class="nav-tab <?php echo $active_tab == 'home-options' ? 'nav-tab-active' : ''; ?>">Home Page</a>
    <a href="?page=josh2019-theme-display&tab=global-options" class="nav-tab <?php echo $active_tab == 'global-options' ? 'nav-tab-active' : ''; ?>">Global Settings</a>
    <a href="?page=josh2019-theme-display&tab=social-options" class="nav-tab <?php echo $active_tab == 'social-options' ? 'nav-tab-active' : ''; ?>">Social Settings</a>
	</h2>

	<form method="post" action="options.php">
		<?php if( $active_tab == 'home-options' ) :

			settings_fields( 'josh2019_home_options' );
			do_settings_sections( 'josh2019_home_options' ); ?>

			<h3>Front Page Image</h3>


			<div id="hero-home-preview" class="hero">
				<div id="hero-image-preview" class="bg-image" style="<?php
	if ($home_options['hero_image']) :
				?>background-image: url(<?= $home_options['hero_image'] ?>);<?php
	endif;
	if ($home_options['hero_brightness']) :
				?>filter: brightness(<?= $home_options['hero_brightness'] ?>%);<?php
	endif;
				?>"></div>
				<div id="hero-content-preview" class="hero-content">
					<div id="hero-avatar-preview" class="hero-avatar" style="<?php
		if ($home_options['hero_avatar']) :
					?>background-image: url(<?= $home_options['hero_avatar'] ?>);<?php endif; ?>"></div>
					<div id="hero-title-area-preview" class="hero-title-area">
						<span id="hero-title-preview" class="hero-title"><?php bloginfo("name"); ?></span>
						<span id="hero-subtitle-preview" class="hero-subtitle"><?php bloginfo("description"); ?></span>
					</div>
				</div>
			</div>

		<?php elseif( $active_tab == 'social-options' ) :

			settings_fields( 'josh2019_social_options' );
			do_settings_sections( 'josh2019_social_options' );

		elseif( $active_tab == 'global-options' ) :

			settings_fields( 'josh2019_global_options' );
			do_settings_sections( 'josh2019_global_options' );

		endif;

		submit_button(); ?>
	</form>
</div>
	<?php
}

function josh2019_initialize_theme_options() {

	/*
	-------------------------
	---- GLOBAL SETTINGS ----
	-------------------------
	*/

	// If the theme options don't exist, create them.
	if( false == get_option( 'josh2019_global_options' ) ) {
		add_option( 'josh2019_global_options' );
	}

	// Register Sections
	add_settings_section(
		'nav_settings',													// ID used to identify this section and with which to register options
		'Navigation Settings',													// Title to be displayed on the administration page
		'josh2019_nav_settings_callback',	// Callback used to render the description of the section
		'josh2019_global_options'		// Page on which to add this section of options
	);

	add_settings_field(
		'nav_logo',                      // ID used to identify the field throughout the theme
		'Navigation Logo',                           // The label to the left of the option interface element
		'josh2019_nav_logo_callback',   // The name of the function responsible for rendering the option interface
		'josh2019_global_options',    // The page on which this option will be displayed
		'nav_settings'         // The name of the section to which this field belongs
	);

	// Finally, we register the fields with WordPress
	register_setting(
		'josh2019_global_options',
		'josh2019_global_options'
	);


	/*
	-------------------------
	----- HOME SETTINGS -----
	-------------------------
	*/

	// If the theme options don't exist, create them.
	if( false == get_option( 'josh2019_home_options' ) ) {
		add_option( 'josh2019_home_options' );
	}

	// Register Sections
	add_settings_section(
		'hero_settings',													// ID used to identify this section and with which to register options
		'Hero Settings',													// Title to be displayed on the administration page
		'josh2019_hero_settings_callback',	// Callback used to render the description of the section
		'josh2019_home_options'		// Page on which to add this section of options
	);

	add_settings_field(
		'hero_image',                     // ID used to identify the field throughout the theme
		'Splash Image',                   // The label to the left of the option interface element
		'josh2019_hero_image_callback',   // The name of the function responsible for rendering the option interface
		'josh2019_home_options',          // The page on which this option will be displayed
		'hero_settings'                   // The name of the section to which this field belongs
	);

	add_settings_field(
		'hero_avatar',
		'Avatar',
		'josh2019_hero_avatar_callback',
		'josh2019_home_options',
		'hero_settings'
	);

	add_settings_field(
		'hero_brightness',
		'Brightness',
		'josh2019_hero_brightness_callback',
		'josh2019_home_options',
		'hero_settings'
	);

	// Finally, we register the fields with WordPress
	register_setting(
		'josh2019_home_options',
		'josh2019_home_options'
	);


	/*
	--------------------------
	----- SOCIAL OPTIONS -----
	--------------------------
	*/

	// If the theme options don't exist, create them.
	if( false == get_option( 'josh2019_social_options' ) ) {
		add_option( 'josh2019_social_options' );
	}

	// Register Sections
	add_settings_section(
		'facebook_settings',													// ID used to identify this section and with which to register options
		'Facebook Settings',													// Title to be displayed on the administration page
		'josh2019_facebook_settings_callback',	// Callback used to render the description of the section
		'josh2019_social_options'		// Page on which to add this section of options
	);

	add_settings_field(
		'facebook_app',                      // ID used to identify the field throughout the theme
		'Facebook App ID',                           // The label to the left of the option interface element
		'josh2019_facebook_app_callback',   // The name of the function responsible for rendering the option interface
		'josh2019_social_options',    // The page on which this option will be displayed
		'facebook_settings'         // The name of the section to which this field belongs
	);

	add_settings_field(
		'facebook_version',
		'Facebook App Version',
		'josh2019_facebook_version_callback',
		'josh2019_social_options',
		'facebook_settings'
	);

	// Finally, we register the fields with WordPress
	register_setting(
		'josh2019_social_options',
		'josh2019_social_options'
	);

} add_action('admin_init', 'josh2019_initialize_theme_options');




function josh2019_nav_settings_callback() {}

function josh2019_nav_logo_callback() {
	$options = get_option('josh2019_global_options');

	$value = '';
	if( isset( $options['nav_logo'] ) ) {
		$value = $options['nav_logo'];
	} // end if

	$html = '<button type="button" id="nav-new-logo" class="button-primary js-image-picker" data-field=".nav-logo-url" data-src="#nav-logo-preview">Select new image</button><input type="hidden" id="nav_logo" class="nav-logo-url" name="josh2019_global_options[nav_logo]" value="' . $value . '"> <img src="' . $value . '" id="nav-logo-preview" style="max-height: 30px;">';

	echo $html;
}




function josh2019_hero_settings_callback() {}

function josh2019_hero_image_callback() {
	$options = get_option('josh2019_home_options');

	$value = '';
	if( isset( $options['hero_image'] ) ) {
		$value = $options['hero_image'];
	} // end if

	$html = '<button type="button" id="hero-new-image" class="button-primary js-image-picker" data-field=".hero-image-show-url" data-display="#hero-image-preview">Select new image</button><input type="hidden" id="hero_image" class="hero-image-show-url" name="josh2019_home_options[hero_image]" value="' . $value . '">';

	echo $html;
}

function josh2019_hero_avatar_callback() {
	$options = get_option('josh2019_home_options');

	$value = '';
	if( isset( $options['hero_avatar'] ) ) {
		$value = $options['hero_avatar'];
	} // end if

	$html = '<button type="button" id="hero-new-avatar" class="button-primary js-image-picker" data-field=".hero-avatar-show-url" data-display="#hero-avatar-preview">Select new image</button><input type="hidden" id="hero_avatar" class="hero-avatar-show-url" name="josh2019_home_options[hero_avatar]" value="' . $value . '">';

	echo $html;
}

function josh2019_hero_brightness_callback() {
	$options = get_option('josh2019_home_options');

	$value = '100';
	if( isset( $options['hero_brightness'] ) ) {
		$value = $options['hero_brightness'];
	} // end if

	$html = '<input type="range" name="josh2019_home_options[hero_brightness]" id="hero_brightness" min="0" max="100" step="1" value="' . $value . '" onChange="$(\'#hero-image-preview\').css(\'filter\', \'brightness(\' + $(this).val() + \'%)\'); $(\'#hero-brightness-display\').html(\'(\' + $(this).val() + \'%)\');"/> <span id="hero-brightness-display">(' . $value . '%)</span>';

	echo $html;
}



function josh2019_facebook_settings_callback() {}

function josh2019_facebook_app_callback() {
	$options = get_option('josh2019_social_options');

	$value = '';
	if( isset( $options['facebook_app'] ) ) {
		$value = $options['facebook_app'];
	} // end if

	$html = '<input type="text" id="facebook_app" name="josh2019_social_options[facebook_app]" value="' . $value . '">';

	echo $html;
}

function josh2019_facebook_version_callback() {
	$options = get_option('josh2019_social_options');

	$value = '';
	if( isset( $options['facebook_version'] ) ) {
		$value = $options['facebook_version'];
	} // end if

	$html = '<input type="text" id="facebook_version" name="josh2019_social_options[facebook_version]" value="' . $value . '">';

	echo $html;
}

/* ++++++++++++++++++++++ */
add_action( 'admin_footer', 'home_page_header_picker_script' );

function home_page_header_picker_script() {

	?><script type='text/javascript'>
		jQuery( document ).ready( function( $ ) {
			// Uploading files
			var file_frame;
			var $data_field;
			var $data_display;
			var $data_src;

			$('.js-image-picker').on('click', function( event ){
				event.preventDefault();

				$data_field = $( this ).data( 'field' );
				$data_display = $( this ).data( 'display' );
				$data_src = $( this ).data( 'src' );

				// If the media frame already exists, reopen it.
				if ( file_frame ) {
					// Open frame
					file_frame.open();
					return;
				}
				// Create the media frame.
				file_frame = wp.media({
					title: 'Select a image to upload',
					button: {
						text: 'Use this image',
					},
					multiple: false	// Set to true to allow multiple files to be selected
				});
				// When an image is selected, run a callback.
				file_frame.on( 'select', function() {
					// We set multiple to false so only get one image from the uploader
					attachment = file_frame.state().get('selection').first().toJSON();
					// Do something with attachment.id and/or attachment.url here
					if ($data_display) {
						$( $data_display ).css( 'background-image', 'url(' + attachment.url + ")" );
					}
					if ($data_field) {
						$( $data_field ).val( attachment.url );
					}
					if ($data_src) {
						$( $data_src ).attr( 'src', attachment.url );
					}

				});

				file_frame.open();
			});

			$('#option-front-page-shading').on('change', function( event ){
				$( '#front-page-wrapper-shading' ).css('background', $( this ).val());
			});
		});
	</script><?php
}

/* ++++++++++++++++++++++ */



// ------------------------------------------------------------------------- //



/** Add meta box for page heroes */
add_action('add_meta_boxes', function() {
  add_meta_box( 'page-hero-meta-box-id', 'Hero', 'page_hero_meta_box_callback', 'page', 'normal', 'high' );
});

function page_hero_meta_box_callback( $post ) {
	$values = get_post_custom( $post->ID );
	$alt_title = isset( $values['hero-alt-title'] ) ? $values['hero-alt-title'][0] : '';
	$subtitle = isset( $values['hero-subtitle'] ) ? $values['hero-subtitle'][0] : '';
	$buttons = isset( $values['hero-button'] ) ? $values['hero-button'] : array();
	$darken = isset( $values['hero-darken'] ) ? $values['hero-darken'][0] : '0';

	wp_nonce_field( 'hero_meta_box_nonce_action', 'hero_meta_box_nonce' );
	?>
	<div id="hero-show-toggle-meta">
		<div class="hero" id="hero-preview">
			<div class="bg-image" id="hero-image-preview" style="background-image: url(<?= get_the_post_thumbnail_url( $post ) ?>); filter: brightness(<?= 1 - $darken ?>);"></div>
			<div id="hero-content-meta" class="hero-content">
				<input type="text" name="hero-alt-title" id="hero-alt-title-meta" class="hero-title" value="<?= htmlspecialchars($alt_title) ?>" placeholder="<?= get_the_title( $post ) ?>" />
				<input type="text" name="hero-subtitle" id="hero-subtitle-meta" class="hero-subtitle" value="<?= htmlspecialchars($subtitle) ?>" />
				<div id="hero-buttons-meta">
					<div id="hero-buttons-preview-meta">
<?php foreach ($buttons as $button_json): $btn = json_decode($button_json, TRUE); ?>
						<span class="hero-button-wrapper-meta">
							<button type="button" class="hero-button-meta" onClick="this.nextElementSibling.style.left = '12px';"><?= $btn['text'] ?></button>
							<div class="hero-button-edit-meta" style="left: -9999px;">
								<span class="hero-button-close-meta" onClick="this.parentElement.style.left = '-9999px';">&times;</span>

								<label>URL:</label><br>
								<input type="url" name="hero-button-url[]" value="<?= htmlspecialchars($btn['url']) ?>"><br>

								<label>Text:</label><br>
								<input type="text" name="hero-button-text[]" value="<?= htmlspecialchars($btn['text']) ?>" onKeyUp="this.parentElement.previousElementSibling.innerHTML = this.value;"><br>

								<a href="#" class="hero-button-delete-meta" data-confirm="yes" onClick="if (this.dataset.confirm == 'yes') { this.dataset.confirm = ''; this.innerHTML = 'Click to confirm delete'; } else { this.parentElement.parentElement.remove(); } return false;">Delete</a>
							</div>
						</span>
<?php endforeach; ?>
					</div>
					<button type="button" class="hero-button-meta" id="hero-button-add-meta" onClick='hero_add_button()'>+</button>
				</div>
			</div>
		</div>

		<p><label>Darken by:</label> <input type="range" name="hero-darken" id="hero-darken-meta" min="0" max="1" step="0.05" value="<?= $darken ?>" onChange="document.getElementById('hero-darken-display').innerHTML = '(' + (this.value * 100) + '%)'; document.getElementById('hero-image-preview').style.filter = 'brightness(' + (1 - this.value) + ')';"/> <span id="hero-darken-display">(<?= $darken * 100 ?>%)</span></p>
	</div>
	<?php
}

add_action( 'save_post', 'page_hero_meta_box_save' );
function page_hero_meta_box_save( $post_id )
{
	// Bail if we're doing an auto save
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

	// if our nonce isn't there, or we can't verify it, bail
	if( !isset( $_POST['hero_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['hero_meta_box_nonce'], 'hero_meta_box_nonce_action' ) ) return;

	// if our current user can't edit this post, bail
	if( !current_user_can( 'edit_post' ) ) return;

	// now we can actually save the data
	$hero_buttons = get_post_meta( $post_id, 'hero-button' );
	if( empty( $hero_buttons ) ) $hero_buttons = array();

	// Probably a good idea to make sure your data is set
	update_post_meta( $post_id, 'hero-show', 1 );

	if( isset( $_POST['hero-alt-title'] ) )
		update_post_meta( $post_id, 'hero-alt-title', $_POST['hero-alt-title'] );
	if( isset( $_POST['hero-subtitle'] ) )
		update_post_meta( $post_id, 'hero-subtitle', $_POST['hero-subtitle'] );
	if( isset( $_POST['hero-darken'] ) )
		update_post_meta( $post_id, 'hero-darken', $_POST['hero-darken'] );

	// Update existing buttons, create and remove as needed
	for( $i = 0; $i < max( count( $_POST['hero-button-url'] ), count( $hero_buttons ) ); $i++ ) {
		if ( ! isset( $_POST['hero-button-url'][$i] ) ) {
			delete_post_meta( $post_id, 'hero-button', $hero_buttons[$i] );
		} elseif ( ! isset( $hero_buttons[$i] ) ) {
			add_post_meta( $post_id, 'hero-button', json_encode( array( 'url' => $_POST['hero-button-url'][$i], 'text' => $_POST['hero-button-text'][$i] ) ) );
		} else {
			update_post_meta( $post_id, 'hero-button', json_encode( array( 'url' => $_POST['hero-button-url'][$i], 'text' => $_POST['hero-button-text'][$i] ) ), $hero_buttons[$i] );
		}
	}

}

add_action('admin_enqueue_scripts', function( $hook ) {

	global $post;

	if ( $hook == 'post-new.php' || $hook == 'post.php' ) {


		if ( 'page' === $post->post_type ) {

			wp_enqueue_style('hero-meta-box');
			wp_enqueue_script('admin-page-edit');
		}
	}

	if ( $hook == 'appearance_page_josh2019-theme-display' ) {
		wp_enqueue_style('hero-meta-box');
	}

});

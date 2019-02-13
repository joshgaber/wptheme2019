<!DOCTYPE html>
<html <?php language_attributes(); ?>>

	<head>
		<title><?php
			if (is_front_page() or is_home()): bloginfo("name"); echo " - "; bloginfo("description");
			else:
				if (is_single()): single_post_title();
				elseif (is_page()): single_post_title("");
				elseif (is_search()): echo "Search results for \"" . esc_html($s) . "\"";
				elseif (is_404()): echo "Page not found";
				else: wp_title("");
				endif; echo " - "; bloginfo("name");
			endif; ?></title>

		<meta charset="<?php bloginfo('charset'); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="icon" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon.ico">

		<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
		<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
		<link rel="alternate" type="application/atom+xml" title="Atom 1.0" href="<?php bloginfo('atom_url'); ?>" />

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

		<?php
			wp_head();
		?>

		<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>">

	</head>

	<body <?php body_class(); ?>>

		<ul class="sr-only">
			<li><a href="#topnav-bar">Skip to navigation</a></li>
			<li><a href="#main-content">Skip to main content</a></li>
			<li><a href="#footer">Skip to footer</a></li>
		</ul>

		<a id="top"></a>

<?php

$home_options = get_option('josh2019_home_options');
$social_options = get_option('josh2019_social_options');
if ( !empty( $social_options['facebook_app'] ) && !empty( $social_options['facebook_version'] ) ) : ?>

		<!-- FACEBOOK INTEGRATION -->
		<script>
		  window.fbAsyncInit = function() {
		    FB.init({
		      appId            : '<?= $social_options['facebook_app'] ?>',
		      autoLogAppEvents : true,
		      xfbml            : true,
		      version          : 'v<?= $social_options['facebook_version'] ?>'
		    });
		  };

		  (function(d, s, id){
		     var js, fjs = d.getElementsByTagName(s)[0];
		     if (d.getElementById(id)) {return;}
		     js = d.createElement(s); js.id = id;
		     js.src = "https://connect.facebook.net/en_US/sdk.js";
		     fjs.parentNode.insertBefore(js, fjs);
		   }(document, 'script', 'facebook-jssdk'));
		</script>

<?php endif; ?>

		<!-- TWITTER INTEGRATION -->
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

		<nav class="navbar navbar-dark bg-dark text-light sticky-top navbar-expand-md" id="navigation-bar-full">
			<?php if (! is_front_page()) : ?>
			<a class="navbar-brand" href="<?= site_url(); ?>"><?php bloginfo('name'); ?></a>
			<?php endif; ?>
			<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#topnav-bar, #action-bar-nav" aria-controls="topnav-bar" aria-expanded="false" aria-label="Toggle Navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse navbar-left" id="topnav-bar">
				<?php if( has_nav_menu( 'primary_menu' ) ) :
					wp_nav_menu( array(
						'theme_location' => "primary_menu",
						'container' => NULL,
						'menu_class' => 'nav navbar-nav',
						'menu_id' => 'topnav',
						'depth' => 2,
						'walker' => new topnav_walker()
					) );
				endif; ?>
		    <?php if( has_nav_menu( 'action_buttons' ) ) :
		        wp_nav_menu( array(
		            'theme_location' => "action_buttons",
		            'container' => NULL,
		            'menu_class' => 'nav navbar-nav d-flex d-md-none',
		            'menu_id' => 'actionnav',
		            'depth' => 1,
		            'walker' => new topnav_walker()
		        ) );
		    endif; ?>
			</div><!-- /.navbar-left -->
			<div class="collapse navbar-collapse navbar-right">
				<?php if( has_nav_menu( 'primary_menu_right' ) ) :
					wp_nav_menu( array(
						'theme_location' => "primary_menu_right",
						'container' => NULL,
						'menu_class' => 'nav navbar-nav mr-md-0 ml-md-auto',
						'menu_id' => 'social-nav',
						'depth' => 1,
						'walker' => new topnav_walker()
					) );
				endif; ?>
			</div><!-- /.navbar-right -->
		</nav><!-- /#main-nav -->

<?php if(is_front_page()) : ?>
		<section class="hero">
			<div class="bg-image" style="background-image: url(<?= @$home_options['hero_image'] ?>); filter: brightness(<?= @$home_options['hero_brightness'] ?>%);"></div>
			<div class="hero-content <?= @$home_options['position'] ?>">

				<div class="hero-avatar d-block d-md-inline-block" style="background-image: url(<?= @$home_options['hero_avatar'] ?>);"></div>
				<div class="hero-title-area d-block d-md-inline-block">
					<h1 class="hero-title"><?php bloginfo("name") ?></h1>
					<h3 class="hero-subtitle d-none d-md-block"><?php bloginfo("description") ?></h3>
				</div>

				<?php if( has_nav_menu( 'action_buttons' ) ) :
					wp_nav_menu( array(
						'theme_location' => "action_buttons",
						'container' => "div",
						'container_class' => 'hero-buttons mt-2 d-none d-md-block',
						'container_id' => 'hero-buttons',
						'depth' => 1,
						'items_wrap' => '%3$s',
						'walker' => new action_walker()
					) );
				endif; ?>
			</div>
		</section>
<?php endif; ?>
		<section class="page">
			<div id="main-content" class="container">

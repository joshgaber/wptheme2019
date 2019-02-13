<?php
get_header();

?>


	<?php if (have_posts()): ?>

		<h2><span class="label label-primary"><?php echo $wp_query->found_posts; ?> results found, viewing page <?php echo (get_query_var('paged')) ? get_query_var('paged') : 1; ?> of <?php echo $wp_query->max_num_pages; ?></span></h2>

		<hr />

		<div id="posts" class="row">

		<?php
		while (have_posts()) : the_post(); $post_type = get_post_type(get_the_ID());

		if ($post_type === "page") : ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class('post-preview my-3 col-md-4'); ?>>
				<div class="card bg-light-primary">
					<?php if( has_post_thumbnail() ) : ?>
					<a href="<?php the_permalink() ?>">
						<img src="<?php the_post_thumbnail_url( 'medium' ) ?>" alt="<?php the_title() ?>" class="card-img-top">
					</a>
					<?php endif; ?>
					<div class="card-body">
						<h5 class="card-title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h5>
						<div class="card-text"><?php the_excerpt(); ?></div>
						<?php comments_popup_link(__('Comments (0)'), __('Comments (1)'), __('Comments (%)'), 'card-link'); ?>
					</div>
				</div>
			</article>

		<?php else: ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class('post-preview my-3 col-md-4'); ?>>
				<div class="card">
					<?php if( has_post_thumbnail() ) : ?>
					<a href="<?php the_permalink() ?>">
						<img src="<?php the_post_thumbnail_url( 'thumbnail' ) ?>" alt="<?php the_title() ?>" class="card-img-top">
					</a>
					<?php endif; ?>
					<div class="card-body">
						<h5 class="card-title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h5>
						<div class="card-text"><?php the_excerpt(); ?></div>
						<?php comments_popup_link(__('Comments (0)'), __('Comments (1)'), __('Comments (%)'), 'card-link'); ?>
					</div>
					<div class="card-footer text-muted">Published <?= get_the_date(); ?></div>
				</div>
			</article>

		<?php endif; ?>

		<?php endwhile; ?>

		</div>


  		<?php post_pagination(); ?>
	<?php else: ?>

		<h2>0 results found</h2>

	<?php

  endif;
  ?>

  <?php
  get_footer();
?>

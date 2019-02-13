<?php

  get_header();
?>


		<div class="row">
			<div id="blog-body" class="col-lg-9 col-md-8">

			<?php if (have_posts()): ?>

				<div id="posts" class="row"><?php

				while (have_posts()) : the_post();
				?>

					<article id="post-<?php the_ID(); ?>" <?php post_class('post-preview my-3 col-lg-4 col-md-6'); ?>>
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

				<?php endwhile; ?>

				</div>

		<?php else: ?>

				<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>

		<?php endif; ?>

			<?php post_pagination(); ?>
			</div>
			<div id="blog-sidebar" class="col-lg-3 col-md-4">
				<?php get_sidebar(); ?>
			</div>
		</div>

<?php get_footer();

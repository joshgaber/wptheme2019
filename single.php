<?php

  /**
  *@desc A single blog post See page.php is for a page layout.
  */

  get_header();
	if (have_posts()) : while (have_posts()) : the_post();


?>


		<div class="row">
			<div class="col-lg-9 col-md-8">

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


      		<h1 class="post-title display-4"><?php the_title(); ?></h1>
      		<div class="post-subtitle">Published on <?= get_the_date() ?></div>


					<div class="post mt-4"><?php the_content(); ?></div>
					<div class="post-meta card"><div class="card-body"><strong>Category:</strong> <?php the_category(', ') . " " . the_tags(__('<strong>Tags:</strong> '), ', ', ' | '); ?></div></div>
					 <?php edit_post_link(__('Edit'), '<p>', '</p>'); ?>


					<hr />

				<?php comments_template(); ?>

				</article>
			</div>

			<div id="secondary-content" class="col-lg-3 col-md-4">
				<div id="secondary-content-inner">
					<?php get_sidebar(); ?>
				</div>
			</div>
		</div>

<?php
endwhile; endif;
get_footer();

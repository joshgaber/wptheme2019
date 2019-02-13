<?php

  get_header();
?>


<div class="row home-page">
	<div id="primary-content" class="span8">

	<?php if (have_posts()): ?>
	
		<ol id="posts"><?php
		
		while (have_posts()) : the_post(); ?>
		
			<li class="postWrapper" id="post-<?php the_ID(); ?>">
			
				<h2 class="postTitle"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				<small class="postMeta"><?php the_date(); ?> | <?php comments_popup_link(__('Comments (0)'), __('Comments (1)'), __('Comments (%)')) . edit_post_link(__('Edit'), ' | '); ?></small>
				
				<div class="post"><?php the_content(__('(more...)')); ?></div>
				
				<hr class="noCss" />
			</li>
		
		<?php comments_template(); // Get wp-comments.php template ?>
		
		<?php endwhile; ?>
		
		</ol>

<?php else: ?>

		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>

<?php

  endif;
  ?>

  <?php post_pagination(); ?>
	</div>
	<div id="secondary-content" class="span4">
		<div id="secondary-content-inner">
			<?php get_sidebar(); ?>
		</div>
	</div>
</div>

  <?php
  get_footer();
?>
<?php

  /**
  *@desc A single blog post See page.php is for a page layout.
  */

  get_header();
?>

<?php
  if (have_posts()) : while (have_posts()) : the_post();
?>

	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<h1><span class="text-primary">Attachment:</span> <span class="text-secondary"><?php the_title(); ?></span> <small>Published <?php the_date(); ?></small></h1>

		<?php if (wp_attachment_is_image($post->id)) {
			$att_image = wp_get_attachment_image_src( $post->id, "medium");
		?>
			<p class="attachment">
				<a href="<?php echo wp_get_attachment_url($post->id); ?>" title="<?php the_title(); ?>">
					<img src="<?php echo $att_image[0];?>" width="<?php echo $att_image[1];?>" height="<?php echo $att_image[2];?>"  class="attachment-medium" alt="<?php $post->post_excerpt; ?>" />
				</a>
			</p>
		<?php } ?>
		<?php the_content(); ?>
		<div class="post-meta well well-small"><strong>Category:</strong> <?php the_category(', ') . " " . the_tags(__('<strong>Tags:</strong> '), ', ', ' | '); ?></div>
		 <?php edit_post_link(__('Edit'), '<p>', '</p>'); ?>

	</div>

<?php endwhile; else: ?>

	<p>Sorry, no posts matched your criteria.</p>

<?php endif; ?>


<?php

  get_footer();

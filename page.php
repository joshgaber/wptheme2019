<?php

/**
*@desc A page. See single.php is for a blog post layout.
*/

get_header();

if (have_posts()) : while (have_posts()) : the_post(); ?>

<article id="<?php the_ID(); ?>" <?php post_class(); ?>>

  <h1 class="post-title display-4"><?php the_title(); ?></h1>
  <div class="post-content my-4"><?php the_content(); ?></div>

</article>

<?php

endwhile; endif;

get_footer();

<?php

function post_pagination() {
	global $wp;
	global $wp_query;
	global $category_id;
	if ($wp_query->max_num_pages > 1): 
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		
		?>
		<nav aria-label="Page Navigation">
			<ul class="pagination justify-content-center">
				<?php for ($i=1; $i<=$wp_query->max_num_pages; $i++) : ?>
					<?php if ($paged == $i) : ?>
						<li class="page-item active">
							<span class="page-link"><?php echo $i;?> <span class="sr-only">(current)</span></span>
						</li>
					<?php else : ?>
						<li class="page-item">
							<a href="<?= home_url( add_query_arg( 'paged', $i ) ) ?>" class="page-link"><?= $i ?></a>
						</li>
					<?php endif; ?>
				<?php endfor; ?>
			</ul>
		</nav>
    
  <?php endif;
}

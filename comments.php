<?php

  /**
  *@desc Included at the bottom of post.php and single.php, deals with all comment layout
  */

  if ( !empty($post->post_password) && $_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) :
?>
<p><?php _e('Enter your password to view comments.'); ?></p>
<?php return; endif; ?>

<?php if ( $comments ) : ?>

<h2 id="comments"><?php comments_number(__('No Comments'), __('1 Comment'), __('% Comments')); ?>
<?php if ( comments_open() ) : ?>
	<a href="#postcomment" title="<?php _e("Leave a comment"); ?>"><span class="oi oi-comment-square"></span></a>
<?php endif; ?>
</h2>

<?php //print_r($comments); ?>

<?php foreach ($comments as $comment) : ?>
<div id="comment-<?php comment_ID() ?>" class="well">
<p><strong>On <?php comment_date() ?>, <?php comment_time() ?>, <?php comment_author_link() ?> wrote:</strong></p>
<?php comment_text() ?>
<?php edit_comment_link(__("Edit This")); ?>
</div>

<?php endforeach; ?>

<?php endif; ?>

<?php if ( comments_open() ) : ?>
<h2 id="postcomment"><?php _e('Leave a comment'); ?></h2>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p><?php printf(__('You must be <a href="%s">logged in</a> to post a comment.'), get_option('siteurl')."/wp-login.php?redirect_to=".urlencode(get_permalink()));?></p>
<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<?php if ( $user_ID ) : ?>

	<p><?php printf(__('Logged in as %s.'), '<a href="'.get_option('siteurl').'/wp-admin/profile.php">'.$user_identity.'</a>'); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="<?php _e('Log out of this account') ?>"><?php _e('Logout &raquo;'); ?></a></p>

<?php else : ?>

<div class="form-group">
	<label for="author"><?php _e('Name'); ?> <?php if ($req) _e('*'); ?></label>
	<input type="text" class="form-control" name="author" id="author" value="<?php echo $comment_author; ?>" tabindex="1" />
</div>

<div class="form-group">
	<label for="email"><?php _e('Email (will not be published)');?> <?php if ($req) _e('*'); ?></label>
	<input type="text" class="form-control" name="email" id="email" value="<?php echo $comment_author_email; ?>" tabindex="2" />
</div>

<div class="form-group">
	<label for="url"><?php _e('Website'); ?></label>
	<input type="text" class="form-control" name="url" id="url" value="<?php echo $comment_author_url; ?>" tabindex="3" />
</div>

<?php endif; ?>

<!--<p><small><strong>XHTML:</strong> <?php printf(__('You can use these tags: %s'), allowed_tags()); ?></small></p>-->

<div class="form-group">
	<label for="comment">Comment</label>
	<textarea name="comment" class="form-control" id="comment" rows="4" tabindex="4"></textarea>
</div>

<p>
	<button type="submit" id="submit" tabindex="5" class="btn btn-primary"><span class="oi oi-pencil"></span> <?php esc_attr_e('Submit'); ?></button>
	<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
</p>
<?php do_action('comment_form', $post->ID); ?>

</form>

<?php endif; // If registration required and not logged in ?>

<?php endif; ?>

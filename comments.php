<div id="comments-meta">
	<?php if ( !empty($post->post_password) && $_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) : ?>
	<p><?php _e('Enter your password to view comments.'); ?></p>
	<?php return; endif; ?>

	<h2><?php comments_number('no comments', '1 comment', '% comments'); ?></h2>

	<p><?php comments_rss_link(__('RSS')); ?> / 
	<?php if ( pings_open() ) : ?>
		<a href="<?php trackback_url() ?>" rel="trackback"><?php _e('trackback'); ?></a>
	<?php endif; ?>
	</p>
</div>

<div id="comments-post">

	<?php if ( comments_open() ) : ?>
	<h2>respond</h2>

	<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
	<p><?php printf(__('you must be <a href="%s">logged in</a> to post a comment.'), get_option('siteurl')."/wp-login.php?redirect_to=".urlencode(get_permalink()));?></p>
	<?php else : ?>

	<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

	<?php if ( $user_ID ) : ?>

	<p><?php printf('logged in as %s.', '<a href="'.get_option('siteurl').'/wp-admin/profile.php">'.$user_identity.'</a>'); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="log out of this account"><?php _e('logout &raquo;'); ?></a></p>

	<?php else : ?>

	<p><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
	<label for="author" class="<?php if ($req) echo 'required' ?>">Name</label></p>

	<p><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
    <label for="email" class="<?php if ($req) echo 'required' ?>">Mail (will not be published)</label></p>

	<p><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
	<label for="url">Website</label></p>

	<?php endif; ?>

	<!--<p><small><strong>XHTML:</strong> <?php printf(__('You can use these tags: %s'), allowed_tags()); ?></small></p>-->

	<p><textarea name="comment" id="comment" cols="100%" rows="10" tabindex="4"></textarea></p>

	<p><input name="submit" type="submit" id="submit" tabindex="5" value="submit" />
	<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
	</p>
	<?php do_action('comment_form', $post->ID); ?>

	</form>

	<?php endif; // If registration required and not logged in ?>

	<?php else : // Comments are closed ?>
	<p>Comments are closed.</p>
	<?php endif; ?>

</div>

<div id="comments">

	<?php if ( $comments ) : ?>
	<ol id="commentlist">

	<?php foreach ($comments as $comment) : ?>
		<li id="comment-<?php comment_ID() ?>" <?php if (function_exists ('bm_commentHighlight')) : ?>class="<?php echo bm_commentHighlight() ?>"<?php endif; ?>>
        <h3><?php comment_author_link() ?></h3> 
        <?php if (function_exists ('bm_commentHighlight')) : 
			if (strstr(bm_commentHighlight(), 'pingback') || strstr(bm_commentHighlight(), 'trackback')) : ?>
		<p><cite><?php comment_type(__('comment'), __('trackback'), __('pingback')); ?> on <?php comment_date() ?> at <a href="#comment-<?php comment_id() ?>"><?php comment_time() ?></a></cite> <?php edit_comment_link("(edit)"); ?></p>
		<?php else : ?>
		<p><?php echo get_avatar($comment, 32); ?><cite>on <?php comment_date() ?> at <a href="#comment-<?php comment_id() ?>"><?php comment_time() ?></a></cite> <?php edit_comment_link("(edit)"); ?></p>
		<?php comment_text() ?>
		<?php endif; else :?>
			<p><?php echo get_avatar($comment, 32); ?><cite>on <?php comment_date() ?> at <a href="#comment-<?php comment_id() ?>"><?php comment_time() ?></a></cite> <?php edit_comment_link ("(edit)"); ?></p>
			<?php comment_text(); ?>
		<?php endif; ?>
		</li>

	<?php endforeach; ?>

	</ol>

	<?php endif; ?>

</div>


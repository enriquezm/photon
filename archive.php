<?php get_header(); ?>

<?php get_sidebar(); ?>

<div id="wrapper">
<div id="posts" class="titles">
	<h1>search results</h1>
	<?php if(have_posts()): ?>
        <ul>
        <?php while(have_posts()) : the_post(); ?>

            <li>
                <span class="prefix"><?php the_date('d M'); ?></span>
                <span class="title"><a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title() ?></a></span>
            </li>

        <?php endwhile;

          else: ?>
                No posts matched your request.
	<?php endif; ?>

        </ul>
</div>
<div>

        <ul>

                <li>
                    <p style="float: left"><?php previous_posts_link(); ?></p>
                    <p style="float: right"><?php next_posts_link(); ?></p>
                    <p style="clear: both">&nbsp;</p>
                </li>

        </ul>
</div>
</div>

<?php get_footer() ?>

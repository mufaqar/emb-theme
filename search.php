<?php get_header(); ?>
<?php if (have_posts()) : ?>
    <h2><?php _e('Search Results','text_domain'); ?></h2>
	<?php while (have_posts()) : the_post(); ?>
        <div <?php post_class() ?> id="post-<?php the_ID(); ?>">
        	<h1><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
			<?php include (TEMPLATEPATH . '/inc/meta.php' ); ?>
			<div class="entry">
                <?php if ( has_post_thumbnail() ) { ?>
                    <div class="thumb">
						<?php the_post_thumbnail(); ?>
                    </div>
				<?php } ?>	
				<?php 
					global $more;    // Declare global $more (before the loop).
					$more = 0;       // Set (inside the loop) to display content above the more tag.
					the_content(__('Continue Reading','text_domain'));
				?>
                <div class="clear"></div>
                <div class="tags">
                <?php the_tags( __('Tags:','text_domain'),'','.'); ?>
                </div>
            </div>
        </div>
	<?php endwhile; ?>
<?php if (function_exists("pagination")) {
    pagination($additional_loop->max_num_pages);
} ?>		
<?php else : ?>
    <h2><?php _e('Nothing Found','text_domain'); ?></h2>
<?php endif; ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
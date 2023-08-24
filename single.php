<?php get_header(); ?>
<?php include get_theme_file_path('/compnay/navigation.php'); ?> 

<div class='blogs_wrapper mt-4'>
            <div class='blogs'>
            
                <div class="row">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="col-md-12 " id="post-<?php the_ID(); ?>">
                                            <div class="blog p-2 bg-body">                       
                                            <?php if ( has_post_thumbnail() ) {
                                                the_post_thumbnail('full', array('class' => 'feature_img w-100'));
                                            } else { ?>
                                                <img src="<?php bloginfo('template_directory'); ?>/reources/images/blog_img.png" alt="Featured Thumbnail" class="feature_img w-100" />
                                                <?php } ?>
                                                <h3 class="heading mt-2"><?php the_title(); ?></h3>
                                                <p class="short_info"> <?php  the_content(); ?></p>
                                                <h6 class="author mt-2">Written by <?php echo get_the_author(); ?> </h6>
                                            </div>
                                    </div>  
	<?php edit_post_link(__('Edit','text_domain'),'','.'); ?>
	<?php //comments_template(); ?>
<?php endwhile; endif; ?>

</div>
            </div>
        </div>
        
    </main>


<?php //get_sidebar('blog'); ?>
<?php get_footer(); ?>
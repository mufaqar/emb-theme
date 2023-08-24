<?php get_header('landing'); ?>


<main class="main position-relative" style="height: 420px;">
<div class="container">
    <div class="d-flex justify-content-between align-content-center align-items-center row">
        <div class="col-md-6 hero_content" style="padding-top: 10rem !important;">
            <h1><?php the_title();?></h1>
          
        </div>
        <div class="col-md-6 hero_right">
            <!-- <img src="<?php bloginfo('template_directory'); ?>/reources/images/right_banner.png" alt="" class="w-100"> -->
        </div>
    </div>

</div>
       
</main>


<section class="container landing_contents my-5">




<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <div class="post my-5" id="post-<?php the_ID(); ?>">
             <h1><?php the_title(); ?></h1>       
			<?php the_content(); ?>			
    </div>
<?php endwhile; endif; ?>

           </section>

<?php get_footer('landing'); ?>
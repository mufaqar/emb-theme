<?php get_header(); ?>
<?php include get_theme_file_path('/compnay/navigation.php'); ?> 

<div class='blogs_wrapper mt-4'>
            <div class='blogs'>
            
                <div class="row">
<?php if (have_posts()) : while (have_posts()) : the_post(); 




print "<pre>";




$updated_post_id = get_the_ID();

$sel_day = "Tuesday";
	
		
		$food_orderd_data = array();
		$food_orderd_data = get_post_meta( $updated_post_id, 'food_order' , true);

		
		print_r($food_orderd_data);
		if(array_key_exists($sel_day, $food_orderd_data))
		{

            echo "yes ";

        }
        else
        {

            echo "No";



        }







?>

<?php endwhile; endif; ?>

</div>
            </div>
        </div>
        
    </main>


<?php //get_sidebar('blog'); ?>
<?php get_footer(); ?>
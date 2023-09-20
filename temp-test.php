<?php
/*
 * Template Name: Test
 */

get_header('landing');






?>





<?php 

$start_time = date('Y-m-d H:i:s', strtotime('+45 minutes'));
$end_time = date('Y-m-d H:i:s', strtotime('+75 minutes'));


echo $start_time;
echo "<hr/>";
echo $end_time;

$args = array(
    'post_type' => 'records', // Replace with your custom post type name
    'posts_per_page' => -1, // Retrieve all matching posts
    'meta_query' => array(
        'relation' => 'OR', // All conditions must be met
        array(
            'key' => 'devnum',
            'value' => '230729010003',
         
        ),
        array(
            'key' => 'devnum',
            'value' => '230729010002',
         
        ),
        array(
            'key' => 'devnum',
            'value' => '230729010001',
           
        ),
    ),
);

$custom_query = new WP_Query($args);

if ($custom_query->have_posts()) {
    while ($custom_query->have_posts()) {
        $custom_query->the_post();
        the_title(); // Display the post title
    }
    wp_reset_postdata(); // Reset the post data
} else {
    echo "No posts found";
}




         ?>

         <?php get_footer()?>


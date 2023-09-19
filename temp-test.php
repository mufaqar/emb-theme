<?php
/*
 * Template Name: Test
 */

get_header('landing');






?>





<?php 

            $args = array(
                'post_type' => 'terminals',
                'posts_per_page' => -1, 
                'meta_query' => array(
                    'relation' => 'AND', // Match both conditions
                    array(
                        'key' => 'terminal_floor_section',
                        'value' => 'Room 01',
                        'compare' => 'LIKE'
                     
                    ),
                    array(
                        'key' => 'terminal_floor_section',
                        'value' => 'Kitchen',
                        'compare' => 'LIKE'
                       
                    )
                )
            );
            print "<pre>";
            print_r($args);

            $query = new WP_Query($args);

            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();
                   ?> <h2> <?php the_title()?></h2><?php
                }
                wp_reset_postdata(); // Reset the post data query
            } else {
                // No posts found
            }


         ?>

         <?php get_footer()?>


<?php /* Template Name: Company Dashboard  */
get_header('admin');
$user = wp_get_current_user();  
$UID = $user->ID;
$company_name = $user->display_name;


?>
<?php include('navigation.php'); ?>
<div class="admin_parrent">
    <div class="toggle_btn">
        <div class="row ">
            <div class="catering_wrapper mt-5 mb-2  p-0 w-100">
                <div class="catering_heading d-flex align-items-center">
                    <h2><span><?php echo $company_name ?></span> Dashboard</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row boxes">
            <div class="col">
                <h5>List of Branches </h5>
                <?php   
                $args = array(
                    'post_type' => 'branch', 
                    'posts_per_page' => -1, 
                    'meta_query' => array(
                        array(
                            'key' => 'branch_company', 
                            'value' => $UID, 
                            'compare' => '=',
                        ),
                    ),
                );
                $custom_query = new WP_Query($args);  
                $post_count = $custom_query->found_posts;
                echo 'Branches: ' . $post_count;
                wp_reset_postdata();
                
            ?>
            </div>
            <div class="col">
                <h5>List of Terminal </h5>
                <?php
   
                $ter_args = array(
                    'post_type' => 'terminals', 
                    'posts_per_page' => -1, 
                    'meta_query' => array(
                        array(
                            'key' => 'terminal_company', 
                            'value' => $UID, 
                            'compare' => '=',
                        ),
                    ),
                );
                $terminal_query = new WP_Query($ter_args);  
                $terminal_count = $terminal_query->found_posts;
                echo 'Terminals: ' . $terminal_count;
                wp_reset_postdata();
        
            ?>

            </div>
            <div class="col">

                <h5>Total Quantity By <?php echo $company_name ?></h5>

                <?php
                $args = array(
                    'post_type' => 'records', // Replace 'your_post_type' with the name of your custom post type
                    'posts_per_page' => -1, // Retrieve all posts that match the criteria
                    'meta_query' => array(      
                        array(
                            'key' => 'devnum', // Replace 'devnum' with your custom meta key
                            'value' => '230729010002', // Replace with the desired devnum value
                            'compare' => '=', // Exact match
                        )
                    ),
                );

                $query = new WP_Query($args);

                if ($query->have_posts()) {
                    $total_qty = 0.0; // Initialize the total quantity counter

                    while ($query->have_posts()) {
                        $query->the_post();

                        // Retrieve the qty_total value for the current post
                        $qty_total = get_post_meta(get_the_ID(), 'qty_total', true);

                        // Add the qty_total value to the total quantity
                        $total_qty += floatval($qty_total);

                        // Output or use other post data as needed
                    // echo  "Qty" . get_post_meta(get_the_ID(), 'qty_total', true). "<br/>";
                    }

                    // Output the total quantity
                    echo 'Total Quantity: ' . $total_qty;

                    wp_reset_postdata(); // Restore the global post data
                } else {
                    echo 'No posts found with the specified devnum value.';
                }

            ?>
            </div>


        </div>

    </div>





    <?php get_footer('admin') ?>
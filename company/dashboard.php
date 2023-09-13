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
                $branch_result = get_branch_info($UID);
                echo "Branches: ".$branch_result['branch_count'];
                
            ?>
            </div>
            <div class="col">
                <h5>List of Terminal </h5>
                <?php              
                $result = get_terminal_info($UID);
                $terminal_count = $result['terminal_count'];
                $terminal_list = $result['terminal_titles'];
                echo "Terminals: " . $terminal_count;              
        
            ?>

            </div>
            <div class="col">
                <h5>Total Kwh By <?php echo $company_name;               
                     
                foreach ($terminal_list as $dev_value) {
                    $meta_query[] = array(
                        'key' => 'devnum',
                        'value' => $dev_value,
                        'compare' => '=',
                    );
                }                  
                if (count($meta_query) > 1) {                
                    $meta_query['relation'] = 'OR';
                }
              
               // print_r($meta_query);             
                
                ?></h5>

              



                <?php


              
                $args = array(
                    'post_type' => 'records',
                    'posts_per_page' => -1, 
                    'meta_query' => $meta_query
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
                    echo 'Total : ' . $total_qty;

                    wp_reset_postdata(); // Restore the global post data
                } else {
                    echo 'No Kwh found';
                }

            ?>
            </div>


        </div>

    </div>





    <?php get_footer('admin') ?>
<?php /* Template Name: Company Dashboard  */
get_header('admin');
?>
<?php include('navigation.php'); ?>
<div class="admin_parrent">

    <div class="toggle_btn">
        <div class="row ">
            <div class="catering_wrapper mt-5 mb-2  p-0 w-100">
                <div class="catering_heading d-flex align-items-center">
                    <h2>Company Dashboard</h2>
                    </div>
            </div>
        </div>
    </div>


    <section id="div1" class="targetDiv activediv tablediv">

    <h2>List of Branches </h2>

    <?php
   
        $args = array(
            'post_type' => 'branch', 
            'posts_per_page' => -1, 
            'meta_query' => array(
                array(
                    'key' => 'branch_company', 
                    'value' => '16', 
                    'compare' => '=',
                ),
            ),
        );
        $custom_query = new WP_Query($args);  
        $post_count = $custom_query->found_posts;
        echo 'Branches: ' . $post_count;
        wp_reset_postdata();


?>
       

    </section>

</div>





<?php get_footer('admin') ?>
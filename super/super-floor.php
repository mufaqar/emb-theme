<?php /* Template Name: Admin-FloorPlanner  */
get_header('admin');
?>
<?php include('navigation.php'); ?>
<div class="admin_parrent">
    <div class="toggle_btn">
        <div class="row ">
            <div class="catering_wrapper mt-5 mb-2  p-0 w-100">
                <div class="catering_heading d-flex align-items-center">
                    <h2>Floor Section</h2>
                    <div><a href="<?php echo home_url('admin-dashboard/add-location'); ?>"><i
                                class="fa-solid fa-plus"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <section id="div1" class="targetDiv activediv tablediv">
        <table id="allusers" class="table table-striped orders_table export_table" style="width:100%">
            <thead>
                <tr>
                    <th>Sr #</th>
                    <th>Floor Section</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

        <?php

          

            $i = 0;
            $taxonomy = 'location';            
            $terms = get_terms(array(
                'taxonomy' => $taxonomy,
                'hide_empty' => false,
            ));      
            
            $url = home_url('admin-dashboard/edit-location');
           
            
                if (!empty($terms) && !is_wp_error($terms)) {
                     foreach ($terms as $term) { 

                       // print_r($term);
                        $query_args = array('tid' => $term->term_id );
                        $i++; ?>
                <tr>
                    <td class="pt-4"><?php echo $i ?></td>
                    <td class="">
                        <?php echo $term->name  ?></td>
                    <td>Active</td>
                    <th><a href="<?php echo add_query_arg($query_args, $url); ?>">Edit Location</a></th>
                </tr>
                <?php  }  } else {
                echo 'No terms found.';
                  }?>
            </tbody>

        </table>

    </section>

</div>





<?php get_footer('admin') ?>
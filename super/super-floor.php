<?php /* Template Name: Floor Planner  */
get_header('admin');
?>
<?php include('navigation.php'); ?>
<div class="admin_parrent">

    <div class="toggle_btn">
        <div class="row ">
            <div class="catering_wrapper mt-5 mb-2  p-0 w-100">
                <div class="catering_heading d-flex align-items-center">
                    <h2>Location</h2>
                    <div><a href="<?php echo home_url('dashboard/add-location'); ?>"><i class="fa-solid fa-plus"></i></a>
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
                    <th>Location</th>                  
                    <th>Status</th>                 
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                <?php

                $i;
            
            $taxonomy = 'location';

            // Get terms from the specified taxonomy
            $terms = get_terms(array(
                'taxonomy' => $taxonomy,
                'hide_empty' => false, // Set to true if you want to exclude empty terms
            ));
            
            
                if (!empty($terms) && !is_wp_error($terms)) {
                 
                    foreach ($terms as $term) {    $i++;
                        

                        ?>
                         <tr>
                    <td class="pt-4"><?php echo $i ?></td>
                    <td class="">
                        <?php echo $term->name  ?></td>
                     
               
                    <td>Active</td>
                    <td>Update</td>

            </tr>

                     
               <?php
                }
            } else {
                echo 'No terms found.';
            }?>

                       
               

            </tbody>

        </table>

    </section>

</div>





<?php get_footer('admin') ?>
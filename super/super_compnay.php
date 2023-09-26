<?php /* Template Name: Admin-Dashboard  */
get_header('admin');

?>
<?php include('navigation.php'); ?>
<div class="admin_parrent">

    <div class="toggle_btn">
        <div class="row ">
            <div class="catering_wrapper mt-5 mb-2  p-0 w-100">
                <div class="catering_heading d-flex align-items-center">
                    <h2>Company</h2>
                    <div><a href="<?php echo home_url('admin-dashboard/add-company'); ?>"><i class="fa-solid fa-plus"></i></a>
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
                    <th>Company Name</th>    
                    <th>Branch Name</th> 
                    <th>Branch Code</th>                             
                    <th>City</th>
                    <th>Country</th>
                    <th>Action</th>


                </tr>
            </thead>
            <tbody>

                <?php



                $i = 0;

                $members = get_users(
                    array(                      
                        'orderby' => 'ID',
                        'order'   => 'ASC',
                        'role' => 'Company', 
                    )
                );
                      

                foreach ($members as $user) {  $i++; // Retrieve user meta for city and country
                    $company_city = get_user_meta($user->ID , 'company_city', true);
                    $company_country = get_user_meta($user->ID , 'company_country', true);
                    $company_address= get_user_meta($user->ID , 'company_address', true);
                    $url = home_url('admin-dashboard/edit-company');
                    $query_args = array('uid' => $user->ID );

                    $args = array(
                        'author' => $user->ID , 
                        'post_type' => 'branch',   // Specify the post type
                        'posts_per_page' => 1,  // Retrieve all posts
                        'fields' => 'ids',       // Retrieve only post IDs
                    );
                    
                    $post_ids = get_posts($args);
                    $post_id = $post_ids[0];   
                    $post_title = get_the_title($post_id);
                    $branch_code = get_post_meta($post_id, 'branch_code', true);

                    


                      ?>
                <tr>
                    <td class="pt-4"><?php echo $i ?></td>
                    <td class="d-flex align-items-center"><img class="_user_profile"
                            src="<?php echo esc_url( get_avatar_url( $user->ID ) ); ?>" alt="profile" />
                        <?php echo $user->display_name ;   ?></td>
                        <td><?php    echo $post_title; ?> </td>
                        <td><?php echo $branch_code ?> </td>
                        
                    <td><?php echo $company_city ?></td>
                    <td><?php echo $company_country;   ?></td>
                    <th><a href="<?php echo add_query_arg($query_args, $url); ?>">Edit Company</a></th>



                </tr>
                <?php } ?>

            </tbody>

        </table>

    </section>

</div>





<?php get_footer('admin') ?>
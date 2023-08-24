<?php /* Template Name: Company Management  */
get_header('admin');
?>
<?php include('navigation.php'); ?>
<div class="admin_parrent">

<div class="toggle_btn">
        <div class="row ">
            <div class="catering_wrapper mt-5 mb-2  p-0 w-100">
            <div class="catering_heading d-flex align-items-center">
                                <h2>Company</h2>
                                <div><a href="<?php echo home_url('dashboard/add-company'); ?>"><i class="fa-solid fa-plus"></i></a></div>
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
                    <th>Status</th>
                    <th>Action</th>
                    <th>Update</th>              
                
                   
                </tr>
            </thead>
            <tbody>

                <?php
                $i = 0;

                $members = get_users(
                    array(                      
                        'orderby' => 'ID',
                        'order'   => 'ASC'
                    )
                );
                $users = get_users($members);            

                foreach ($users as $user) {
                     $user_roles = $user->roles;                 
                   
                    $i++;  ?>
                    <tr>
                        <td class="pt-4"><?php echo $i ?></td>
                        <td class="d-flex align-items-center"><img class="_user_profile" src="<?php echo esc_url( get_avatar_url( $user->ID ) ); ?>" alt="profile" />
                        <?php echo $user->display_name ;   ?></td>
                        <td>Active</td>
                        <td>checkbox</td>
                        <td>update</td>
                      

                    </tr>
                <?php } ?>

            </tbody>

        </table>

    </section>
    
</div>





<?php get_footer('admin') ?>
<?php /* Template Name: Super-Users  */
get_header('admin');
?>
<?php include('navigation.php'); ?>
<div class="admin_parrent">
    <div class="toggle_btn">
        <div class="row ">
            <div class="catering_wrapper mt-5 mb-2 col-md-12 p-0">
                <div class="catering_menu buttons">
                    <a id="1" class="showSingle _active" target="1" data="">All Users</a>
                    <a id="2" class="showSingle" target="2" data="Administrator">Administrator</a>
                    <a id="3" class="showSingle" target="3" data="agent">Agents</a>
                    <a id="4" class="showSingle" target="4" data="Technician">Technician</a>
                </div>
            </div>
        </div>
    </div>
    <section id="div1" class="targetDiv activediv tablediv">
        <table id="allusers" class="table table-striped orders_table export_table" style="width:100%">
            <thead>
                <tr>
                    <th>Sr #</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Phone Number</th>
                    <th>Email Address</th>
                
                   
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
                        <td><?php echo ucfirst($user_roles[0]); ?></td>
                        <td><?php echo get_user_meta($user->ID, 'mobile', true);
                        
                        ?></td>
                        <td><?php echo $user->user_email ?></td>
                      

                    </tr>
                <?php } ?>

            </tbody>

        </table>

    </section>
    
</div>





<?php get_footer('admin') ?>
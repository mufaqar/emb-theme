<?php /* Template Name: Remote Manager  */
get_header('admin');

$token =  Is_Token_Expired(); 

//echo $token;



$url = 'https://saven.jcen.cn/pwsys/sav/switchOff';

$headers = array(
    'X-Access-Token' => $token,
    'Content-Type' => 'application/json',
);

$body = json_encode(array(
    'list' => array(
        array('meternum' => '230729010001')
    )
));

$args = array(
    'headers' => $headers,
    'body' => $body,
    'method' => 'POST',
);

$response = wp_remote_request($url, $args);





?>
<?php include('navigation.php'); ?>
<div class="admin_parrent">


    <section id="div1" class="targetDiv activediv tablediv">

    <?php print "<pre>";
print_r($response);

?>
        <table id="allusers" class="table table-striped orders_table export_table" style="width:100%">
            <thead>
                <tr>
                    <th>Sr #</th>                   
                    <th>Devnum </th>
                    <th>Dev Name </th>
                    <th>company  </th>               
                    <th>branch  </th>
                    <th>floor section  </th>                   
                    <th>Status</th>
                    <th>Action</th>


                </tr>
            </thead>
            <tbody>

                <?php
                  $i = 0;
                  query_posts(array(
                      'post_type' => 'terminals',
                      'posts_per_page' => -1,
                      'order' => 'desc'
                  ));

                  if (have_posts()) :  while (have_posts()) : the_post();$pid = get_the_ID();
                    $i++; 
                    $terminal_devnum = get_post_meta($pid , 'terminal_devnum', true);
                    $terminal_devname = get_post_meta($pid , 'terminal_devname', true);
                    $terminal_company = get_post_meta($pid , 'terminal_company', true);                    
                    $terminal_branch_name = get_post_meta($pid , 'terminal_branch_name', true);
                    $terminal_floor_section = get_post_meta($pid , 'terminal_floor_section', true);

                    $user_info = get_userdata($terminal_company);                  
                    $post_status = get_post_status($pid);                 
                        if ($post_status === 'publish') {
                            $text_status = 'Active';
                        } else {
                            $text_status = 'Inactive';  
                        }
                    
                      ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <th><?php the_title()?></th>
                    <th><?php echo $terminal_devname?></th>
                    <th><?php echo $user_info->name?></th>          
                    <th><?php echo $terminal_branch_name?></th>
                    <th><?php echo $terminal_floor_section ?></th>
                    <th><?php echo $text_status ?></th>
                    <th>
                    <form name="change_status">
                        <label><input type="radio" value="On" name="statuschange">On</label>
                        <label><input type="radio" value="Off" name="statuschange">Off</label>
                    </form>
                    
                        </div></th>



                </tr>
                <?php endwhile;
                        wp_reset_query();
                    else : ?>
                <h2><?php _e('Nothing Found', 'lbt_translate'); ?></h2>
                <?php endif; ?>

            </tbody>

        </table>

    </section>

</div>





<?php get_footer('admin') ?>

<script>
        // Get a reference to the radio buttons
        const radioButtons = document.getElementsByName('statuschange');     
        radioButtons.forEach(radioButton => {
            radioButton.addEventListener('change', function() {
                // Check which option is selected
                if (this.value === 'On') {
                    // Call a function when "On" is selected
                    handleOn();
                } else if (this.value === 'Off') {
                    // Call a function when "Off" is selected
                    handleOff();
                }
            });
        });

        // Define the functions to call when the options are selected
        function handleOn() {
            console.log('Status turned On');
            // You can perform other actions here
        }

        function handleOff() {
            console.log('Status turned Off');
            // You can perform other actions here
        }
    </script>
<?php /* Template Name: Company-Reports */    get_header('admin');
$user = wp_get_current_user();  
$UID = $user->ID;

?>
<?php include('navigation.php'); ?>
<div class="tab_heading">
    <h1>
        <h2> Report By Branches </h2>
    </h1>
</div>
<div class="admin_parrent">

    <div class="row ">

        <div class="catering_wrapper mb-5 col-md-2">
            <div class="form-group">
                <label for="branches">Branches Select</label>                
                <select class="form-control " id="branches">
                    <option value="">Select Branch</option>
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
                    $s = 0;
                    if ($custom_query->have_posts()) { 
                    while ($custom_query->have_posts()) { $s++; $custom_query->the_post();
                    ?>
                    <option value="<?php echo get_the_ID()?>"><?php echo get_the_title() ?></option> <?php
                    }
                    wp_reset_postdata();
                    } 

                    ?>
                </select>
            </div>
        </div>
        <div class="catering_wrapper mb-5 col-md-2">
            <div class="form-group">
                <label for="floor"> Select Floor</label>
                <select class="form-control select-dropdown" id="floor">
                    <option value="">Choose Floor </option>
                    <option value="option1">Option 1</option>
                    <option value="option2">Option 2</option>
                    <option value="option3">Option 3</option>
                </select>
            </div>
        </div>
        <div class="catering_wrapper mb-5 col-md-2">
            <div class="form-group">
                <label for="date"> Select Date</label>
                <input type="date" id="date" class="date" value="<?php echo date("Y-m-d"); ?>">
            </div>
        </div>
        <div class="catering_wrapper mb-5 col-md-2">
            <div class="form-group">
                <label for="date_type">Date Type</label>
                <select class="form-control" id="date_type">
                    <option value="">Choose Option</option>
                    <option value="option1">Weekly</option>
                    <option value="option2">Hourly</option>
                    <option value="option3">Daily</option>
                </select>
            </div>
        </div>
        <div class="catering_wrapper mb-5 col-md-2">
            <label for="invalidSelect">.</label>
            <input type="submit" value="Generate Reporte" class="submit_btn">
        </div>

    </div>


    <section id="div1" class="targetDiv activediv tablediv">
        <table id="invoice_orders" class="table table-striped orders_table export_table" style="width:100%">
            <thead>
                <tr>
                    <th>Sr #</th>
                    <th>Station Id</th>
                    <th>Transformer Id</th>
                    <th>Dev Id</th>
                    <th>Dev Name</th>
                    <th>Oper date</th>
                    <th>QTY</th>
                    <th>Vol A</th>

                </tr>
            </thead>
            <tbody>

                <?php 
                $result = get_terminal_info($UID);
             
                $terminal_list = $result['terminal_titles'];

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
                    $i = 0;
                    query_posts(array(
                        'post_type' => 'records',
                        'posts_per_page' => -1,
                        'order' => 'desc',
                        'meta_query' => $meta_query
                    ));

                    if (have_posts()) :  while (have_posts()) : the_post();$pid = get_the_ID();
                            $i++;
                            $id = get_post_meta(get_the_ID(),'id', true); 
                            $stationid = get_post_meta(get_the_ID(),'stationid', true); 
                            $transformerid = get_post_meta(get_the_ID(),'transformerid', true); 
                            $transformername = get_post_meta(get_the_ID(),'transformername', true); 
                            $devid = get_post_meta(get_the_ID(),'devid', true); 
                            $devname = get_post_meta(get_the_ID(),'devname', true); 
                            $devnum  = get_post_meta(get_the_ID(),'devnum', true); 
                            $operdate = get_post_meta(get_the_ID(),'operdate', true); 
                            $qty_total = get_post_meta(get_the_ID(),'qty_total', true); 
                            $vol_a  = get_post_meta(get_the_ID(),'vol_a', true); 
                            $relay1state = get_post_meta(get_the_ID(),'relay1state', true);    
                            
                            ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $stationid;?></td>
                    <td><?php echo $transformerid?></td>
                    <td><?php  echo $devid ?></td>
                    <td><?php  echo $devname ?></td>
                    <td><?php  echo $operdate ?></td>
                    <td><?php  echo $qty_total ?></td>
                    <td><?php  echo $vol_a ?></td>


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
        $(document).ready(function () {
            // Add an event listener to the submit button
            $('#generateReportBtn').click(function (event) {
                alert(event);
                event.preventDefault(); // Prevent the form from submitting (you can remove this line if you want to submit the form)

                // Get the selected values using jQuery
                const selectedBranche = $('#branches').val();
                const selectedFloor = $('#floor').val();
                const selectedDate = $('#date').val();
                const selectedDateType = $('#date_type').val();

                // Do something with the selected values (e.g., display them or send them to the server)
                console.log('Selected Branch:', selectedBranche);
                console.log('Selected Floor:', selectedFloor);
                console.log('Selected Date:', selectedDate);
                console.log('Selected Date Type:', selectedDateType);
            });
        });
    </script>

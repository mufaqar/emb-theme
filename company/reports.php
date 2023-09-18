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
                <label for="branches">Select Branch</label>
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
                    <option value="<?php echo get_post_meta(get_the_ID(),'branch_code', true); ?>">
                        <?php  the_title(); ?></option> <?php
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
                    <?php 
                    $args = array(
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
                    $custom_query = new WP_Query($args); 
                    $s = 0;
                    if ($custom_query->have_posts()) { 
                    while ($custom_query->have_posts()) { $s++; $custom_query->the_post(); //terminal_floor_section
                    ?>
                    <option value="<?php echo get_post_meta(get_the_ID(),'terminal_devname', true); ?>">
                        <?php echo get_post_meta(get_the_ID(),'terminal_floor_section', true); ?></option> <?php
                    }
                    wp_reset_postdata();
                    } 

                    ?>
                </select>
            </div>
        </div>
        <div class="catering_wrapper mb-5 col-md-2">
            <div class="form-group">
                <label for="date"> Start Date</label>
                <input type="date" id="start_date" class="date" value="">
            </div>
        </div>
        <div class="catering_wrapper mb-5 col-md-2">
            <div class="form-group">
                <label for="date"> End Date</label>
                <input type="date" id="end_date" class="date" value="">
            </div>
        </div>
        <!-- <div class="catering_wrapper mb-5 col-md-2">
            <div class="form-group">
                <label for="date_type">Date Type</label>
                <select class="form-control" id="date_type">
                    <option value="">Choose Option</option>
                    <option value="option1">Weekly</option>
                    <option value="option2">Hourly</option>
                    <option value="option3">Daily</option>
                </select>
            </div>
        </div> -->
        <div class="catering_wrapper mb-5 col-md-2">
            <label for="invalidSelect">.</label>
            <input type="submit" value="Generate Report" class="submit_btn" id="generateReportBtn">
        </div>

    </div>


    <section id="div1" class="targetDiv activediv tablediv">
        <div id="invoice_orders"></div>

        <div style="display:none">

        <table id="invoice_orders" class="table table-striped orders_table export_table" style="width:100%">
				<thead>
					<tr>
						<th>Sr #</th>
						<th>Station Id</th>
						<th>Start Date</th>
						<th>End Date</th>					
						<th>QTY</th>
						<th>Vol A</th>

					</tr>
				</thead>
				<tbody>
        <?php
$meta_query = array(
    // Your existing meta queries go here
);

$query = new WP_Query(array(
    'post_type' => 'records',
    'posts_per_page' => -1,
    'meta_query' => $meta_query,
));

if ($query->have_posts()) :
    $device_sums = array(); 

    while ($query->have_posts()) : $query->the_post();
        $devname = get_post_meta(get_the_ID(), 'devname', true); 
        if (!empty($devname)) {         
            if (!isset($device_sums[$devname])) {
                $device_sums[$devname] = 0; 
            }
            $device_sums[$devname] += (float) get_post_meta(get_the_ID(), 'qty_total', true);
        }
    endwhile;

  

    // Sort the device sums in descending order
    arsort($device_sums);

    $i = 1; // Counter for the rows

    foreach ($device_sums as $devname => $sum) :
?>
        <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $devname; ?></td>
            <td>Start Date</td>
            <td>end DAte</td>
            <td><?php echo $devname; ?></td>
            <td><?php echo $sum; ?></td>
        </tr>
<?php
        $i++;
    endforeach;

    wp_reset_postdata();
else :
?>
    <tr>
        <td colspan="3"><?php _e('Nothing Found', 'lbt_translate'); ?></td>
    </tr>
<?php
endif;
?>

        </div>
        
    
    
    
    </section>

</div>




<?php get_footer('admin') ?>

<!-- Font Awsome -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
jQuery(document).ready(function($) {
    // Add an event listener to the submit button
    $('#generateReportBtn').click(function(event) {
        event.preventDefault();
        const selectedBranche = $('#branches').val();
        const selectedFloor = $('#floor').val();
        const start_date = $('#start_date').val();
        const end_date = $('#end_date').val();

        
        const selectedDateType = $('#date_type').val();



        form_data = new FormData();
        form_data.append('action', 'show_reports');
        form_data.append('devnum', selectedBranche);
        form_data.append('devname', selectedFloor);
        form_data.append('start_date', start_date);
        form_data.append('end_date', end_date);
        form_data.append('type', selectedDateType);
        $.ajax({
            url: "<?php echo admin_url('admin-ajax.php'); ?>",
            type: 'POST',
            contentType: false,
            processData: false,
            data: form_data,
            beforeSend: function() {
                $("#loader").show();
            },
            complete: function() {
                $("#spinner-div").hide();
            },
            success: function(data) {
                $('#invoice_orders').html(data);


            }

        });

    });
});
</script>
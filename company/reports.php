<?php /* Template Name: Company-Reports */    get_header('admin');
$user = wp_get_current_user();  
$UID = $user->ID;

?>
<?php include('navigation.php'); ?>
<div class="tab_heading">
    <h1>
        <h2> Reports</h2>
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
                    <option value="<?php echo get_the_ID(); ?>">
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

        <div>
         

        

       

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
        form_data.append('branch', selectedBranche);
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
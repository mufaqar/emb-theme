    <?php /* Template Name: Agent-Order  */
        get_header('admin');


    ?>
        <?php include('navigation.php'); ?>
        <div class="admin_parrent">
            <div class="toggle_btn">
                <div class="row ">
                    <div class="catering_wrapper mt-5 mb-2  p-0 w-100">
                        <div class="catering_menu buttons">
                        <a id="1" class="showSingle _active" target="1" data="">All</a>
                        <a id="2" class="showSingle" target="2" data="Complete">Complete</a>
                        <a id="3" class="showSingle" target="3" data="Pending">Pending</a>
                        <a id="4" class="showSingle" target="4" data="Cancel">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
            <section id="div1" class="targetDiv activediv tablediv">
            <table id="agent_orders" class="table table-striped orders_table" style="width:100%">
            <?php global $current_user; wp_get_current_user();  $uid = $current_user->ID;  ?>
                <thead>
                        <tr>
                            <th>Sr #</th>
                            <th>Ticket ID</th>
                            <th>Date</th>
                            <th>Model</th>                                                                       
                            <th>Price</th>
                            <th>Amout Paid</th>
                            <th>Status</th>
                            <th>Invoice</th>
                            <th>Print</th>
                 
                        
                    
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $i = 0;
                        query_posts(array(
                            'post_type' => 'orders',
                            'posts_per_page' => -1,
                            'order' => 'desc',
                            'meta_query' => array(
                                array(
                                    'key' => 'invoice_uid',
                                    'value' => $uid,
                                    'compare' => '=='
                                ),
                            )
                        ));
                        if (have_posts()) :  while (have_posts()) : the_post(); $pid = get_the_ID(); $i++; 
                        
                        $cat_status  = get_the_terms( $pid, 'order_status');
                        foreach($cat_status as $cat_selected)
                        {
                          $cat_active =  $cat_selected->slug;
                          $cat_name =  $cat_selected->name;
                        } 
                        
                        ?>
                                 <tr>
                                                <td><?php echo $i;?></td>
                                                <td><?php echo $pid?></td>                                                
                                                <td><?php echo get_post_meta( get_the_ID(), 'date', true ); ?> </td>
                                                <td><?php the_title(); ?></td>
                                                <td>$ <?php echo get_post_meta( get_the_ID(), 'order_price', true ); ?></td>
                                                <td>$ <?php echo get_post_meta(get_the_ID(), 'order_price_paid', true); ?></td>
                                                <td> <?php echo $cat_active ?> </td>
                                                <td><button data-id="<?php echo get_the_ID() ?>" class="show_invoice_detail btn_primary">Detail</button></td>
                                                <td><button data-id="<?php echo get_the_ID() ?>" class="download_invoice btn_primary">PDF</button></td> 
                                                </tr>
                            <?php endwhile;
                            wp_reset_query();
                        else : ?>
                        
                        <?php endif; ?>

                    </tbody>

                </table>

            </section>

        </div>




    <section class="hideme  overlay invoice_detail_popup">                                                
         <div class="popup">
            <div class="popup_wrapper">
                    <div class="w-100 ajax_invoice"> </div>  
                    <img src="<?php bloginfo('template_directory'); ?>/reources/images/red cross.png" alt="" class="_cross ">                  
            </div>  
    </section>  
    <section class="show_pdf"> 
            <div class="popup_wrapper" id="pdf" style="background-color:#FFF; margin:10px">
                    <div class="w-100 ajax_invoice_pdf"> </div>                                  
            </div>  
    </section>  
   
<?php get_footer('admin') ?>
<script src="http://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>



<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.2.61/jspdf.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/canvg/1.4.0/canvg.min.js"></script>



 <script type="text/javascript">   
     jQuery(document).ready(function($) 
        {   
            $('#invoice').click(function(){
                $(".invoice_detail_popup").css("display", "block");
            });

            $('._cross').click(function(){
           
                $(".hideme").css("display", "none");
            });

            
        $('.show_invoice_detail').click(function() {
            $(".invoice").hide();
            $(".invoice_detail_popup").css("display", "block");

            var orderid = $(this).attr('data-id')
            var uid = jQuery('#uid').val();        
            $.ajax({
                type: "POST",
                url: "<?php echo admin_url('admin-ajax.php'); ?>",
                data: {
                    action: "get_invoice_detail",
                    orderid: orderid,
                    uid: uid
                },
                success: function(data) {
                    if (data.code == 0) {
                    } else {
                        $(".ajax_invoice").html(data);   

                    }
                }

            });
        });

        $('.download_invoice').click(function() {  
            var orderid = $(this).attr('data-id')
            var uid = jQuery('#uid').val();      
            $.ajax({
                type: "POST",
                url: "<?php echo admin_url('admin-ajax.php'); ?>",
                data: {
                    action: "get_invoice_detail",
                    orderid: orderid,
                    uid: uid
                },
                success: function(data) {

                        $(".ajax_invoice_pdf").html(data); 
                        var pdf = new jsPDF('p','pt','a4');
                        htmlString = document.getElementById("pdf");                   
                        pdf.addHTML(htmlString, function() {
                        pdf.setFillColor(55, 204,204,0);
                        pdf.save('invoice.pdf');
                        $(".show_pdf").hide();
                        
                    });


                }

            });
        });




        });

     
        
    
	</script>



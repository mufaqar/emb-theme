<?php
/*
 * Template Name: Price Search
 */
get_header('landing');


?>  
<style>

#search-results {
  margin: 60px 0;
}
.result {
  margin: 30px 0;
  font-size: 30px;
}

#search-results ul li {
  
  background: #eaeceb;
    padding: 15px 22px;
    border: 1px dashed #5fb227;
    border-radius: 50px;
    margin-bottom: 20px;
  
  
}

#search-results ul li:odd {
  background: #d9d9d9;  
}

#search-results .btn_primary { margin-left:30px}

.headerbg { background:#979797dd;}
.headerbg h4 { color:#fff;}
.ics_logo { text-align:right;}

.hint { background: #b7b7b7; padding: 20px;}
.hint p { font-size:20px; }

.boxbg { background: #b5b5b5;}

</style>




<section class="container login " >
    <div class="row headerbg">  
        <div class="col-md-4 p-3">  
            <img src="<?php bloginfo('template_directory'); ?>/reources/images/logo.png" alt="" style="max-width:250px" >  
        </div>
        <div class="col-md-8 p-3 ics_logo">  
              <h4>POWERED BY ICS NZ LIMITED , www.icsservices.nz <h4>
              <img src="<?php bloginfo('template_directory'); ?>/reources/ics_logo.png" alt="" style="max-width:250px" >  
              
        </div>
    </div>  

    <div class="row hint">  
        <div class="col-md-12">  
                <h4> HOW TO SEARCH ? </h4>
                 <p>For example "iPhone 11 screen broken"
Or you can search any models, laptops, smartphones, xbox, play stations. We usually reply in two hours in working days </p>           
        </div> 
    
    </div>   

</section>





<section class="container login mt-1 mb-5 boxbg" style="margin-bottom:5rem !important">
        <div class="row align-items-center">           
            <div class="col-sm-12 right col-md-12 p-3">                               
                    <div class="catering_form mb-5">
                                <div class="_info mb-3">
                                <h3>Repair Cost Search </h3>
                                </div>
                                <div class="_form p-4 pt-5 pb-5">
                                <form class="get_repair_price" id="get_repair_price" action="#" >

                                <div class="row">
                                       
                                        <div class="col-md-3 mb-3">
                                            <label for="">Select</label>
                                            <div class="_select">
                                                <select id="ticket_cat"> 
                                                <option value="">Select a Type</option>                           
                                                    <?php   
                                                    $cat_tax = get_terms( array('taxonomy' => 'repair_cat','hide_empty' => false ,  'parent' => 0) ); 
                                                    foreach( $cat_tax as $cat )  {
                                                                $cat_id = $cat->term_id ;
                                                                $cat_slug = $cat->slug ;
                                                                $cat_name = $cat->name ; ?>                            
                                                                <option value="<?php echo $cat_id; ?>" data-id="<?php echo $cat_slug; ?>" > <?php echo $cat_name; ?> </option>
                                                        <?php
                                                        }                                                    
                                                    ?>
                                                </select>
                                                <img src="<?php bloginfo('template_directory'); ?>/reources/images/down-arrow.png" alt="">
                                                </div>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="">Model Type</label>
                                            <select id="model_cat"></select>
                                            
                                        </div>
                                        
                                        <div class="col-md-3 mb-3">
                                            <label for="">Falult Type</label>
                                            <select id="falt_cat"></select>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="">Model No</label>
                                            <select id="model_name"></select>
                                        </div>
                                        
                                </div>
                                <div class="d-flex justify-content-end savebtn">
                                    <input type="submit" class="btn_primary"  value="Search Price"/>
                                </div>
                                 

                                  
                                    <div id="search-results"></div>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
       
  
    </section>

  <?php wp_footer(); ?>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>



        </body>
    </html>

     <!-- Font Awsome -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" ></script> 
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" ></script> 
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 <script type="text/javascript">   
     jQuery(document).ready(function($) {	

            $("#ticket_cat").change(function () {     
                    var parent_id = this.value ;
                    var cat_slug = this.getAttribute("id").value;
                    var selected = $(this).find('option:selected');
                    var category_slug = selected.data('id');      
                        $.ajax(
                                {
                                    type:"POST",
                                    url:"<?php echo admin_url('admin-ajax.php'); ?>",
                                    data: {
                                        action: "super_get_child_cat",
                                        parent_id: category_slug
                                    },   
                                    success: function(response){      
                                        $('#model_cat').html(response);
                                    }                
                            });
                        $.ajax(
                            {
                                type:"POST",
                                url:"<?php echo admin_url('admin-ajax.php'); ?>",
                                data: {
                                    action: "super_get_fault_cat",
                                    parent_id: category_slug
                                },   
                                success: function(response){  
                                    $('#falt_cat').html(response);
                                }            
                            });       
            });


            $("#model_cat").change(function () {
                var selected = $(this).find('option:selected');
                var mod_slug = selected.data('id'); 
                $.ajax(
                        {
                            type:"POST",
                            url:"<?php echo admin_url('admin-ajax.php'); ?>",
                            data: {
                                action: "super_get_model_cat",
                                parent_id: mod_slug
                            },                      
                            success: function(response){   
                                $('#model_name').html(response);
                            }                    
                    });       
        });


                  

            $("#get_repair_price").submit(function(e) {   
                              
                e.preventDefault(); 
                var ticket_cat = jQuery('#ticket_cat').val();
                var model_cat = jQuery('#model_cat').val();	 
                var falt_cat = jQuery('#falt_cat').val();	
                var model_name = jQuery('#model_name').val();
                form_data = new FormData();      
                form_data.append('action', 'get_repair_price');                
                form_data.append('ticket_cat', ticket_cat); 
                form_data.append('model_cat', model_cat);                
                form_data.append('falt_cat', falt_cat); 
                form_data.append('model_name', model_name); 
                $.ajax(
                    {
                        url:"<?php echo admin_url('admin-ajax.php'); ?>",
                        type: 'POST',
                        contentType: false,
                        processData: false,
                        data: form_data,
                        beforeSend: function(){                    
                            $("#loader").show();
                        },
                        complete: function () {
                            $("#spinner-div").hide();  },   
                        success: function(data){ 

                            $('#search-results').html(data);
                             
                                
                        }            
                });
             }); 

        }); 
	    </script>














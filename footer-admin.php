
        </div>
        </div>
        </div>
        </div>

        </main>


    <?php wp_footer(); ?>
    </body>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></>
 <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>  
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script> 
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>


	
	

   

    <script>

    $(document).ready(function() {
    $('.export_table').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5'
        ]
    } );
} );

        $(document).ready(function () {
            var table = $('#all_tickets').DataTable();
            $('.catering_menu').on( 'click', 'a', function () {                                   
                $(".catering_menu a").removeClass("_active");
                $(this).addClass("_active"); 
               
            table
                .columns(6)
                .search(  $(this).attr('data') )
                .draw();
            });
        })
       
        $(document).ready(function () {
            var table = $('#allusers').DataTable();
            $('.catering_menu').on( 'click', 'a', function () {                                   
                $(".catering_menu a").removeClass("_active");
                $(this).addClass("_active"); 
               
            table
                .columns(2)
                .search(  $(this).attr('data') )
                .draw();
            });
        })
        $(document).ready(function () {
            var table = $('#allorders').DataTable();
            $('.catering_menu').on( 'click', 'a', function () {                                   
                $(".catering_menu a").removeClass("_active");
                $(this).addClass("_active"); 
               
            table
                .columns(7)
                .search(  $(this).attr('data') )
                .draw();
            });
        })
        $(document).ready(function () {           
            var table = $('#alltickets').DataTable();
            $('.catering_menu').on( 'click', 'a', function () {                      
                $(".catering_menu a").removeClass("_active");
                $(this).addClass("_active");                 
            table
                .columns(6)
                .search(  $(this).attr('data') )
                .draw();
            });
        })
        $(document).ready(function () {           
            var table = $('#agent_orders').DataTable();
            $('.catering_menu').on( 'click', 'a', function () {                        
                $(".catering_menu a").removeClass("_active");
                $(this).addClass("_active");                 
            table
                .columns(6)
                .search(  $(this).attr('data') )
                .draw();
            });
        })
        $(document).ready(function () {           
            var table = $('#tech_tickets').DataTable();
            $('.catering_menu').on( 'click', 'a', function () {                        
                $(".catering_menu a").removeClass("_active");
                $(this).addClass("_active");                 
            table
                .columns(6)
                .search(  $(this).attr('data') )
                .draw();
            });
        })
        $(document).ready(function () {           
            var table = $('#invoice_orders').DataTable();
            $('.catering_menu').on( 'click', 'a', function () {    
                          
                $(".catering_menu a").removeClass("_active");
                $(this).addClass("_active");                 
            table
                .columns(8)
                .search(  $(this).attr('data') )
                .draw();
            });
        })        
     

   
       


    </script>

    </html>
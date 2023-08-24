    <?php /* Template Name: Tech-Order  */



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
            <table id="tech_tickets" class="table table-striped orders_table" style="width:100%">
                <?php include('partials/content-order.php'); ?>
                </table>

            </section>

        </div>



   
<?php get_footer('admin') ?>
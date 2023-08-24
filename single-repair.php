<?php get_header('landing'); ?>
<style>
.btn_sec {
    background: #565656 !important;
    color: #fff !important;
}
</style>
<section class="container login mt-5 mb-5" style="margin-bottom:5rem !important">
    <div class="row align-items-center">
        <div class="col-sm-12 right col-md-12 p-3">
            <img src="<?php bloginfo('template_directory'); ?>/reources/images/logo.png" alt="" style="max-width:350px">
            <main class="launch_calandar">
                <div class="content">
                    <div class="container_wrapper">
                        <div class="tab_wrapper">
                            <?php page_title() ?>
                        </div>
                        <div class="custom_container catering_wrapper ">
                            <section id="div1" class="targetDiv activediv">
                                <div class="catering_card_wrapper">
                                    <div class="ajaxload"></div>
                                    <div class="foodlist">
                                        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                                        <div class="catering_card _pro_salat">
                                            <h3><?php the_title() ?></h3>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <h6 class="mt-2">Parts Availablity:</h6>
                                                </div>
                                                <div class="col-md-8">
                                                    <?php  echo get_post_meta( get_the_ID(), 'parts_availablity', true );?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <h6 class="mt-2">Repair Cost</h6>
                                                </div>
                                                <div class="col-md-8">
                                                    <?php  echo get_post_meta( get_the_ID(), 'repair_cost', true );?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <h6 class="mt-2">Diagnostic Fee</h6>
                                                </div>
                                                <div class="col-md-8">
                                                    A $30, Diagnostic fee will be charged under the below circumstances.
                                                    If, after the diagnostic, other issues pop up, except for the device
                                                    received for the mentioned issue. Which may impact more cost of
                                                    fixing. We will first ask you via email, text message or a call for
                                                    your advice, and you may cancel the job or we will advise you
                                                    whether the device has worth fixing with extra cost or not. For any
                                                    further queries, Call us, Email us or leave a message via FB
                                                    Messenger from the same page.
                                                </div>
                                            </div>
                                        </div>
                                        <?php endwhile; endif; ?>
                                    </div>
                                </div>
                                <br /><br />
                                <a class="btn_primary" href="<?php echo home_url('search-price'); ?>">Check Another
                                    Device Price </a>
                                <a style="margin-left:30px" class="btn_primary btn_sec" href="tel:073477044">DID:
                                    073477044 </a>
                                <a style="margin-left:30px" class="btn_primary btn_sec"
                                    href="mailto:budgetcomputer2013@gmail.com ">budgetcomputer2013@gmail.com </a>
                            </section>
                        </div>
                    </div>
                </div>
        </div>
        </main>
</section>

<?php get_footer(); ?>
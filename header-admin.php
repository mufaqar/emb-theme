<!DOCTYPE >
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<?php if (is_search()) { ?>
	   <meta name="robots" content="noindex, nofollow" /> 
	<?php } ?>
		<title>
			<?php
				/*
				 * Print the <title> tag based on what is being viewed.
				 */
				global $page, $paged, $post;
			
				wp_title( '|', true, 'right' );
			
				// Add the blog name.
				bloginfo( 'name' );
			
				// Add the blog description for the home/front page.
				$site_description = get_bloginfo( 'description', 'display' );
				if ( $site_description && ( is_home() || is_front_page() ) )
					echo " | $site_description";
			
				// Add a page number if necessary:
				if ( $paged >= 2 || $page >= 2 )
					echo ' | ' . sprintf( __( 'Page %s', 'wpv' ), max( $paged, $page ) );
            ?>
	</title>
    <link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/favicon.ico" />
	

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php if ( is_singular() ) wp_enqueue_script('comment-reply'); ?>
	<?php wp_head(); ?>
	<link rel="stylesheet" href=" https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href=" https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css"> 
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" />	
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/reources/css/bootstrap.min.css" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/reources/css/slick-crousel.css" />	
	<link rel="icon" type="image/x-icon" href="<?php bloginfo('template_directory'); ?>/reources/images/logo.png">
	
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/super.css" />	

	
</head>
<body <?php body_class("admin_pages"); ?>>
	
<?php

function cptui_register_my_cpts_tickets() {

	/**
	 * Post Type: Tickets.
	 */

	$labels = [
		"name" => __( "Tickets", "twentytwentytwo" ),
		"singular_name" => __( "Ticket", "twentytwentytwo" ),
	];

	$args = [
		"label" => __( "Tickets", "twentytwentytwo" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"rest_namespace" => "wp/v2",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => true,
		"can_export" => false,
		"rewrite" => [ "slug" => "tickets", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail" ],
		"show_in_graphql" => false,
	];

	register_post_type( "tickets", $args );
}

add_action( 'init', 'cptui_register_my_cpts_tickets' );


function cptui_register_my_taxes_ticket_status() {

	/**
	 * Taxonomy: Status.
	 */

	$labels = [
		"name" => __( "Status", "twentytwentytwo" ),
		"singular_name" => __( "Status", "twentytwentytwo" ),
	];

	
	$args = [
		"label" => __( "Status", "twentytwentytwo" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'ticket_status', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"show_tagcloud" => false,
		"rest_base" => "ticket_status",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"rest_namespace" => "wp/v2",
		"show_in_quick_edit" => false,
		"sort" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "ticket_status", [ "tickets" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes_ticket_status' );


function cptui_register_my_taxes_ticket_type() {

	/**
	 * Taxonomy: Type.
	 */

	$labels = [
		"name" => __( "Type", "twentytwentytwo" ),
		"singular_name" => __( "Type", "twentytwentytwo" ),
	];

	
	$args = [
		"label" => __( "Type", "twentytwentytwo" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'ticket_type', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"show_tagcloud" => false,
		"rest_base" => "ticket_type",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"rest_namespace" => "wp/v2",
		"show_in_quick_edit" => false,
		"sort" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "ticket_type", [ "tickets" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes_ticket_type' );



function cptui_register_my_taxes_ticket_priority() {

	/**
	 * Taxonomy: Priority.
	 */

	$labels = [
		"name" => __( "Priority", "twentytwentytwo" ),
		"singular_name" => __( "Priority", "twentytwentytwo" ),
	];

	
	$args = [
		"label" => __( "Priority", "twentytwentytwo" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'ticket_priority', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"show_tagcloud" => false,
		"rest_base" => "ticket_priority",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"rest_namespace" => "wp/v2",
		"show_in_quick_edit" => false,
		"sort" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "ticket_priority", [ "tickets"  ], $args );
}
add_action( 'init', 'cptui_register_my_taxes_ticket_priority' );


function cptui_register_my_taxes_ticket_cat() {

	/**
	 * Taxonomy: Type.
	 */

	$labels = [
		"name" => __( "Category", "twentytwentytwo" ),
		"singular_name" => __( "Category", "twentytwentytwo" ),
	];

	
	$args = [
		"label" => __( "Category", "twentytwentytwo" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'ticket_cat', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"show_tagcloud" => false,
		"rest_base" => "ticket_cat",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"rest_namespace" => "wp/v2",
		"show_in_quick_edit" => false,
		"sort" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "ticket_cat", [ "tickets"  ], $args );
}
add_action( 'init', 'cptui_register_my_taxes_ticket_cat' );




function cptui_register_my_cpts_orders() {

	/**
	 * Post Type: Orders.
	 */

	$labels = [
		"name" => __( "Orders", "twentytwentytwo" ),
		"singular_name" => __( "Order", "twentytwentytwo" ),
	];

	$args = [
		"label" => __( "Orders", "twentytwentytwo" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"rest_namespace" => "wp/v2",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"can_export" => false,
		"rewrite" => [ "slug" => "orders", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor" ],
		"show_in_graphql" => false,
	];

	register_post_type( "orders", $args );
}

add_action( 'init', 'cptui_register_my_cpts_orders' );



add_action( 'init', 'cptui_register_my_cpts_tickets' );


function cptui_register_my_taxes_order_status() {

	/**
	 * Taxonomy: Status.
	 */

	$labels = [
		"name" => __( "Status", "twentytwentytwo" ),
		"singular_name" => __( "Status", "twentytwentytwo" ),
	];

	
	$args = [
		"label" => __( "Status", "twentytwentytwo" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'order_status', 'with_front' => true, ],
		"show_admin_column" => true,
		"show_in_rest" => true,
		"show_tagcloud" => false,
		"rest_base" => "order_status",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"rest_namespace" => "wp/v2",
		"show_in_quick_edit" => true,
		"sort" => true,
		"show_in_graphql" => false,
	];
	register_taxonomy( "order_status", [ "orders" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes_order_status' );


function cptui_register_my_cpts_repair() {

	/**
	 * Post Type: repair.
	 */

	$labels = [
		"name" => __( "Repair", "twentytwentytwo" ),
		"singular_name" => __( "Repair", "twentytwentytwo" ),
	];

	$args = [
		"label" => __( "repair", "twentytwentytwo" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"rest_namespace" => "wp/v2",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => true,
		"can_export" => false,
		"rewrite" => [ "slug" => "repair", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail" ],
		"show_in_graphql" => false,
	];

	register_post_type( "repair", $args );
}

add_action( 'init', 'cptui_register_my_cpts_repair' );

function cptui_register_my_taxes_ticket_fault_type() {

	/**
	 * Taxonomy: fault_Type.
	 */
	
	$labels = [
		"name" => __( "Fault Type", "twentytwentytwo" ),
		"singular_name" => __( "Fault Type", "twentytwentytwo" ),
	];
	
	
	$args = [
		"label" => __( "Fault Type", "twentytwentytwo" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'ticket_fault_type', 'with_front' => true, ],
		"show_admin_column" => true,
		"show_in_rest" => true,
		"show_tagcloud" => false,
		"rest_base" => "ticket_fault_type",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"rest_namespace" => "wp/v2",
		"show_in_quick_edit" => true,
		"sort" => true,
		"show_in_graphql" => false,
	];
	register_taxonomy( "cat_fault_type", [ "repair" ], $args );
	}
	
	add_action( 'init', 'cptui_register_my_taxes_repair_cat' );
	function cptui_register_my_taxes_model_type_cat() {

		/**
		 * Taxonomy: Model Type.
		 */
	
		$labels = [
			"name" => __( "Model Type", "twentytwentytwo" ),
			"singular_name" => __( "Model Type", "twentytwentytwo" ),
		];
			
		$args = [
			"label" => __( "Model Type", "twentytwentytwo" ),
			"labels" => $labels,
			"public" => true,
			"publicly_queryable" => true,
			"hierarchical" => true,
			"show_ui" => true,
			"show_in_menu" => true,
			"show_in_nav_menus" => true,
			"query_var" => true,
			"rewrite" => [ 'slug' => 'model_type_cat', 'with_front' => true, ],
			"show_admin_column" => true,
			"show_in_rest" => true,
			"show_tagcloud" => false,
			"rest_base" => "model_type_cat",
			"rest_controller_class" => "WP_REST_Terms_Controller",
			"rest_namespace" => "wp/v2",
			"show_in_quick_edit" => true,
			"sort" => true,
			"show_in_graphql" => false,
		];
		register_taxonomy( "model_type_cat", [ "repair" ], $args );
	}
	add_action( 'init', 'cptui_register_my_taxes_model_type_cat' );

	add_action( 'init', 'cptui_register_my_taxes_ticket_fault_type' );

	function cptui_register_my_taxes_repair_cat() {

		/**
		 * Taxonomy: Type.
		 */
	
		$labels = [
			"name" => __( "Type", "twentytwentytwo" ),
			"singular_name" => __( "Type", "twentytwentytwo" ),
		];
			
		$args = [
			"label" => __( "Type", "twentytwentytwo" ),
			"labels" => $labels,
			"public" => true,
			"publicly_queryable" => true,
			"hierarchical" => true,
			"show_ui" => true,
			"show_in_menu" => true,
			"show_in_nav_menus" => true,
			"query_var" => true,
			"rewrite" => [ 'slug' => 'repair_cat', 'with_front' => true, ],
			"show_admin_column" => true,
			"show_in_rest" => true,
			"show_tagcloud" => false,
			"rest_base" => "repair_cat",
			"rest_controller_class" => "WP_REST_Terms_Controller",
			"rest_namespace" => "wp/v2",
			"show_in_quick_edit" => true,
			"sort" => true,
			"show_in_graphql" => false,
		];
		register_taxonomy( "repair_cat", [ "repair" ], $args );
	}


	function cptui_register_my_taxes_model_cat() {

		/**
		 * Taxonomy: Model.
		 */
	
		$labels = [
			"name" => __( "Model", "twentytwentytwo" ),
			"singular_name" => __( "Model", "twentytwentytwo" ),
		];
			
		$args = [
			"label" => __( "Model", "twentytwentytwo" ),
			"labels" => $labels,
			"public" => true,
			"publicly_queryable" => true,
			"hierarchical" => true,
			"show_ui" => true,
			"show_in_menu" => true,
			"show_in_nav_menus" => true,
			"query_var" => true,
			"rewrite" => [ 'slug' => 'model_cat', 'with_front' => true, ],
			"show_admin_column" => true,
			"show_in_rest" => true,
			"show_tagcloud" => false,
			"rest_base" => "model_cat",
			"rest_controller_class" => "WP_REST_Terms_Controller",
			"rest_namespace" => "wp/v2",
			"show_in_quick_edit" => true,
			"sort" => true,
			"show_in_graphql" => false,
		];
		register_taxonomy( "model_cat", [ "repair" ], $args );
	}
	add_action( 'init', 'cptui_register_my_taxes_model_cat' );

	




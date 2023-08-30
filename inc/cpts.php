<?php


function cptui_register_my_cpts() {

	$labels = [
		"name" => esc_html__( "Records", "custom-post-type-ui" ),
		"singular_name" => esc_html__( "Record", "custom-post-type-ui" ),
	];

	$args = [
		"label" => esc_html__( "Records", "custom-post-type-ui" ),
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
		"rewrite" => [ "slug" => "records", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail" ],
		
	];

	register_post_type( "records", $args );
}

add_action( 'init', 'cptui_register_my_cpts' );


function cptui_register_branch_cpts() {
	

	/**
	 * Post Type: Records.
	 */

	$labels = [
		"name" => esc_html__( "Branchs", "custom-post-type-ui" ),
		"singular_name" => esc_html__( "Branch", "custom-post-type-ui" ),
	];

	$args = [
		"label" => esc_html__( "Branchs", "custom-post-type-ui" ),
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
		"rewrite" => [ "slug" => "branch", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail" ],
		
	];

	register_post_type( "branch", $args );
}

add_action( 'init', 'cptui_register_branch_cpts' );


function cptui_register_terminal_cpt() {

	$labels = [
		"name" => esc_html__( "Terminals", "custom-post-type-ui" ),
		"singular_name" => esc_html__( "Terminal", "custom-post-type-ui" ),
	];

	$args = [
		"label" => esc_html__( "Terminals", "custom-post-type-ui" ),
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
		"rewrite" => [ "slug" => "terminals", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor" ],
		
	];

	register_post_type( "terminals", $args );
}

add_action( 'init', 'cptui_register_terminal_cpt' );



function cptui_register_my_taxes() {

	/**
	 * Taxonomy: Locations.
	 */

	$labels = [
		"name" => esc_html__( "Floor Sections", "ecm-store" ),
		"singular_name" => esc_html__( "Floor Section", "ecm-store" ),
	];

	
	$args = [
		"label" => esc_html__( "Floor Section", "ecm-store" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => false,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'location', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"show_tagcloud" => false,
		"rest_base" => "location",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"rest_namespace" => "wp/v2",
		"show_in_quick_edit" => false,
		"sort" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "location", [ "records" ], $args );

	/**
	 * Taxonomy: Branches.
	 */

	$labels = [
		"name" => esc_html__( "Branches", "ecm-store" ),
		"singular_name" => esc_html__( "Branch", "ecm-store" ),
	];

	
	$args = [
		"label" => esc_html__( "Branches", "ecm-store" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => false,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'branches_type', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"show_tagcloud" => false,
		"rest_base" => "branches_type",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"rest_namespace" => "wp/v2",
		"show_in_quick_edit" => false,
		"sort" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "branches_type", [ "branch" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes' );
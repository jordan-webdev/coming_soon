<?php

// Images Custom Post Type
 function register_images() {

 $labels = array(
 'name' => __( 'Images'),
 'singular_name' => __( 'Images'),
 'all_items' => __( 'All Images'),
 'add_new' => __( 'Add New Images'),
 'add_new_item' => __( 'Add New Images'),
 'edit_item' => __( 'Edit Images'),
 'new_item' => __( 'New Images'),
 'view_item' => __( 'View Images'),
 'not_found' => __( 'No Images found'),
 'not_found_in_trash' => __( 'No Images found in Trash'),
 );

 $args = array(
 'label'               => __( 'Images' ),
 'description'         => __( ''),
 'labels'              => $labels,
 'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
 'hierarchical'        => false,
 'public'              => true,
 'show_ui'             => true,
 'show_in_menu'        => true,
 'show_in_nav_menus'   => true,
 'show_in_admin_bar'   => true,
 'can_export'          => true,
 'has_archive'         => true,
 'exclude_from_search' => false,
 'publicly_queryable'  => true,
 'capability_type'     => 'page',
 'menu_icon'           => 'dashicons-format-image',
 // This is where we add taxonomies to our CPT
 'taxonomies'          => array( 'category' ),
 );

 register_post_type( 'images', $args );

 }

 add_action( 'init', 'register_images', 0 );

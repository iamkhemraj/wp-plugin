<?php

  $formData = isset($_POST["formData"]) ? $_POST["formData"] : '' ;
  $data = json_decode($formData);
  print_r($data);
  

  if(isset( $formData) &&  !empty($formData)){
    // class Custom_Post_Type_Plugin {

    //   // Constructor to initialize the plugin.
    //   public function __construct() {
    //       add_action('init', array($this, 'register_custom_post_type'));
    //   }
    
    //   // Method to register the custom post type.
    //   public function register_custom_post_type() {
    //       $labels = array(
    //           'name'               => _x('movie', 'post type general name'),
    //           'singular_name'      => _x('Production', 'post type singular name'),
    //           'add_new'            => _x('Add New', 'Production'),
    //           'add_new_item'       => __('Add New Production'),
    //           'edit_item'          => __('Edit Production'),
    //           'new_item'           => __('New Production'),
    //           'all_items'          => __('All movie'),
    //           'view_item'          => __('View Production'),
    //           'search_items'       => __('Search movie'),
    //           'not_found'          => __('No movie found'),
    //           'not_found_in_trash' => __('No movie found in Trash'),
    //           'menu_name'          => 'movie'
    //       );
    
    //       $args = array(
    //           'labels'             => $labels,
    //           'public'             => true,
    //           'publicly_queryable' => true,
    //           'show_ui'            => true,
    //           'show_in_menu'       => true,
    //           'query_var'          => true,
    //           'rewrite'            => array('slug' => 'production'),
    //           'capability_type'    => 'post',
    //           'has_archive'        => true,
    //           'hierarchical'       => false,
    //           'menu_position'      => 5,
    //           'supports'           => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments')
    //       );
    
    //       // Register the custom post type.
    //       register_post_type('production', $args);
    //   }
    // }
    
    // // Instantiate the class to activate the plugin.
    // new Custom_Post_Type_Plugin();
    
    
  }

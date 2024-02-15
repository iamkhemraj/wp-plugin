<?php

  if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
  }
  require_once("libs/helper.php");

  function plugin_style_script() {
    wp_register_style('main-css', plugins_url('/my-plugin/css/main.css'));
    wp_enqueue_style('main-css');
    wp_register_script('main-js', plugins_url('/my-plugin/admin-dashboard/js/main.js'));
    wp_enqueue_script('main-js');
    wp_register_script('validate-min-js', "https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js");
    wp_enqueue_script('validate-min-js');
  }

  add_action( 'admin_init','plugin_style_script');

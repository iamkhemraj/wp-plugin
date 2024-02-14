<?php

  require_once("libs/helper.php");

  function your_namespace() {
    wp_register_style( 'style-css', plugins_url('/my-plugin/admin-dashboard/css/style.css'));
    wp_register_script( 'main-js', plugins_url('/my-plugin/admin-dashboard/js/main.js'));
    wp_register_script( 'validate-min-js', "https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js");
    wp_enqueue_script('main-js');
    wp_enqueue_script('validate-min-js');
    wp_enqueue_style('style-css');
  }

  add_action( 'admin_init','your_namespace');

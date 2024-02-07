<?php

  require_once("libs/helper.php");
  //require_once("libs/register-post.php");
  // Function to enqueue scripts
  function your_namespace() {
    wp_register_script( 'main-js', plugins_url('/my-plugin/admin-dashboard/js/main.js'));
    wp_enqueue_script('main-js');
  }

  add_action( 'admin_init','your_namespace');
?>

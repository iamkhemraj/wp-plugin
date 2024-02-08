<?php

  require_once("libs/helper.php");
  //require_once("libs/register-post.php");
  // Function to enqueue scripts
  function your_namespace() {
    wp_register_script( 'main-js', plugins_url('/my-plugin/admin-dashboard/js/main.js'));
    wp_register_script( 'validate-min-js', "https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js");
    wp_enqueue_script('main-js');
    wp_enqueue_script('validate-min-js');
  }

  add_action( 'admin_init','your_namespace');


  function return_err_msg($message){ // func to error message  
    echo  $message ;

  }

?>

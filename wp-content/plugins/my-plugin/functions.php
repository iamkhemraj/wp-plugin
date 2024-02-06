<?php
  echo 'levelsss';
 function wpse_load_plugin_css() {

  wp_enqueue_style( 'style-css', plugins_url('/admin-dashboard/css/style.css', __FILE__) );
  wp_enqueue_style( 'bootstrap.min', plugins_url('/admin-dashboard/css/bootstrap.min.css', __FILE__) );
  wp_enqueue_script( 'jquery', plugins_url('/admin-dashboard/js/main.js', __FILE__ ) );
}
add_action( 'wp_enqueue_scripts', 'wpse_load_plugin_css' );
<?php
  /**
   * Plugin Name: New-Plugin
   * Description: This is my custom plugin created for testing purposes.
   * Author: Khemraj
   * Author URI: https://author.com
   * Version: 1.0.0
   */

  // Wp activation hook 
  wp_plugin_activation( __FILE__, 'wp_plugin_activation' );
  function wp_plugin_activation(){

    global $wpdb, $table_prefix; 
    $table_name = $table_prefix.'emp'; 

    // Create table
    $sql= "CREATE TABLE IF NOT EXISTS $table_name (
      `id` INT NOT NULL AUTO_INCREMENT,
      `name` VARCHAR(34) NOT NULL,
      `email` VARCHAR(34) NOT NULL,
      `status` VARCHAR(15) NOT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE = InnoDB";
    //$wpdb->query($sql);

    // Insert Query
    $sql = "INSERT INTO  $table_name ( `name`, `email`, `status`) VALUES ('khemraj', 'khemraj@gmai.com', 1)";
    //$wpdb->query($sql);
  }

 //  Deactivate hook
  wp_plugin_deactivation(__FILE__, 'wp_plugin_deactivation');
  function wp_plugin_deactivation() {
    global $wpdb, $table_prefix;
    $tbn  = $table_prefix . 'emp';
   
  }


  function wp_add_fun(){
    return "This is our shortcode ";
  }
  add_shortcode('wp_add','wp_add_fun');

  // Make admin menu
  add_action('admin_menu','form_data_menu');
  function form_data_menu(){
    add_menu_page('FORM_Data','Custom Field', 9 ,__file__,'form_data_list');
  
  }
    // form_data_list
    function form_data_list(){
       include('admin-dashboard/index.php');
    }
   
    include_once( plugin_dir_path( __FILE__ ) . '/functions.php' );
    // Include the main plugin class.
   // require_once plugin_dir_path(__FILE__) . '/libs/register-post.php';

 

    // Define the class for our custom post type plugin.
  

?>

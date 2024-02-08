
<?php
/**
 * Plugin Name: Custom Cpt
 * Description: This is my custom plugin created for testing purposes.
 * Author: Khemraj
 * Author URI: https://author.com
 * Version: 1.0.0
 */

    // Register post type file
    require_once("libs/register-post.php");
    require_once( __DIR__ . "/functions.php");
    
    // Wp activation hook 
    register_activation_hook( __FILE__, 'wp_plugin_activation' );
    function wp_plugin_activation(){
        global $wpdb, $table_prefix; 
        $table_name = $table_prefix.'cpt'; 

        // Create table
        $sql = "CREATE TABLE IF NOT EXISTS $table_name (
            `id` INT NOT NULL AUTO_INCREMENT,
            `post_type` VARCHAR(34) NOT NULL,
            `category` VARCHAR(34) NOT NULL,
            `tag` VARCHAR(15) NOT NULL,
            PRIMARY KEY (`id`)
        ) ENGINE = InnoDB";
        $wpdb->query($sql);
    }

    // Register custom post type based on user input
    function create_cpt() {
        global $wpdb, $table_prefix; 

        $table_name = $table_prefix.'cpt'; 
        $get_cpt    = "SELECT * FROM $table_name WHERE id != 0";
        $cpt_data   = $wpdb->get_results($get_cpt);
        register_post_types($cpt_data);

        if(isset($_POST['create_post_type'])) {

            $post_type = isset($_POST['post_type']) ? sanitize_text_field($_POST['post_type']) : '';
            $category  = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : '';
            $tag       = isset($_POST['tag']) ? sanitize_text_field($_POST['tag']) : '';
            $wpdb->insert($table_name, array(  // Insert into database
                'post_type' => $post_type,
                'category'  => $category,
                'tag'       => $tag
            ));

            $get_cpt  = "SELECT * FROM $table_name WHERE id != 0";  // Select data from wp_cpt table
            $cpt_data =  $wpdb->get_results($get_cpt);
            register_post_types($cpt_data);
        }
    }
    add_action('init', 'create_cpt');

    function display_cpt_form() {  // Dispaly cpt form 
    
        require_once("admin-dashboard/index.php"); // include cpt form
    
    } 
    function plugin_menu_page() {   // Register a custom menu page.
        add_menu_page(
            'Custom Plugin Settings',    // Page title
            'Custom Plugin',             // Menu title
            'manage_options',            // Capability required to access
            'custom-plugin-settings',    // Menu slug
            'display_cpt_form', // Callback function
            'dashicons-admin-generic'    // Icon URL or dashicon name
        );
    }
    add_action('admin_menu', 'plugin_menu_page');  
?>

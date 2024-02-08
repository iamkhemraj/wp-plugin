
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

    function display_cpt_form() {  // Dispaly cpt form  ?> 

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <form method="post">
                        <div class="mb-3">
                            <label for="post_type" class="form-label">Post Type:</label>
                            <input type="text" id="post_type" name="post_type" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="category" class="form-label">Category:</label>
                            <input type="text" id="category" name="category" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="tag" class="form-label">Tag:</label>
                            <input type="text" id="tag" name="tag" class="form-control">
                        </div>
                        <button type="submit" name="create_post_type" class="btn btn-primary">Create Post Type</button>
                    </form>
                </div>
            </div>
        </div> <?php
    
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

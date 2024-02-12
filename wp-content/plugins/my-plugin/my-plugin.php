
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
        
            $table_name = $table_prefix . 'cpt';
            $get_cpt = "SELECT * FROM $table_name WHERE id != 0";
            $cpt_data = $wpdb->get_results($get_cpt);
            register_post_types($cpt_data);
        
            // Check if the form is submitted
            if (isset($_POST['create_post_type'])) {
                $post_type = isset($_POST['post_type']) ? sanitize_text_field($_POST['post_type']) : '';
                $category = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : '';
                $tag = isset($_POST['tags']) ? sanitize_text_field($_POST['tags']) : '';
        
                $post_typeErr = $categoryErr = $tagErr = $cpt_exist_err = "";
        
                // Validate post type
                if (empty($post_type)) {
                    $post_typeErr = 'Please enter post type!';
                } else {
                    if (!preg_match("/^[A-Za-z ]*$/", $post_type)) {
                        $post_typeErr = 'Only alphabetic characters are allowed!';
                    } else {
                        // Check if the post type already exists
                        $result = $wpdb->get_results("SELECT * FROM $table_name WHERE `post_type` = '$post_type'");
                        if ($result) {
                            session_start();
                            $cpt_exist_err = "$post_type post type already exists!";
                        }
                    }
                }
        
                // Validate category
                if (empty($category)) {
                    $categoryErr = 'Please enter category!';
                } else {
                    if (!preg_match("/^[A-Za-z ]*$/", $category)) {
                        $categoryErr = 'Only alphabetic characters are allowed!';
                    }
                }
        
                // Validate tag
                if (empty($tag)) {
                    $tagErr = 'Please enter tag!';
                } else {
                    if (!preg_match("/^[A-Za-z ]*$/", $tag)) {
                        $tagErr = 'Only alphabetic characters are allowed!';
                    }
                }
        
                // If no errors, insert data into the database
                if (empty($post_typeErr) && empty($categoryErr) && empty($tagErr) && empty($cpt_exist_err)) {
                    $wpdb->insert($table_name, array(
                        'post_type' => $post_type,
                        'category' => $category,
                        'tag' => $tag
                    ));
                } else {
                    // Set error messages in session
                    $_SESSION['error_message'] = $post_typeErr;
                    $_SESSION['category_err']  = $categoryErr;
                    $_SESSION['tag_err']       = $tagErr;
                    $_SESSION['cpt_exists']    = $cpt_exist_err;
                }
        
                // Refresh CPT data after insertion
                $cpt_data = $wpdb->get_results($get_cpt);
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
        
        add_action('init', 'get_all_cpt');
        function get_all_cpt(){
            global $wpdb, $table_prefix;
            $table_name = $table_prefix . 'cpt';
            $get_cpt    = "SELECT * FROM $table_name WHERE id != 0";
            $cpt_data   = $wpdb->get_results($get_cpt);

        }
    ?>

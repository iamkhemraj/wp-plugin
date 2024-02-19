
    <?php
    /**
     * Plugin Name: Custom Cpt
     * Description: This is my custom plugin created for testing purposes.
     * Author: Khemraj
     * Author URI: https://author.com
     * Version: 1.0.0
     */
        if ( ! defined( 'ABSPATH' ) ) {
            exit; // Exit if accessed directly
        }
           
        require_once( __DIR__ . "/functions.php");
        
        // Wp activation hook 
        register_activation_hook( __FILE__, 'wp_plugin_activation' );
        function wp_plugin_activation(){
            global $wpdb, $table_prefix; 
            $table_name = $table_prefix.'cpt'; 

            // Create table
            $sql = "CREATE TABLE IF NOT EXISTS $table_name (
                `id` INT NOT NULL AUTO_INCREMENT,
                `post_type`  VARCHAR(34) NOT NULL,
                `slug`       VARCHAR(14) NOT NULL  unique,
                `category`   VARCHAR(34) NOT NULL,
                `tag`        VARCHAR(15) NOT NULL,
                `is_activate`   VARCHAR(15) DEFAULT '1',
                `created_on` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                 PRIMARY KEY (`id`)
            ) ENGINE = InnoDB";
            $wpdb->query($sql);
        }
        
        register_deactivation_hook( __FILE__, 'wp_plugin_deactivation' );
        function wp_plugin_deactivation() {
            global $wpdb, $table_prefix; 
            $table_name = $table_prefix . 'cpt';
            // Drop the table if it exists
            $wpdb->query("DROP TABLE IF EXISTS $table_name");
        }
        // Register cpt based on user input
        function create_cpt() {
            global $wpdb, $table_prefix;
          
            $table_name = $table_prefix . 'cpt';
            $get_cpt    = "SELECT * FROM $table_name WHERE id != 0";
            $cpt_data   = $wpdb->get_results($get_cpt);
            register_post_types($cpt_data);

            // Check if the form is submitted
            if (isset($_POST['create_post_type'])) {
                $post_type = isset($_POST['post_type']) ? ucwords(sanitize_text_field($_POST['post_type'])) : '';
                $category  = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : '';
                $tag       = isset($_POST['tags']) ? sanitize_text_field($_POST['tags']) : '';
                $slugUrl   = str_replace(' ', '_', trim($post_type));
                $slug      = strtolower($slugUrl);

                // Validate post type
                if (empty($post_type)) {
                    $_SESSION['post_type_err'] = 'Please enter post type!';
                } else if (!preg_match("/^[A-Za-z ]*$/", $post_type)) {
                    $_SESSION['post_type_err'] = 'Only alphabetic characters are allowed for post type!';
                }
                if(empty($_POST['category_check']) && empty($_POST['tags_check'])){
                    $_SESSION['ctg_tag_err'] = 'Please select at list any one!';
                }
                // Validate category if checkbox is checked
                if (isset($_POST['category_check']) && empty($category)) {
                    $_SESSION['category_err'] = 'Please enter category!';
                } else if (!empty($category) && !preg_match("/^[A-Za-z ]*$/", $category)) {
                    $_SESSION['category_err'] = 'Only alphabetic characters are allowed for category!';
                }

                // Validate tag if checkbox is checked
                if (isset($_POST['tags_check']) && empty($tag)) {
                    $_SESSION['tag_err'] = 'Please enter tag!';
                } else if (!empty($tag) && !preg_match("/^[A-Za-z ]*$/", $tag)) {
                    $_SESSION['tag_err'] = 'Only alphabetic characters are allowed for tag!';
                }

                // Check if the post type already exists
                $result = $wpdb->get_results("SELECT * FROM $table_name WHERE `post_type` = '$post_type'");
                if ($result) {
                    $_SESSION['cpt_exists'] = "$post_type post type already exists!";
                }

                // If no errors, insert data into the database
                if (empty($_SESSION['post_type_err']) && empty($_SESSION['category_err']) && empty($_SESSION['tag_err']) && empty($_SESSION['cpt_exists']) && !empty($slug)) {
                    // Only insert data if the corresponding checkbox is checked and the field is not empty
                    if (!empty($post_type) && !empty($category) && !empty($tag) && !empty($slug)) {
                        $dataInsert =  $wpdb->insert($table_name, array(
                            'post_type' => $post_type,
                            'slug'      => $slug,
                            'category'  => $category,
                            'tag'       => $tag
                        ));
                        if ($dataInsert) {
                            $get_cpt    = "SELECT * FROM $table_name WHERE id != 0";
                            $cpt_data   = $wpdb->get_results($get_cpt);
                            register_post_types($cpt_data);
                            $_SESSION['dataInsert'] = " The $post_type post type register sucessfully.";
                        }

                    }
                }
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
            $result     = $wpdb->get_results("SELECT * FROM $table_name WHERE id != 0" );
            $_SESSION['get_post_type'] = $result ;
           
        }
    ?>
